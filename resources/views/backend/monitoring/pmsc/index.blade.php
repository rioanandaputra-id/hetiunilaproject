@extends('backend._template.app')

@section('content')
<div class="mx-auto p-6 min-h-screen">
    <h2 class="text-2xl font-semibold mb-4">MONITORING PMSC</h2>

    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif

    <form method="GET" action="{{ route('backend.monitoring.pmsc.index') }}" class="mb-6 bg-white shadow-lg rounded-lg p-6 border border-gray-300">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" id="date" name="date" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500" value="{{ request('date') }}">
            </div>

            <div>
                <label for="timeline_id" class="block text-sm font-medium text-gray-700">Minggu</label>
                <select name="timeline_id" id="timeline_id" class="w-full border border-gray-300 rounded p-2" required>
                    <option value="">--</option>
                    @foreach ($timelines as $tmm)
                        <option value="{{ $tmm->id }}">{{ $tmm->timeline_week }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded hover:bg-blue-900 transition duration-300 mr-2">Filter</button>
            <a href="{{ route('backend.monitoring.pmsc.create') }}" class="px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800 transition duration-300">Tambah Data</a>
        </div>
    </form>

    <div id="pmsc-container" class="grid grid-cols-1 gap-6">
        @include('backend.monitoring.pmsc.partials.pmsc_list', ['pmscs' => $pmscs])
    </div>

    @if ($pmscs->hasMorePages())
        <div class="flex justify-center mt-6">
            <button id="load-more" class="px-4 py-2 bg-blue-800 text-white rounded hover:bg-blue-900 transition duration-300">Load More</button>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let nextPageUrl = '{{ $pmscs->nextPageUrl() }}';

        const loadMoreButton = document.getElementById('load-more');
        const pmscContainer = document.getElementById('pmsc-container');

        loadMoreButton.addEventListener('click', function () {
            if (nextPageUrl) {
                fetch(nextPageUrl)
                    .then(response => response.json())
                    .then(data => {
                        pmscContainer.insertAdjacentHTML('beforeend', data.pmscs);
                        nextPageUrl = data.next_page_url;

                        if (!nextPageUrl) {
                            loadMoreButton.style.display = 'none';
                        }
                    })
                    .catch(error => console.error('Error fetching more PMSCs:', error));
            }
        });

        const deleteButtons = document.querySelectorAll('.delete-button');
        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                const confirmation = confirm('Are you sure you want to delete this meeting?');
                if (!confirmation) {
                    event.preventDefault();
                }
            });
        });
    });
</script>
@endsection
