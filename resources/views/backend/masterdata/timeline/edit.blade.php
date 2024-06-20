@extends('backend._template.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Edit Timeline</h2>
            <a href="{{ route('backend.masterdata.timeline.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded inline-block">
                Kembali
            </a>
        </div>

        <form action="{{ route('backend.masterdata.timeline.update', $timeline->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="time_start" class="block text-gray-700">Tgl. Mulai</label>
                <input type="date" id="time_start" name="time_start" class="w-full border border-gray-300 rounded p-2" value="{{ $timeline->time_start }}" required>
            </div>
            <div class="mb-4">
                <label for="time_end" class="block text-gray-700">Tgl. Selesai</label>
                <input type="date" id="time_end" name="time_end" class="w-full border border-gray-300 rounded p-2" value="{{ $timeline->time_end }}" required>
            </div>
            <div class="mb-4">
                <label for="time_week" class="block text-gray-700">Minggu Ke</label>
                <input type="number" id="time_week" name="time_week" class="w-full border border-gray-300 rounded p-2" value="{{ $timeline->time_week }}" required>
            </div>
            <div class="mb-4">
                <label for="time_day" class="block text-gray-700">Jumlah Hari</label>
                <input type="number" id="time_day" name="time_day" class="w-full border border-gray-300 rounded p-2" value="{{ $timeline->time_day }}" required>
            </div>
            <div class="mb-4">
                <label for="is_active" class="block text-gray-700">Status</label>
                <select name="is_active" id="is_active" class="w-full border border-gray-300 rounded p-2" required>
                    <option value="{{ $timeline->is_active }}" {{ ($timeline->is_active == true) ? 'selected' : '' }}>Aktif</option>
                    <option value="{{ $timeline->is_active }}" {{ ($timeline->is_active == false) ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Ubah</button>
        </form>
    </div>
@endsection
