@extends('backend._template.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Ubah Civil Work</h2>
            <a href="{{ route('backend.monitoring.cvw.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded inline-block">
                Kembali
            </a>
        </div>

        <form action="{{ route('backend.monitoring.cvw.update', $targets->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="timeline_id" class="block text-gray-700">Minggu Ke</label>
                <select name="timeline_id" id="timeline_id" class="w-full border border-gray-300 rounded p-2" required>
                    <option value="">--</option>
                    @foreach ($timelines as $tmm)
                        <option value="{{ $tmm->id }}" {{ ($tmm->id ==  $targets->timeline_id) ? 'selected' : '' }} >{{ $tmm->time_week }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="location_id" class="block text-gray-700">Lokasi</label>
                <select name="location_id" id="location_id" class="w-full border border-gray-300 rounded p-2" required>
                    <option value="">--</option>
                    @foreach ($locations as $locc)
                        <option value="{{ $locc->id }}" {{ ($locc->id ==  $targets->location_id) ? 'selected' : '' }}>{{ $locc->location_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="plan_kumulatif" class="block text-gray-700">Rencana</label>
                <input type="number" id="plan_kumulatif" name="plan_kumulatif" value="{{ $targets->plan_kumulatif }}" class="w-full border border-gray-300 rounded p-2" required>
            </div>
            <div class="mb-4">
                <label for="real_kumulatif" class="block text-gray-700">Realisasi</label>
                <input type="number" id="real_kumulatif" name="real_kumulatif" value="{{ $targets->real_kumulatif }}" class="w-full border border-gray-300 rounded p-2" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Ubah</button>
        </form>
    </div>
@endsection
