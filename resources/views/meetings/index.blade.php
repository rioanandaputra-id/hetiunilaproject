@extends('template')
@section('content')
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold mb-4">Meetings</h1>
        <a href="{{ route('meetings.create') }}"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Create New
            Meeting</a>
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @foreach ($meetings as $meeting)
                <div class="mb-4">
                    <h2 class="text-xl font-semibold">{{ $meeting->meeting_agenda }}</h2>
                    <p>Date: {{ $meeting->meeting_date }}</p>
                    <p>Location: {{ $meeting->meeting_location }}</p>
                    <p>Agenda (EN): {{ $meeting->meeting_agenda_en }}</p>
                    <a href="{{ route('meetings.show', $meeting->id) }}"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">View</a>
                </div>
                <hr class="my-4">
            @endforeach
        </div>
    </div>
@endsection
