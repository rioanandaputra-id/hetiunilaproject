@extends('backend._template.app')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script>
        Dropzone.options.dropzone = {
            url: '{{ route('backend.monitoring.cvw.store') }}',
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 10,
            maxFiles: 10,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            init: function() {
                var myDropzone = this;
                var form = document.getElementById('cvw-form');

                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    if (myDropzone.getQueuedFiles().length > 0) {
                        myDropzone.processQueue();
                    } else {
                        form.submit();
                    }
                });

                myDropzone.on("addedfile", function(file) {
                    var descriptionInput = document.createElement('textarea');
                    descriptionInput.setAttribute('name', 'descriptions[]');
                    descriptionInput.setAttribute('class',
                        'mt-2 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500'
                        );
                    descriptionInput.setAttribute('placeholder', 'Enter image description');
                    file.previewElement.appendChild(descriptionInput);
                });

                myDropzone.on("sendingmultiple", function(data, xhr, formData) {
                    var descriptions = document.querySelectorAll('textarea[name="descriptions[]"]');
                    descriptions.forEach((textarea, index) => {
                        formData.append('descriptions[' + index + ']', textarea.value);
                    });

                    myDropzone.files.forEach(function(file) {
                        formData.append('cvw_galleries[]', file);
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
                    if (response.errors && response.errors.duplicate) {
                        var errorMessage = document.createElement('div');
                        errorMessage.className = 'text-red-500 mb-4';
                        errorMessage.innerText = response.errors.duplicate[0];
                        form.insertBefore(errorMessage, form.firstChild);
                    }
                });
            }
        };
    </script>
@endpush

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Tambah Civil Work</h2>
            <a href="{{ route('backend.monitoring.cvw.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded inline-block">
                Kembali
            </a>
        </div>

        @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

        @if ($errors->has('duplicate'))
            <div class="text-red-500">{{ $errors->first('duplicate') }}</div>
        @endif

        <form id="cvw-form" method="POST" action="{{ route('backend.monitoring.cvw.store') }}" enctype="multipart/form-data"
            class="space-y-6">
            @csrf

            <div class="mb-4">
                <label for="timeline_id" class="block text-gray-700">Minggu Ke</label>
                <select name="timeline_id" id="timeline_id" class="w-full border border-gray-300 rounded p-2" required>
                    <option value="">--</option>
                    @foreach ($timelines as $tmm)
                        <option value="{{ $tmm->id }}">{{ $tmm->timeline_week }}</option>
                    @endforeach
                </select>
                @error('timeline_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="location_id" class="block text-gray-700">Lokasi</label>
                <select name="location_id" id="location_id" class="w-full border border-gray-300 rounded p-2" required>
                    <option value="">--</option>
                    @foreach ($locations as $locc)
                        <option value="{{ $locc->id }}">{{ $locc->location_name }}</option>
                    @endforeach
                </select>
                @error('location_id')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cvw_plan" class="block text-gray-700">Rencana</label>
                <input type="number" step="0.01" value="0.00" id="cvw_plan" name="cvw_plan"
                    class="w-full border border-gray-300 rounded p-2" required>
                @error('cvw_plan')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cvw_plan_cumulative" class="block text-gray-700">Rencana Kumulatif</label>
                <input type="number" step="0.01" value="0.00" id="cvw_plan_cumulative" name="cvw_plan_cumulative"
                    class="w-full border border-gray-300 rounded p-2" required>
                @error('cvw_plan_cumulative')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cvw_real" class="block text-gray-700">Realisasi</label>
                <input type="number" step="0.01" value="0.00" id="cvw_real" name="cvw_real"
                    class="w-full border border-gray-300 rounded p-2" required>
                @error('cvw_real')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cvw_real_cumulative" class="block text-gray-700">Realisasi Kumulatif</label>
                <input type="number" step="0.01" value="0.00" id="cvw_real_cumulative" name="cvw_real_cumulative"
                    class="w-full border border-gray-300 rounded p-2" required>
                @error('cvw_real_cumulative')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cvw_deviasi" class="block text-gray-700">Deviasi</label>
                <input type="number" step="0.01" value="0.00" id="cvw_deviasi" name="cvw_deviasi"
                    class="w-full border border-gray-300 rounded p-2" required>
                @error('cvw_deviasi')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="cvw_galleries" class="block text-sm font-medium text-gray-700">Gallery Images</label>
                <div id="dropzone"
                    class="dropzone mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <div class="dz-message" data-dz-message><span>Drag and drop images here or click to upload</span></div>
                </div>
                @error('cvw_galleries')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Simpan</button>
        </form>
    </div>
@endsection
