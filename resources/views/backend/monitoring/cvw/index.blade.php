@extends('backend._template.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-semibold">MONITORING CIVIL WORK</h2>
            <a href="{{ route('backend.monitoring.cvw.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded inline-block">
                Tambah Civil Work
            </a>
        </div>

        <table id="cvw-table" class="table-auto w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2">Minggu</th>
                    <th class="px-4 py-2">Lokasi</th>
                    <th class="px-4 py-2">Rencana</th>
                    <th class="px-4 py-2">Realisasi</th>
                    {{-- <th class="px-4 py-2">Diviasi</th>
                    <th class="px-4 py-2">Progres</th> --}}
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>

            </tbody>
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
        $('#cvw-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('backend.monitoring.cvw.data') }}",
            columns: [
                { data: 'time_week', name: 'time_week' },
                { data: 'location_name', name: 'location_name' },
                { data: 'plan_kumulatif', name: 'plan_kumulatif' },
                { data: 'real_kumulatif', name: 'real_kumulatif' },
                // { data: 'deviasi', name: 'deviasi' },
                // { data: 'progress', name: 'progress' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ],
        });
    });
</script>
@endpush
