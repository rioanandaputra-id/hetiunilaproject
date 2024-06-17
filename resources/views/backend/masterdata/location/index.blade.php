@extends('backend._template.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">Daftar Lokasi</h2>
            <a href="{{ route('backend.masterdata.location.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded inline-block">
                Tambah Lokasi
            </a>
        </div>

        <table id="location-table" class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nama Lokasi</th>
                    <th class="px-4 py-2">Presentase</th>
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
            $('#location-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('backend.masterdata.location.data') }}",
                columns: [
                    { data: 'location_name', name: 'location_name' },
                    { data: 'location_percent', name: 'location_percent' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
            });
        });
    </script>
@endpush
