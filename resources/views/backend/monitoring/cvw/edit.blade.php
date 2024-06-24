@extends('backend._template.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script>
        Dropzone.options.dropzone = {
            url: '{{ route('backend.monitoring.cvw.update', $cvw) }}',
            paramName: 'cvw_galleries', // Set the parameter name for the uploaded files
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 10,
            maxFiles: 10,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            init: function () {
                var myDropzone = this;
                var form = document.getElementById('cvw-form');

                // Load existing gallery images into Dropzone
                @foreach ($cvw->cvwGallery as $gallery)
                    var mockFile = { name: '{{ $gallery->gallery_image }}', size: 12345, id: '{{ $gallery->id }}' }; // Replace with actual file properties
                    myDropzone.displayExistingFile(mockFile, '{{ Storage::url($gallery->gallery_image) }}');

                    var descriptionInput = document.createElement('textarea');
                    descriptionInput.setAttribute('name', 'existing_descriptions[{{ $gallery->id }}]');
                    descriptionInput.setAttribute('class', 'mt-2 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500');
                    descriptionInput.setAttribute('placeholder', 'Enter image description');
                    descriptionInput.textContent = '{{ $gallery->gallery_desc }}';
                    mockFile.previewElement.appendChild(descriptionInput);
                @endforeach

                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (myDropzone.getQueuedFiles().length > 0) {
                        myDropzone.processQueue();
                    } else {
                        form.submit();
                    }
                });

                myDropzone.on("addedfile", function (file) {
                    var descriptionInput = document.createElement('textarea');
                    descriptionInput.setAttribute('name', 'descriptions[]');
                    descriptionInput.setAttribute('class', 'mt-2 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500');
                    descriptionInput.setAttribute('placeholder', 'Enter image description');
                    file.previewElement.appendChild(descriptionInput);
                });

                myDropzone.on("removedfile", function (file) {
                    if (file.id) {
                        var deletedImages = document.getElementById('deleted_images');
                        deletedImages.value += file.id + ',';
                    }
                });

                myDropzone.on("sendingmultiple", function(data, xhr, formData) {
                    var descriptions = document.querySelectorAll('textarea[name="descriptions[]"]');
                    descriptions.forEach((textarea, index) => {
                        formData.append('descriptions[' + index + ']', textarea.value);
                    });

                    var formInputs = form.querySelectorAll('input, textarea, select');
                    formInputs.forEach(input => {
                        if (input.type !== 'file') {
                            formData.append(input.name, input.value);
                        }
                    });
                });

                myDropzone.on("successmultiple", function(files, response) {
                    window.location.href = '{{ route("backend.monitoring.cvw.index") }}';
                });

                myDropzone.on("errormultiple", function(files, response) {
                    console.error(response);
                });
            }
        };
    </script>
@endpush

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Ubah Civil Work</h2>
        <a href="{{ route('backend.monitoring.cvw.index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded inline-block">
            Kembali
        </a>
    </div>

    <form id="cvw-form" method="POST" action="{{ route('backend.monitoring.cvw.update', $cvw->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="timeline_id" class="block text-gray-700">Minggu Ke</label>
            <select name="timeline_id" id="timeline_id" class="w-full border border-gray-300 rounded p-2" required>
                <option value="">--</option>
                @foreach ($timelines as $tmm)
                    <option value="{{ $tmm->id }}" {{ ($tmm->id ==  $cvw->timeline_id) ? 'selected' : '' }} >{{ $tmm->timeline_week }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="location_id" class="block text-gray-700">Lokasi</label>
            <select name="location_id" id="location_id" class="w-full border border-gray-300 rounded p-2" required>
                <option value="">--</option>
                @foreach ($locations as $locc)
                    <option value="{{ $locc->id }}" {{ ($locc->id ==  $cvw->location_id) ? 'selected' : '' }}>{{ $locc->location_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label for="cvw_plan" class="block text-gray-700">Rencana</label>
            <input type="number" step="0.01" id="cvw_plan" name="cvw_plan" value="{{ $cvw->cvw_plan }}"
                class="w-full border border-gray-300 rounded p-2" required>
        </div>
        <div class="mb-4">
            <label for="cvw_plan_cumulative" class="block text-gray-700">Rencana Kumulatif</label>
            <input type="number" step="0.01" id="cvw_plan_cumulative" value="{{ $cvw->cvw_plan_cumulative }}"
                name="cvw_plan_cumulative" class="w-full border border-gray-300 rounded p-2" required>
        </div>
        <div class="mb-4">
            <label for="cvw_real" class="block text-gray-700">Realisasi</label>
            <input type="number" step="0.01" id="cvw_real" name="cvw_real" value="{{ $cvw->cvw_real }}"
                class="w-full border border-gray-300 rounded p-2" required>
        </div>
        <div class="mb-4">
            <label for="cvw_real_cumulative" class="block text-gray-700">Realisasi Kumulatif</label>
            <input type="number" step="0.01" id="cvw_real_cumulative" value="{{ $cvw->cvw_real_cumulative }}"
                name="cvw_real_cumulative" class="w-full border border-gray-300 rounded p-2" required>
        </div>
        <div class="mb-4">
            <label for="cvw_deviasi" class="block text-gray-700">Deviasi</label>
            <input type="number" step="0.01" id="cvw_deviasi" name="cvw_deviasi" value="{{ $cvw->cvw_deviasi }}"
                class="w-full border border-gray-300 rounded p-2" required>
        </div>
        <input type="hidden" name="deleted_images" id="deleted_images" value="">
        <div class="mb-4">
            <label for="cvw_galleries" class="block text-sm font-medium text-gray-700">Gallery Images</label>
            <div id="dropzone" class="dropzone mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <div class="dz-message" data-dz-message><span>Drag and drop images here or click to upload</span></div>
            </div>
        </div>
        <div id="image-descriptions" class="space-y-4"></div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Ubah</button>
    </form>
</div>
@endsection
