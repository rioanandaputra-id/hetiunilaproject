@extends('frontend._template.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script>
        Dropzone.options.dropzone = {
            url: '{{ route('meetings.store') }}', // Form submit URL
            autoProcessQueue: false, // Disable auto processing of files
            uploadMultiple: true, // Allow multiple file uploads
            parallelUploads: 10, // Number of files to upload in parallel
            maxFiles: 10, // Maximum number of files allowed
            addRemoveLinks: true, // Show remove links for uploaded files
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}" // CSRF token
            },
            init: function () {
                var myDropzone = this;
                var form = document.getElementById('meeting-form');

                // Handle form submission
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    // If files are queued for upload, process them
                    if (myDropzone.getQueuedFiles().length > 0) {
                        myDropzone.processQueue();
                    } else {
                        form.submit(); // Submit form if no files are queued
                    }
                });

                // Add a textarea for each added file to enter image description
                myDropzone.on("addedfile", function (file) {
                    var descriptionInput = document.createElement('textarea');
                    descriptionInput.setAttribute('name', 'descriptions[]');
                    descriptionInput.setAttribute('class', 'mt-2 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500');
                    descriptionInput.setAttribute('placeholder', 'Enter image description');
                    file.previewElement.appendChild(descriptionInput); // Append textarea to file preview
                });

                // Prepare formData before sending files
                myDropzone.on("sendingmultiple", function(data, xhr, formData) {
                    var descriptions = document.querySelectorAll('textarea[name="descriptions[]"]');
                    descriptions.forEach((textarea, index) => {
                        formData.append('descriptions[' + index + ']', textarea.value);
                    });

                    // Append gallery_images files to formData
                    myDropzone.files.forEach(function(file) {
                        formData.append('gallery_images[]', file);
                    });

                    // Append other form inputs to formData
                    var formInputs = form.querySelectorAll('input, textarea');
                    formInputs.forEach(input => {
                        formData.append(input.name, input.value);
                    });
                });

                // Handle successful upload
                myDropzone.on("successmultiple", function(files, response) {
                    window.location.href = '{{ route("meetings.index") }}'; // Redirect to meetings index after successful upload
                });

                // Handle upload errors
                myDropzone.on("errormultiple", function(files, response) {
                    console.error(response); // Log error message to console
                    alert('There was an error processing your request.'); // Display error message to user
                });
            }
        };
    </script>
@endpush

@section('content')
<div class="container mx-auto p-6 bg-gray-50 min-h-screen mt-5 rounded-lg shadow-lg">
    <h1 class="text-3xl font-extrabold text-center text-blue-700 mb-6">Create Meeting</h1>
    @include('layouts.notifications') <!-- Include any notification messages -->

    <form id="meeting-form" method="POST" action="{{ route('meetings.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf <!-- CSRF token for security -->

        <div class="mb-4">
            <label for="meeting_week" class="block text-sm font-medium text-gray-700">Week Number</label>
            <input type="number" id="meeting_week" name="meeting_week" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="meeting_date" class="block text-sm font-medium text-gray-700">Meeting Date</label>
            <input type="datetime-local" id="meeting_date" name="meeting_date" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="meeting_location" class="block text-sm font-medium text-gray-700">Meeting Location</label>
            <input type="text" id="meeting_location" name="meeting_location" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="meeting_agenda" class="block text-sm font-medium text-gray-700">Meeting Agenda</label>
            <textarea id="meeting_agenda" name="meeting_agenda" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required></textarea>
        </div>

        <div class="mb-4">
            <label for="meeting_agenda_en" class="block text-sm font-medium text-gray-700">Meeting Agenda (EN)</label>
            <textarea id="meeting_agenda_en" name="meeting_agenda_en" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" required></textarea>
        </div>

        <div class="mb-4">
            <label for="gallery_images" class="block text-sm font-medium text-gray-700">Gallery Images</label>
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
