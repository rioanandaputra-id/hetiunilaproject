@extends('template')
@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Meeting Details</h1>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl font-semibold">{{ $meeting->meeting_agenda }}</h2>
            <p>Date: {{ $meeting->meeting_date }}</p>
            <p>Location: {{ $meeting->meeting_location }}</p>
            <p>Agenda (EN): {{ $meeting->meeting_agenda_en }}</p>
            <h3 class="text-lg font-semibold mt-4">Gallery</h3>
            <div class="grid grid-cols-3 gap-4">
                @foreach ($meeting->galleries as $gallery)
                    <div class="border rounded overflow-hidden">
                        <img src="{{ Storage::url($gallery->gallery_image) }}" alt="Gallery Image"
                            class="w-full h-48 object-cover">
                        <p class="p-2">{{ $gallery->gallery_desc }}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <a href="{{ route('meetings.index') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Back to Meetings</a>
    </div>
@endsection
