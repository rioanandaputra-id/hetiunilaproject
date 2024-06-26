@extends('template')

@section('content')
<div class="container mx-auto p-6 bg-gray-50 min-h-screen">
    <h1 class="text-3xl font-extrabold mb-6 text-center text-blue-800">MONITORING PMSC</h1>

    {{-- Flash Message --}}
    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

    {{-- Error Handling - No Meetings Found --}}
    @if ($meetings->isEmpty())
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">No meetings found.</span>
        </div>
    @endif

    {{-- Filter and Create Meeting Form --}}
    <form method="GET" action="{{ route('meetings.index') }}" class="mb-6 bg-white shadow-lg rounded-lg p-6 border border-gray-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" id="date" name="date" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" value="{{ request('date') }}">
            </div>

            <div>
                <label for="week" class="block text-sm font-medium text-gray-700">Week</label>
                <input type="number" id="week" name="week" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" value="{{ request('week') }}">
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded hover:bg-blue-900 transition duration-300 mr-2">Filter</button>
            <a href="{{ route('meetings.create') }}" class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800 transition duration-300">Create Meeting</a>
        </div>
    </form>

    {{-- Meetings List --}}
    <div class="grid grid-cols-1 gap-6">
        @forelse ($meetings as $meeting)
            <div class="border rounded-lg p-6 bg-white shadow-md hover:shadow-lg transition duration-300 border-gray-300">
                <div class="bg-gray-500 p-5 text-white rounded-t-lg">
                    <h2 class="text-xl font-bold mb-2">MINGGU {{ $meeting->meeting_week }}</h2>

                    {{-- Meeting Information in Two Columns --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <p class="mb-2"><strong>Date:</strong> {{ $meeting->meeting_date }}</p>
                            <p class="mb-2"><strong>Location:</strong> {{ $meeting->meeting_location }}</p>
                        </div>
                        <div>
                            <p class="mb-2"><strong>Agenda:</strong> {{ $meeting->meeting_agenda }}</p>
                            <p class="mb-2"><strong>Agenda (EN):</strong> {{ $meeting->meeting_agenda_en }}</p>
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
                    <form action="{{ route('meetings.destroy', $meeting) }}" method="POST" class="ml-2 delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition duration-300 delete-button">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            {{-- No meetings found --}}
            <div class="border rounded-lg p-6 bg-white shadow-md border-gray-300">
                <p class="text-gray-600 text-center">No meetings found.</p>
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
