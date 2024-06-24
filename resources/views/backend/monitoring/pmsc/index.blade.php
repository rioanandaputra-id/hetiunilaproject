@extends('backend._template.app')

@section('content')
<div class="mx-auto p-6 min-h-screen">
    <h2 class="text-2xl font-semibold mb-4">MONITORING PMSC</h2>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

    <form method="GET" action="{{ route('backend.monitoring.pmsc.index') }}" class="mb-6 bg-white shadow-lg rounded-lg p-6 border border-gray-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" id="date" name="date" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" value="{{ request('date') }}">
            </div>

            <div>
                <label for="timeline_id" class="block text-sm font-medium text-gray-700">Minggu</label>
                <select name="timeline_id" id="timeline_id" class="w-full border border-gray-300 rounded p-2" required>
                    <option value="">--</option>
                    @foreach ($timelines as $tmm)
                        <option value="{{ $tmm->id }}">{{ $tmm->timeline_week }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded hover:bg-blue-900 transition duration-300 mr-2">Filter</button>
            <a href="{{ route('backend.monitoring.pmsc.create') }}" class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800 transition duration-300">Tambah Data</a>
        </div>
    </form>

    <div class="grid grid-cols-1 gap-6">
        @forelse ($pmscs as $pmsc)
            <div class="border rounded-lg p-6 bg-white shadow-md hover:shadow-lg transition duration-300 border-gray-300">
                <div class="bg-gray-500 p-5 text-white rounded-t-lg">
                    <h2 class="text-xl font-bold mb-2">MINGGU {{ $pmsc->meeting_week }}</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="mb-2"><strong>Date:</strong> {{ $pmsc->meeting_date }}</p>
                            <p class="mb-2"><strong>Location:</strong> {{ $pmsc->meeting_location }}</p>
                        </div>
                        <div>
                            <p class="mb-2"><strong>Agenda:</strong> {{ $pmsc->meeting_agenda }}</p>
                            <p class="mb-2"><strong>Agenda (EN):</strong> {{ $pmsc->meeting_agenda_en }}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                    @foreach ($pmsc->pmscGallery as $gallery)
                        <div class="mb-4">
                            <img src="{{ Storage::url($gallery->gallery_image) }}" alt="Gallery Image" class="w-full h-auto rounded-lg shadow-md">
                            <p class="text-gray-600 mt-2">{{ $gallery->gallery_desc }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-end items-center mt-4">
                    <a href="{{ route('backend.monitoring.pmsc.edit', $pmsc) }}" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 transition duration-300">Edit</a>
                    <form action="{{ route('backend.monitoring.pmsc.destroy', $pmsc) }}" method="POST" class="ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition duration-300">Delete</button>
                    </form>
                </div>

            </div>
        @empty
            <div class="border rounded-lg p-6 bg-white shadow-md border-gray-300">
                <p class="text-gray-600 text-center">Tidak Ada Data</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                const confirmation = confirm('Are you sure you want to delete this meeting?');
                if (!confirmation) {
                    event.preventDefault();
                }
            });
        });
    });
</script>
@endsection