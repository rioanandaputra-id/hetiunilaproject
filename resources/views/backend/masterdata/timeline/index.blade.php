@extends('backend._template.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Daftar Timeline</h2>
            <a href="{{ route('backend.masterdata.timeline.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded inline-block">
                Tambah Timeline
            </a>
        </div>

        <table id="timeline-table" class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Tgl. Mulai</th>
                    <th class="px-4 py-2">Tgl. Selesai</th>
                    <th class="px-4 py-2">Minggu Ke</th>
                    <th class="px-4 py-2">Jumlah Hari</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
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
            $('#timeline-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('backend.masterdata.timeline.data') }}",
                columns: [{
                        data: 'time_start',
                        name: 'time_start'
                    },
                    {
                        data: 'time_end',
                        name: 'time_end'
                    },
                    {
                        data: 'time_week',
                        name: 'time_week'
                    },
                    {
                        data: 'time_day',
                        name: 'time_day'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
            });
        });
    </script>
@endpush
