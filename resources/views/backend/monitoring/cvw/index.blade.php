@extends('backend._template.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">MONITORING CIVIL WORK</h2>
            <a href="{{ route('backend.monitoring.cvw.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded inline-block">
                Tambah Civil Work
            </a>
        </div>


        @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

        <div class="mb-4">
            <label for="timeline_week_filter" class="block text-gray-700">Filter by Minggu</label>
            <select id="timeline_week_filter" class="w-full border border-gray-300 rounded p-2">
                <option value="">Pilih Minggu</option>
                @foreach ($timelines as $timeline)
                    <option value="{{ $timeline->timeline_week }}" {{ $timeline->is_active ? 'selected' : '' }}>
                        Minggu ke-{{ $timeline->timeline_week }}
                    </option>
                @endforeach
            </select>
        </div>

        <table id="cvw-table" class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">MINGGU</th>
                    <th class="px-4 py-2">LOKASI</th>
                    <th class="px-4 py-2">RENC. KUM.</th>
                    <th class="px-4 py-2">REAL. KUM.</th>
                    <th class="px-4 py-2">DEVIASI</th>
                    <th class="px-4 py-2">PROGRESS</th>
                    <th class="px-4 py-2">AKSI</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@push('js')
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#cvw-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('backend.monitoring.cvw.data') }}",
                    data: function (d) {
                        d.timeline_week = $('#timeline_week_filter').val();
                    }
                },
                columns: [
                    { data: 'timeline_week', name: 'timeline_week' },
                    { data: 'location_name', name: 'location_name' },
                    { data: 'cvw_plan_cumulative', name: 'cvw_plan_cumulative' },
                    { data: 'cvw_real_cumulative', name: 'cvw_real_cumulative' },
                    { data: 'cvw_deviasi', name: 'cvw_deviasi' },
                    { data: 'cvw_progress', name: 'cvw_progress' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
            });

            $('#timeline_week_filter').change(function() {
                table.draw();
            });
        });
    </script>
@endpush
