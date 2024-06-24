@extends('backend._template.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Tambah Timeline</h2>
            <a href="{{ route('backend.masterdata.timeline.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded inline-block">
                Kembali
            </a>
        </div>

        <form action="{{ route('backend.masterdata.timeline.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="timeline_start" class="block text-gray-700">Tgl. Mulai</label>
                <input type="date" id="timeline_start" name="timeline_start" class="w-full border border-gray-300 rounded p-2" required>
            </div>
            <div class="mb-4">
                <label for="timeline_end" class="block text-gray-700">Tgl. Selesai</label>
                <input type="date" id="timeline_end" name="timeline_end" class="w-full border border-gray-300 rounded p-2" required>
            </div>
            <div class="mb-4">
                <label for="timeline_week" class="block text-gray-700">Minggu Ke</label>
                <input type="number" id="timeline_week" name="timeline_week" class="w-full border border-gray-300 rounded p-2" required>
            </div>
            <div class="mb-4">
                <label for="timeline_day" class="block text-gray-700">Jumlah Hari</label>
                <input type="number" id="timeline_day" name="timeline_day" class="w-full border border-gray-300 rounded p-2" required>
            </div>
            <div class="mb-4">
                <label for="is_active" class="block text-gray-700">Status</label>
                <select name="is_active" id="is_active" class="w-full border border-gray-300 rounded p-2" required>
                    <option value=1>Aktif</option>
                    <option value=0>Tidak Aktif</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Simpan</button>
        </form>
    </div>
@endsection
