@extends('backend._template.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
@endpush


@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script>
        Dropzone.options.dropzone = {
            url: '{{ route('backend.monitoring.pmsc.store') }}',
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
                var form = document.getElementById('pmsc-form');

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

                myDropzone.on("sendingmultiple", function(data, xhr, formData) {
                    var descriptions = document.querySelectorAll('textarea[name="descriptions[]"]');
                    descriptions.forEach((textarea, index) => {
                        formData.append('descriptions[' + index + ']', textarea.value);
                    });

                    // Append pmsc_galleries files to formData
                    myDropzone.files.forEach(function(file) {
                        formData.append('pmsc_galleries[]', file);
                    });

                    var formInputs = form.querySelectorAll('input, textarea, select');
                    formInputs.forEach(input => {
                        formData.append(input.name, input.value);
                    });
                });

                myDropzone.on("successmultiple", function(files, response) {
                    window.location.href = '{{ route("backend.monitoring.pmsc.index") }}';
                });

                myDropzone.on("errormultiple", function(files, response) {
                    console.error(response);
                });
            }
        };
    </script>
@endpush



@section('content')
<div class="mx-auto p-6 min-h-screen">
    <h1 class="text-3xl font-extrabold text-center text-blue-700 mb-6">Create Meeting</h1>

    <form id="pmsc-form" method="POST" action="{{ route('backend.monitoring.pmsc.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label for="pmsc_week" class="block text-sm font-medium text-gray-700">Minggu Ke-</label>
            <select name="timeline_id" id="timeline_id" class="w-full border border-gray-300 rounded p-2" required>
                <option value="">--</option>
                @foreach ($timelines as $tmm)
                    <option value="{{ $tmm->id }}">{{ $tmm->timeline_week }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="pmsc_date" class="block text-sm font-medium text-gray-700">Meeting Date</label>
            <input type="datetime-local" id="pmsc_date" name="pmsc_date" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label for="pmsc_location" class="block text-sm font-medium text-gray-700">Meeting Location</label>
            <input type="text" id="pmsc_location" name="pmsc_location" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div>
            <label for="pmsc_agenda" class="block text-sm font-medium text-gray-700">Meeting Agenda</label>
            <textarea id="pmsc_agenda" name="pmsc_agenda" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required></textarea>
        </div>

        <div>
            <label for="pmsc_agenda_en" class="block text-sm font-medium text-gray-700">Meeting Agenda (EN)</label>
            <textarea id="pmsc_agenda_en" name="pmsc_agenda_en" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required></textarea>
        </div>

        <div>
            <label for="pmsc_galleries" class="block text-sm font-medium text-gray-700">Gallery Images</label>
            <div id="dropzone" class="dropzone mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <div class="dz-message" data-dz-message><span>Drag and drop images here or click to upload</span></div>
            </div>
        </div>

        <div id="image-descriptions" class="space-y-4"></div>

        <div class="flex justify-center">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition">Create</button>
        </div>
    </form>
</div>
@endsection
