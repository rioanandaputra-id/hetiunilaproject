@extends('template')
@section('content')
    <h1 class="text-2xl font-bold">{{ $meeting->meeting_agenda }}</h1>
    <p>Date: {{ $meeting->meeting_date }}</p>
    <p>Location: {{ $meeting->meeting_location }}</p>
    <p>Agenda (EN): {{ $meeting->meeting_agenda_en }}</p>

    <div class="mt-4">
        @foreach ($meeting->meetingGallery as $gallery)
            <div class="mb-4">
                <img src="{{ Storage::url($gallery->gallery_image) }}" alt="Gallery Image" class="w-full h-auto">
                <p>{{ $gallery->gallery_desc }}</p>
            </div>
        @endforeach
    </div>

    <a href="{{ route('meetings.edit', $meeting) }}" class="px-4 py-2 bg-yellow-500 text-white rounded">Edit</a>
    <form action="{{ route('meetings.destroy', $meeting) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Delete</button>
    </form>
@endsection
