@extends('backend._template.app')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-6">Edit Proyek</h1>
        <form action="{{ route('backend.masterdata.project.update', $project->id) }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nama Proyek -->
            <div>
                <label for="projectName" class="block text-sm font-medium text-gray-700">Nama Proyek</label>
                <input type="text" id="projectName" name="projectName" value="{{ $project->project_name }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Logo Proyek -->
            <div>
                <label for="projectLogo" class="block text-sm font-medium text-gray-700">Logo Proyek</label>
                <input type="file" id="projectLogo" name="projectLogo" accept="image/*"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                    onchange="previewImage(event)">
                <img src="{{ Storage::url($project->project_logo) }}" id="preview" class="mt-2" style="max-width: 200px; max-height: 200px;">
            </div>

            <!-- Tanggal Mulai dan Selesai -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="startDate" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                    <input type="date" id="startDate" name="startDate" value="{{ $project->project_start }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="endDate" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                    <input type="date" id="endDate" name="endDate" value="{{ $project->project_end }}"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Jumlah Hari dan Minggu -->
            <div>
                <label for="durationDays" class="block text-sm font-medium text-gray-700">Jumlah Hari</label>
                <input type="number" id="durationDays" name="durationDays" value="{{ $project->project_day }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="durationWeeks" class="block text-sm font-medium text-gray-700">Jumlah Minggu</label>
                <input type="number" id="durationWeeks" name="durationWeeks" value="{{ $project->project_week }}"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Tombol Simpan -->
            <div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Ubah</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            var input = event.target.files[0];
            var reader = new FileReader();
            reader.onload = function() {
                var imgElement = document.getElementById('preview');
                imgElement.src = reader.result;
            }
            reader.readAsDataURL(input);
        }
    </script>
@endsection
