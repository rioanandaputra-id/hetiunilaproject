<!-- resources/views/backend/monitoring/pmsc/partials/pmsc_list.blade.php -->
@forelse ($pmscs as $pmsc)
    <div class="border rounded-lg p-6 bg-white shadow-md hover:shadow-lg transition duration-300 border-gray-300">
        <div class="bg-gray-500 p-5 text-white rounded-t-lg">
            <h2 class="text-xl font-bold mb-2">MINGGU {{ $pmsc->timeline_week }}</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="mb-2"><strong>Date:</strong> {{ $pmsc->pmsc_date }}</p>
                    <p class="mb-2"><strong>Location:</strong> {{ $pmsc->pmsc_location }}</p>
                </div>
                <div>
                    <p class="mb-2"><strong>Agenda:</strong> {{ $pmsc->pmsc_agenda }}</p>
                    <p class="mb-2"><strong>Agenda (EN):</strong> {{ $pmsc->pmsc_agenda_en }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
            @foreach ($pmsc->pmscGallery as $gallery)
                <div class="mb-4">
                    <img src="{{ Storage::url($gallery->gallery_image) }}" alt="Gallery Image"
                        class="w-full h-auto rounded-lg shadow-md">
                    <p class="text-gray-600 mt-2">{{ $gallery->gallery_desc }}</p>
                </div>
            @endforeach
        </div>
    </div>
@empty
    <p>Tidak ada data PMSC</p>
@endforelse
