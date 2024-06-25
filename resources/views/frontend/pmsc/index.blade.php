@extends('frontend._template.app')

@section('content')
    <div class="mx-auto p-6 min-h-screen">

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-1 mb-2">
            <div class="mb-6 bg-white shadow-lg rounded-lg p-6 border border-gray-300">
                <div class="mb-4 bg-gray-500 text-white p-3 rounded-lg">
                    <h1 class="text-xl font-extrabold text-center text-white">
                        MONITORING PMSC
                    </h1>
                </div>
                <form method="GET" action="{{ route('monitoring.pmsc.indexxx') }}" onchange="this.form.submit()">
                    <select name="timeline_id" id="timeline_id" class="w-full border border-gray-300 rounded p-2" required>
                        @foreach ($timelines as $tmm)
                            <option value="{{ $tmm->id }}" @if (request()->get('timeline_id') == $tmm->id || (request()->get('timeline_id') == null && $tmm->is_active)) selected @endif>MINGGU KE
                                {{ $tmm->timeline_week }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        <div id="pmsc-container" class="grid grid-cols-1 gap-6">
            @include('frontend.pmsc.partials.pmsc_list', ['pmscs' => $pmscs])
        </div>

        @if ($pmscs->hasMorePages())
            <div class="flex justify-center mt-6">
                <button id="load-more"
                    class="px-4 py-2 bg-blue-800 text-white rounded hover:bg-blue-900 transition duration-300">Load
                    More</button>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let nextPageUrl = '{{ $pmscs->nextPageUrl() }}';

            const loadMoreButton = document.getElementById('load-more');
            const pmscContainer = document.getElementById('pmsc-container');

            loadMoreButton.addEventListener('click', function() {
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
        });
    </script>
@endsection
