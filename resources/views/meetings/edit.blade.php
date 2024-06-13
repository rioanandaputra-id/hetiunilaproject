@extends('template')
@section('content')
    <h1 class="text-2xl font-bold">Edit Meeting</h1>

    <form method="POST" action="{{ route('meetings.update', $meeting) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="project_id" class="block text-sm font-medium text-gray-700">Project ID</label>
            <input type="number" id="project_id" name="project_id" value="{{ $meeting->project_id }}" class="mt-1 block w-full">
        </div>

        <div class="mb-4">
            <label for="meeting_date" class="block text-sm font-medium text-gray-700">Meeting Date</label>
            <input type="datetime-local" id="meeting_date" name="meeting_date" value="{{ $meeting->meeting_date }}" class="mt-1 block w-full">
        </div>

        <div class="mb-4">
            <label for="meeting_location" class="block text-sm font-medium text-gray-700">Meeting Location</label>
            <input type="text" id="meeting_location" name="meeting_location" value="{{ $meeting->meeting_location }}" class="mt-1 block w-full">
        </div>

        <div class="mb-4">
            <label for="meeting_agenda" class="block text-sm font-medium text-gray-700">Meeting Agenda</label>
            <textarea id="meeting_agenda" name="meeting_agenda" class="mt-1 block w-full">{{ $meeting->meeting_agenda }}</textarea>
        </div>

        <div class="mb-4">
            <label for="meeting_agenda_en" class="block text-sm font-medium text-gray-700">Meeting Agenda (EN)</label>
            <textarea id="meeting_agenda_en" name="meeting_agenda_en" class="mt-1 block w-full">{{ $meeting->meeting_agenda_en }}</textarea>
        </div>

        <div class="mb-4">
            <label for="gallery_images" class="block text-sm font-medium text-gray-700">Gallery Images</label>
            <input type="file" id="gallery_images" name="gallery_images[]" multiple class="mt-1 block w-full">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Update</button>
    </form>
@endsection
