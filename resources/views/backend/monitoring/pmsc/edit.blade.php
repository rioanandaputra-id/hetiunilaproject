@extends('backend._template.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script>
        Dropzone.options.dropzone = {
            url: '{{ route('backend.monitoring.pmsc.update', $meeting) }}',
            paramName: 'gallery_images', // Set the parameter name for the uploaded files
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
                var form = document.getElementById('meeting-form');

                // Load existing gallery images into Dropzone
                @foreach ($meeting->meetingGallery as $gallery)
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

                    var formInputs = form.querySelectorAll('input, textarea');
                    formInputs.forEach(input => {
                        if (input.type !== 'file') {
                            formData.append(input.name, input.value);
                        }
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
<div class="container mx-auto p-6 bg-gray-50 min-h-screen mt-5 rounded-lg shadow-lg">
    <h1 class="text-3xl font-extrabold text-center text-blue-700 mb-6">Edit Meeting</h1>

    <form id="meeting-form" method="POST" action="{{ route('backend.monitoring.pmsc.update', $meeting) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="meeting_week" class="block text-sm font-medium text-gray-700">Minggu Ke-</label>
            <input type="number" id="meeting_week" name="meeting_week" value="{{ $meeting->meeting_week }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="meeting_date" class="block text-sm font-medium text-gray-700">Meeting Date</label>
            <input type="datetime-local" id="meeting_date" name="meeting_date" value="{{ \Carbon\Carbon::parse($meeting->meeting_date)->format('Y-m-d\TH:i') }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="meeting_location" class="block text-sm font-medium text-gray-700">Meeting Location</label>
            <input type="text" id="meeting_location" name="meeting_location" value="{{ $meeting->meeting_location }}" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="meeting_agenda" class="block text-sm font-medium text-gray-700">Meeting Agenda</label>
            <textarea id="meeting_agenda" name="meeting_agenda" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ $meeting->meeting_agenda }}</textarea>
        </div>

        <div>
            <label for="meeting_agenda_en" class="block text-sm font-medium text-gray-700">Meeting Agenda (EN)</label>
            <textarea id="meeting_agenda_en" name="meeting_agenda_en" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ $meeting->meeting_agenda_en }}</textarea>
        </div>

        <input type="hidden" name="deleted_images" id="deleted_images" value="">

        <div>
            <label for="gallery_images" class="block text-sm font-medium text-gray-700">Gallery Images</label>
            <div id="dropzone" class="dropzone mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <div class="dz-message" data-dz-message><span>Drag and drop images here or click to upload</span></div>
            </div>
        </div>

        <div id="image-descriptions" class="space-y-4"></div>

        <div class="flex justify-center">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50 transition">Update</button>
        </div>
    </form>
</div>
@endsection
