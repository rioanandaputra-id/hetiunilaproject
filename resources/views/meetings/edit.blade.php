@extends('template')
@section('content')

<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-6">Edit Meeting</h1>

    <form action="{{ route('meetings.update', $meeting->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title:</label>
            <input type="text" name="title" id="title" value="{{ $meeting->title }}" class="border border-gray-300 p-2 rounded w-full" required>
        </div>

        <div class="mb-4">
            <label for="date" class="block text-gray-700">Date:</label>
            <input type="date" name="date" id="date" value="{{ $meeting->date }}" class="border border-gray-300 p-2 rounded w-full" required>
        </div>

        <div class="mb-4">
            <label for="time" class="block text-gray-700">Time:</label>
            <input type="time" name="time" id="time" value="{{ $meeting->time }}" class="border border-gray-300 p-2 rounded w-full" required>
        </div>

        <div class="mb-4">
            <label for="location" class="block text-gray-700">Location:</label>
            <input type="text" name="location" id="location" value="{{ $meeting->location }}" class="border border-gray-300 p-2 rounded w-full" required>
        </div>

        <div class="mb-4">
            <label for="agenda" class="block text-gray-700">Agenda:</label>
            <textarea name="agenda" id="agenda" class="border border-gray-300 p-2 rounded w-full" required>{{ $meeting->agenda }}</textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>

@endsection
