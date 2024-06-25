@extends('frontend._template.app')
@push('css')
    <style>
        .tab-button.active {
            background-color: #3b82f6;
            color: #ffffff;
        }
        .tab-button {
            cursor: pointer;
            background-color: #d1d5db;
            color: #1f2937;
        }
        .gallery {
            display: none;
        }
        .gallery.active {
            display: block;
        }
    </style>
@endpush

@section('content')
    <div class="m-5 space-y-4">
        <div class="p-6 bg-white shadow rounded-lg">
            <div class="mb-4 bg-gray-500 text-white p-3 rounded-lg">
                <h1 class="text-xl font-extrabold text-center text-white">
                    MONITORING CIVIL WORK
                </h1>
            </div>
            <div class="mt-3 text-gray-700">
                <div>Periode:
                    <select name="timeline_id" id="timeline_id" class="border border-black rounded p-1 text-black">
                        @foreach ($timelines as $tm)
                            <option value="{{ $tm->id }}">MINGGU KE-{{ $tm->timeline_week }}</option>
                        @endforeach
                    </select>
                </div>
                <div>Tanggal: {{ tanggal($data->timelines->current->timeline_start) }} s/d {{ tanggal($data->timelines->current->timeline_end) }}</div>
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <table class="table-auto w-full border-collapse border border-white-200">
                        <thead>
                            <tr class="bg-gray-500 text-white">
                                <td colspan="3" class="text-center py-2">Waktu Kontrak: {{ tanggal($data->project->project_start) }} s/d {{ tanggal($data->project->project_end) }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 border">Kontrak</th>
                                <th class="py-2 px-4 border">Terpakai</th>
                                <th class="py-2 px-4 border">Sisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border">{{ $data->project->project_day }} Hari Kalender</td>
                                <td class="py-2 px-4 border">{{ $data->project->project_day_usage }} Hari</td>
                                <td class="py-2 px-4 border">{{ $data->project->project_day_limit }} Hari</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">{{ $data->project->project_week }} Minggu</td>
                                <td class="py-2 px-4 border">{{ $data->project->project_week_usage }} Minggu</td>
                                <td class="py-2 px-4 border">{{ $data->project->project_week_limit }} Minggu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <table class="table-auto w-full border-collapse border border-white-200">
                        <thead class="bg-gray-500 text-white">
                            <tr>
                                <td colspan="2" class="text-center py-2">Progress Kontrak Berdasarkan Kurva S</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border">Rencana Kumulatif</td>
                                <td class="py-2 px-4 border">{{ $data->timelines->current->sum_cvw_plan_cumulative }}%
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">Realisasi Kumulatif</td>
                                <td class="py-2 px-4 border">{{ $data->timelines->current->sum_cvw_real_cumulative }}%
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">Deviasi</td>
                                <td class="py-2 px-4 border">{{ $data->timelines->current->sum_cvw_deviasi }}%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <div class="block mb-4 text-bold bg-gray-500 text-white p-2 rounded-lg">Grafik Progres Pekerjaan Semua
                        Lokasi
                    </div>
                    <canvas id="ctxBar1"></canvas>
                </div>
                <div>
                    <div class="block mb-4 text-bold bg-gray-500 text-white p-2 rounded-lg">Grafik Progres Pekerjaan Tiap
                        Gedung
                    </div>
                    <canvas id="ctxBar2"></canvas>
                </div>
            </div>
            <div class="mt-4">
                <div class="block mb-4 text-bold bg-gray-500 text-white p-2 rounded-lg">Kurva Master Plan</div>
                <canvas id="ctxLine"></canvas>
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-white-200">
                    <thead class="bg-gray-500 text-white">
                        <tr class="bg-gray-500 text-white">
                            <th colspan="9" class="text-center py-2">Monitoring Progress Pekerjaan Minggu ke-{{$data->timelines->current->timeline_week }} :
                                {{ tanggal($data->timelines->current->timeline_start) }} s/d
                                {{ tanggal($data->timelines->current->timeline_end) }}
                            </th>
                        </tr>
                        <tr>
                            <th rowspan="2" class="py-2 px-4 border">Uraian</th>
                            <th colspan="3" class="text-center py-2 px-4 border">Rencana</th>
                            <th colspan="3" class="text-center py-2 px-4 border">Realisasi</th>
                            <th rowspan="2" class="py-2 px-4 border">Deviasi</th>
                            <th rowspan="2" class="py-2 px-4 border">Sisa Progress</th>
                        </tr>
                        <tr>
                            <th class="py-2 px-4 border">s/d Minggu Lalu</th>
                            <th class="py-2 px-4 border">Progress Minggu Ini</th>
                            <th class="py-2 px-4 border">s/d Minggu Ini</th>
                            <th class="py-2 px-4 border">s/d Minggu Lalu</th>
                            <th class="py-2 px-4 border">Progress Minggu Ini</th>
                            <th class="py-2 px-4 border">s/d Minggu Ini</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->timelines->current->cvws as $index => $cvw)
                            <tr>
                                <td class="py-2 px-4 border">{{ $cvw->location_name }}</td>
                                <td class="py-2 px-4 border">{{ $data->timelines->last->cvws[$index]->cvw_plan_cumulative }}%</td>
                                <td class="py-2 px-4 border">{{ $cvw->cvw_plan }}%</td>
                                <td class="py-2 px-4 border">{{ $cvw->cvw_plan_cumulative }}%</td>
                                <td class="py-2 px-4 border">{{ $data->timelines->last->cvws[$index]->cvw_real_cumulative }}%</td>
                                <td class="py-2 px-4 border">{{ $cvw->cvw_real }}%</td>
                                <td class="py-2 px-4 border">{{ $cvw->cvw_real_cumulative }}</td>
                                <td class="py-2 px-4 border">{{ $cvw->cvw_deviasi }}%</td>
                                <td class="py-2 px-4 border">{{ $cvw->location_bobot - $cvw->cvw_real_cumulative }}%</td>
                            </tr>
                        @endforeach
                        <tr class="font-semibold bg-gray-200">
                            <td class="py-2 px-4 border">SEMUA LOKASI</td>
                            <td class="py-2 px-4 border">{{ $data->timelines->last->sum_cvw_plan_cumulative }}%</td>
                            <td class="py-2 px-4 border">{{ $data->timelines->current->sum_cvw_plan }}%</td>
                            <td class="py-2 px-4 border">{{ $data->timelines->current->sum_cvw_plan_cumulative }}%</td>
                            <td class="py-2 px-4 border">{{ $data->timelines->last->sum_cvw_real_cumulative }}%</td>
                            <td class="py-2 px-4 border">{{ $data->timelines->current->sum_cvw_real }}%</td>
                            <td class="py-2 px-4 border">{{ $data->timelines->current->sum_cvw_real_cumulative }}%</td>
                            <td class="py-2 px-4 border">{{ $data->timelines->current->sum_cvw_deviasi }}%</td>
                            <td class="py-2 px-4 border">{{ $data->timelines->current->sum_location_bobot - $data->timelines->current->sum_cvw_deviasi }}%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="block mb-4 text-bold bg-gray-500 text-white p-3 rounded-lg">PROGRES PEKERJAAN (PHOTO) MINGGU {{$data->timelines->current->timeline_week }}</div>
            <div class="flex space-x-4 border-b-2 mb-4">
                @foreach($data->timelines->current->cvws as $index => $cvw)
                    <button
                        class="tab-button py-2 px-4 rounded-t-lg focus:outline-none @if($index == 0) active @endif"
                        onclick="showGallery('{{ $cvw->location_name }}', this)">
                        {{ $cvw->location_name }}
                    </button>
                @endforeach
            </div>
            <div class="gallery-container">
                @foreach($data->timelines->current->cvws as $index => $cvw)
                    <div id="{{ $cvw->location_name }}" class="gallery @if($index == 0) active @endif">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            @forelse ($data->timelines->current->cvws[$index]->galleries as $gallery)
                                <a href="{{ Storage::url($gallery->gallery_image) }}" data-fancybox="gallery" class="block"
                                    data-caption="{{ $gallery->gallery_desc }}">
                                    <img src="{{ Storage::url($gallery->gallery_image) }}" alt="{{ $gallery->gallery_desc }}"
                                        class="w-full h-auto shadow-md">
                                    <figcaption class="bg-gray-200 p-2">{{ $gallery->gallery_desc }}</figcaption>
                                </a>
                            @empty
                                <p>No images available</p>
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    function showGallery(location, btn) {
        document.querySelectorAll('.gallery').forEach(gallery => {
            gallery.classList.remove('active');
        });
        document.getElementById(location).classList.add('active');
        document.querySelectorAll('.tab-button').forEach(button => {
            button.classList.remove('active');
        });
        btn.classList.add('active');
    }

    document.addEventListener('DOMContentLoaded', () => {
        let defaultTab = document.querySelector('.tab-button.active');
        if (defaultTab) {
            defaultTab.click();
        }
        $("[data-fancybox]").fancybox({});
        grafik_1();
        grafik_2();
        grafik_3();
    });

    function grafik_1() {
            const ctxBar1 = document.getElementById("ctxBar1").getContext("2d");
            const timelines = @json($data->timelines);
            const labels = [`Minggu ${timelines.last.timeline_week}`, `Minggu ${timelines.current.timeline_week}`];
            const planKumulatif = [timelines.last.sum_cvw_plan_cumulative, timelines.current.sum_cvw_plan_cumulative];
            const realKumulatif = [timelines.last.sum_cvw_real_cumulative, timelines.current.sum_cvw_real_cumulative];

            const chart = new Chart(ctxBar1, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Rencana Kumulatif',
                        backgroundColor: "gray",
                        data: planKumulatif,
                        stack: 'Stack 0',
                    }, {
                        label: 'Realisasi Kumulatif',
                        backgroundColor: "green",
                        data: realKumulatif,
                        stack: 'Stack 1'
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y + '%';
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
    }

    function grafik_2() {
            const ctxBar2 = document.getElementById("ctxBar2").getContext("2d");
            const cvws = @json($data->timelines->current->cvws);
            const labels = cvws.map(item => item.location_name);
            const planKumulatif = cvws.map(item => parseFloat(item.cvw_plan_cumulative));
            const realKumulatif = cvws.map(item => parseFloat(item.cvw_real_cumulative));

            new Chart(ctxBar2, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Rencana Kumulatif',
                        backgroundColor: "gray",
                        data: planKumulatif,
                        stack: 'Stack 0',
                    }, {
                        label: 'Realisasi Kumulatif',
                        backgroundColor: "green",
                        data: realKumulatif,
                        stack: 'Stack 1'
                    }],
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += context.parsed.y + '%';
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
    }

    function grafik_3() {

        const ctxLine = document.getElementById("ctxLine").getContext("2d");
        const targetAll = @json($data->charts);
        const planKumulatif = targetAll.map(item => item.cvw_plan_cumulative !== null ? parseFloat(item.cvw_plan_cumulative) : 0);
        const weeks = targetAll.map(item => item.timeline_week);

        function getRealKumulatif() {
            let realKumulatif = [];
            let isActiveFound = false;

            for (const item of targetAll) {
                if (item.is_selected === true) {
                    isActiveFound = true;
                }
                if (isActiveFound && item.timeline_week > targetAll.find(i => i.is_selected === true).timeline_week) {
                    break;
                }
                realKumulatif.push(item.cvw_real_cumulative !== null ? parseFloat(item.cvw_real_cumulative) : 0);
            }

            return realKumulatif;
        }

        const realKumulatif = getRealKumulatif();

        const chart = new Chart(ctxLine, {
            type: "line",
            data: {
                labels: weeks,
                datasets: [{
                        label: "Rencana Kumulatif",
                        data: planKumulatif,
                        borderColor: "gray",
                        fill: false,
                    },
                    {
                        label: "Realisasi Kumulatif",
                        data: realKumulatif.concat(new Array(planKumulatif.length - realKumulatif.length)
                            .fill(null)),
                        borderColor: "orange",
                        fill: false,
                    }
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed.y !== null) {
                                    label += context.parsed.y + '%';
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
        }
</script>
@endpush
