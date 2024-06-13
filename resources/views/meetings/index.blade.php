@extends('template')

@section('content')
<div class="container mx-auto p-4 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-bold mb-4 text-center text-blue-800">MONITORING PMSC</h1>

    {{-- Filter and Create Meeting Form --}}
    <form method="GET" action="{{ route('meetings.index') }}" class="mb-4 bg-white shadow-md rounded-lg p-6 border border-gray-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" id="date" name="date" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>

            <div>
                <label for="week" class="block text-sm font-medium text-gray-700">Week</label>
                <input type="number" id="week" name="week" class="mt-1 block w-full border border-gray-300 rounded-md p-2">
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded hover:bg-blue-900 transition duration-300 mr-2">Filter</button>
            <a href="{{ route('meetings.create') }}" class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800 transition duration-300">Create Meeting</a>
        </div>
    </form>

    {{-- Meetings List --}}
    <div class="grid grid-cols-1 gap-4">
        @foreach ($meetings as $meeting)
            <div class="border rounded-lg p-6 bg-white shadow-md hover:shadow-lg transition duration-300 border-gray-300">

                <div class="bg-gray-500 p-5 text-white">
                    <h2 class="text-xl font-bold mb-2 ">MINGGU 14</h2>

                    {{-- Meeting Information in Two Columns --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class=" mb-2"><strong>Date:</strong> {{ $meeting->meeting_date }}</p>
                            <p class=" mb-2"><strong>Location:</strong> {{ $meeting->meeting_location }}</p>
                        </div>
                        <div>
                            <p class=" mb-2"><strong>Agenda:</strong> {{ $meeting->meeting_agenda }}</p>
                            <p class=" mb-2"><strong>Agenda (EN):</strong> {{ $meeting->meeting_agenda_en }}</p>
                        </div>
                    </div>
                </div>

                {{-- Meeting Gallery --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                    @foreach ($meeting->meetingGallery as $gallery)
                        <div class="mb-4">
                            <img src="{{ Storage::url($gallery->gallery_image) }}" alt="Gallery Image" class="w-full h-auto rounded-lg shadow-md">
                            <p class="text-gray-600 mt-2">{{ $gallery->gallery_desc }}</p>
                        </div>
                    @endforeach
                </div>

                {{-- Actions --}}
                <div class="flex justify-end items-center mt-4">
                    <a href="{{ route('meetings.edit', $meeting) }}" class="px-4 py-2 bg-yellow-600 text-white rounded hover:bg-yellow-700 transition duration-300">Edit</a>
                    <form action="{{ route('meetings.destroy', $meeting) }}" method="POST" class="ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition duration-300">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
