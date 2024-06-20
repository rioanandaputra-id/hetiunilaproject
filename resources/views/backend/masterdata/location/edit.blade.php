@extends('backend._template.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Edit Lokasi</h2>
            <a href="{{ route('backend.masterdata.location.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded inline-block">
                Kembali
            </a>
        </div>

        <form action="{{ route('backend.masterdata.location.update', $location->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="location_name" class="block text-gray-700">Nama Lokasi</label>
                <input type="text" id="location_name" name="location_name" class="w-full border border-gray-300 rounded p-2" value="{{ $location->location_name }}" required>
            </div>
            <div class="mb-4">
                <label for="location_percent" class="block text-gray-700">Bobot</label>
                <input type="number" id="location_percent" name="location_percent" class="w-full border border-gray-300 rounded p-2" value="{{ $location->location_percent }}" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Ubah</button>
        </form>
    </div>
@endsection
