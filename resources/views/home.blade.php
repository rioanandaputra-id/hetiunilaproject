<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSPTN UNILA</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <div class="m-5 space-y-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="text-2xl font-bold text-blue-800 mb-4 text-center md:mb-0 rounded-lg">
                {{ $data['project_name'] }}
            </div>

            <div class="flex space-x-4">
                <img src="{{ asset('assets/logo/'. $data['project_logo']) }}" alt="" width="250px" height="auto">
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="flex justify-between items-center mb-4 bg-gray-500 text-white p-3 rounded-lg">
                <div>
                    PROGRESS MINGGU KE-{{ $data['target_weekly']['current']['time_week'] }}
                </div>
            </div>
            <div class="mt-3 text-gray-700">
                <div>Periode: Minggu {{ $data['target_weekly']['current']['time_week'] }}</div>
                <div>Tanggal: {{ tanggal($data['target_weekly']['current']['time_start']) }} s/d
                    {{ tanggal($data['target_weekly']['current']['time_end']) }}</div>
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <table class="table-auto w-full border-collapse border border-white-200">
                        <thead>
                            <tr class="bg-gray-500 text-white">
                                <td colspan="3" class="text-center py-2">Waktu Pelaksanaan:
                                    {{ tanggal($data['project_start']) }} s/d {{ tanggal($data['project_end']) }}</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 border">Kontrak</th>
                                <th class="py-2 px-4 border">Terpakai</th>
                                <th class="py-2 px-4 border">Sisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border">{{ $data['project_day'] }} Hari Kalender</td>
                                <td class="py-2 px-4 border">{{ $data['project_day_usage'] }} Hari</td>
                                <td class="py-2 px-4 border">{{ $data['project_day_limit'] }} Hari</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">{{ $data['project_week'] }} Minggu</td>
                                <td class="py-2 px-4 border">{{ $data['project_week_usage'] }} Minggu</td>
                                <td class="py-2 px-4 border">{{ $data['project_week_limit'] }} Minggu</td>
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
                                <td class="py-2 px-4 border">{{ $data['target_weekly']['current']['plan_kumulatif'] }}%
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">Realisasi Kumulatif</td>
                                <td class="py-2 px-4 border">{{ $data['target_weekly']['current']['real_kumulatif'] }}%
                                </td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">Deviasi</td>
                                <td class="py-2 px-4 border">
                                    {{ $data['target_weekly']['current']['deviasi_kumulatif'] }}%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <div class="block mb-4 text-bold bg-gray-500 text-white p-2 rounded-lg">Grafik Progres Pekerjaan Semua Lokasi
                    </div>
                    <canvas id="ctxBar1"></canvas>
                </div>
                <div>
                    <div class="block mb-4 text-bold bg-gray-500 text-white p-2 rounded-lg">Grafik Progres Pekerjaan Tiap Gedung
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
                            <th colspan="9" class="text-center py-2">Monitoring Progress Pekerjaan Minggu ke-{{ $data['target_weekly']['current']['time_week'] }} :
                                {{ tanggal($data['target_weekly']['current']['time_start']) }} s/d
                                {{ tanggal($data['target_weekly']['current']['time_end']) }} </th>
                        </tr>
                        <tr>
                            <th rowspan="2" class="py-2 px-4 border">Uraian</th>
                            <th colspan="3" class="text-center py-2 px-4 border">Rencana Kumulatif</th>
                            <th colspan="3" class="text-center py-2 px-4 border">Realisasi Kumultif</th>
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
                        <tr>
                            <td class="py-2 px-4 border">SEMUA LOKASI</td>
                            <td class="py-2 px-4 border">{{ $data['target_weekly']['last']['plan_kumulatif'] }}%</td>
                            <td class="py-2 px-4 border">{{ $data['target_weekly']['current']['plan_kumulatif'] }}%
                            </td>
                            <td class="py-2 px-4 border">
                                {{ $all_plan_kumulatif = $data['target_weekly']['current']['plan_kumulatif'] + $data['target_weekly']['last']['plan_kumulatif'] }}%
                            </td>

                            <td class="py-2 px-4 border">{{ $data['target_weekly']['last']['real_kumulatif'] }}%</td>
                            <td class="py-2 px-4 border">{{ $data['target_weekly']['current']['real_kumulatif'] }}%
                            </td>
                            <td class="py-2 px-4 border">
                                {{ $all_real_kumulatif = $data['target_weekly']['last']['real_kumulatif'] + $data['target_weekly']['current']['real_kumulatif'] }}%
                            </td>

                            <td class="py-2 px-4 border">{{ $all_real_kumulatif - $all_plan_kumulatif }}%</td>
                            <td class="py-2 px-4 border">{{ 100 - $all_real_kumulatif }}%</td>
                        </tr>

                        @foreach ($data['target_weekly']['current']['target'] as $index => $target)
                            <tr>
                                <td class="py-2 px-4 border">{{ $target['location_name'] }}</td>
                                <td class="py-2 px-4 border">
                                    {{ $data['target_weekly']['last']['target'][$index]['plan_kumulatif'] }}%</td>
                                <td class="py-2 px-4 border">
                                    {{ $data['target_weekly']['current']['target'][$index]['plan_kumulatif'] }}%</td>
                                <td class="py-2 px-4 border">
                                    {{ $all_plan_kumulatif = $data['target_weekly']['current']['target'][$index]['plan_kumulatif'] + $data['target_weekly']['last']['target'][$index]['plan_kumulatif'] }}%
                                </td>

                                <td class="py-2 px-4 border">
                                    {{ $data['target_weekly']['last']['target'][$index]['real_kumulatif'] }}%</td>
                                <td class="py-2 px-4 border">
                                    {{ $data['target_weekly']['current']['target'][$index]['real_kumulatif'] }}%</td>
                                <td class="py-2 px-4 border">
                                    {{ $all_real_kumulatif = $data['target_weekly']['current']['target'][$index]['real_kumulatif'] + $data['target_weekly']['last']['target'][$index]['real_kumulatif'] }}%
                                </td>

                                <td class="py-2 px-4 border">{{ $all_real_kumulatif - $all_plan_kumulatif }}%</td>
                                <td class="py-2 px-4 border">{{ 100 - $all_real_kumulatif }}%</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <div class="overflow-x-auto mt-4">
                <table class="table-auto w-full border-collapse border border-white-200">
                    <thead class="bg-gray-500 text-white">
                        <tr>
                            <th class="text-center py-2 border" colspan="2">Rencana Minggu Depan</th>
                            <th class="text-center py-2 border">Minggu
                                {{ $data['target_weekly']['next']['time_week'] }}</th>
                        </tr>
                        <tr>
                            <th class="text-center py-2 border" rowspan="2">Uraian</th>
                            <th class="text-center py-2 border" colspan="2">Rencana Kontrak</th>
                        </tr>
                        <tr>
                            <th class="text-center py-2 border">Rencana Mingguan</th>
                            <th class="text-center py-2 border">Rencana Kumulatif</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border">SEMUA LOKASI</td>
                            <td class="py-2 px-4 border">{{ $data['target_weekly']['current']['plan_kumulatif'] }}%
                            </td>
                            <td class="py-2 px-4 border">{{ $data['target_weekly']['next']['plan_kumulatif'] }}%</td>
                        </tr>
                        @foreach ($data['target_weekly']['current']['target'] as $index => $target)
                            <tr>
                                <td class="py-2 px-4 border">{{ $target['location_name'] }}</td>
                                <td class="py-2 px-4 border">
                                    {{ $data['target_weekly']['current']['target'][$index]['plan_kumulatif'] }}%</td>
                                <td class="py-2 px-4 border">
                                    {{ $data['target_weekly']['next']['target'][$index]['plan_kumulatif'] }}%</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="block mb-4 text-bold bg-gray-500 text-white p-3 rounded-lg">PROGRES PEKERJAAN (PHOTO) MINGGU {{ $data['target_weekly']['current']['time_week'] }}</div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($data['gallery'] as $gl)
                <a href="{{ asset('assets/gallery/'. $gl->gallery_image) }}" data-fancybox="gallery" class="block" data-caption="{{ $gl->gallery_desc }}">
                    <img src="{{ asset('assets/gallery/'. $gl->gallery_image) }}" alt="{{ $gl->gallery_desc }}" class="w-full h-auto shadow-md">
                    <figcaption class="bg-gray-200 p-2">{{ $gl->gallery_desc }}</figcaption>
                    </a>
                @endforeach
            </div>
        </div>


        <div class="text-gray-700 mt-4">
            PROJECT MANAGMENT AND SUPERVISION CONSULTANT | PT. CIRIJASA MANDIRI | CONTRACT NO. {{  $data['project_number'] }}
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function() {
            $("[data-fancybox]").fancybox({});
            grafik_1();
            grafik_2();
            grafik_3();
        });

        function grafik_1() {
            const ctxBar1 = document.getElementById("ctxBar1").getContext("2d");
            const targetWeekly = @json($data['target_weekly']);
            const labels = [`M${targetWeekly.last.time_week}`, `M${targetWeekly.current.time_week}`];
            const planKumulatif = [targetWeekly.last.plan_kumulatif, targetWeekly.current.plan_kumulatif];
            const realKumulatif = [targetWeekly.last.real_kumulatif, targetWeekly.current.real_kumulatif];

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
            const target = @json($data['target_weekly']['current']['target']);
            const labels = target.map(item => item.location_name);
            const planKumulatif = target.map(item => parseFloat(item.plan_kumulatif));
            const realKumulatif = target.map(item => parseFloat(item.real_kumulatif));

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
            const targetAll = @json($data['target_all']);
            const planKumulatif = targetAll.map(item => item.plan_kumulatif !== null ? parseFloat(item.plan_kumulatif) : 0);
            const weeks = targetAll.map(item => item.time_week);

            function getRealKumulatif() {
                let realKumulatif = [];
                let isActiveFound = false;

                for (const item of targetAll) {
                    if (item.is_active === 1) {
                        isActiveFound = true;
                    }
                    if (isActiveFound && item.time_week > targetAll.find(i => i.is_active === 1).time_week) {
                        break;
                    }
                    realKumulatif.push(item.real_kumulatif !== null ? parseFloat(item.real_kumulatif) : 0);
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
</body>

</html>
