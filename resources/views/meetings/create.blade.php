@extends('template')
@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Create Meeting</h1>
        {!! Form::open([
            'route' => 'meetings.store',
            'files' => true,
            'class' => 'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4',
            'id' => 'meetingForm',
        ]) !!}
        @csrf
        <div class="mb-4">
            {!! Form::label('project_id', 'Project ID:', ['class' => 'block text-gray-700 text-sm font-bold mb-2']) !!}
            {!! Form::text('project_id', null, [
                'class' =>
                    'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline',
            ]) !!}
        </div>
        <div class="mb-4">
            {!! Form::label('meeting_date', 'Meeting Date:', ['class' => 'block text-gray-700 text-sm font-bold mb-2']) !!}
            {!! Form::datetimeLocal('meeting_date', null, [
                'class' =>
                    'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline',
            ]) !!}
        </div>
        <div class="mb-4">
            {!! Form::label('meeting_location', 'Meeting Location:', [
                'class' => 'block text-gray-700 text-sm font-bold mb-2',
            ]) !!}
            {!! Form::text('meeting_location', null, [
                'class' =>
                    'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline',
            ]) !!}
        </div>
        <div class="mb-4">
            {!! Form::label('meeting_agenda', 'Meeting Agenda:', ['class' => 'block text-gray-700 text-sm font-bold mb-2']) !!}
            {!! Form::text('meeting_agenda', null, [
                'class' =>
                    'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline',
            ]) !!}
        </div>
        <div class="mb-4">
            {!! Form::label('meeting_agenda_en', 'Meeting Agenda (EN):', [
                'class' => 'block text-gray-700 text-sm font-bold mb-2',
            ]) !!}
            {!! Form::text('meeting_agenda_en', null, [
                'class' =>
                    'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline',
            ]) !!}
        </div>
        <div class="mb-4">
            {!! Form::label('gallery_images', 'Gallery Images:', ['class' => 'block text-gray-700 text-sm font-bold mb-2']) !!}
            <div class="dropzone" id="galleryDropzone"></div>
        </div>
        <div id="galleryImagesContainer"></div>
        <div class="flex items-center justify-between">
            {!! Form::submit('Save', [
                'class' =>
                    'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline',
            ]) !!}
        </div>
        {!! Form::close() !!}
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;
        const galleryDropzone = new Dropzone('#galleryDropzone', {
            url: '#',
            autoProcessQueue: false,
            addRemoveLinks: true,
            init: function() {
                this.on("addedfile", function(file) {
                    const removeButton = Dropzone.createElement(
                        "<button class='bg-red-500 text-white rounded px-2 py-1 mt-2'>Remove</button>"
                        );
                    const descriptionInput = Dropzone.createElement(
                        "<input type='text' name='descriptions[]' placeholder='Description' class='mt-2 border rounded w-full py-1 px-2' />"
                        );

                    // Add the button to the file preview element.
                    file.previewElement.appendChild(descriptionInput);
                    file.previewElement.appendChild(removeButton);

                    // Capture the Dropzone instance as closure.
                    const _this = this;

                    // Listen to the click event.
                    removeButton.addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        _this.removeFile(file);
                    });

                    const galleryImagesContainer = document.getElementById('galleryImagesContainer');
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'file';
                    hiddenInput.name = 'gallery_images[]';
                    hiddenInput.classList.add('hidden');
                    hiddenInput.files = file;

                    galleryImagesContainer.appendChild(hiddenInput);
                });
            }
        });

        document.getElementById('meetingForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const form = this;

            galleryDropzone.files.forEach(file => {
                if (file.upload) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'gallery_images[]';
                    input.value = file.upload.filename;
                    form.appendChild(input);
                }
            });

            form.submit();
        });
    </script>
@endpush
