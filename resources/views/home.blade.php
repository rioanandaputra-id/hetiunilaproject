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
        <div class="text-2xl font-bold text-blue-800 mb-4 text-center">
            CWU CONTRUCTION BUILDING FOR RSPTN, IRC AND WWTP | UNIVERSITAS LAMPUNG
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="flex justify-between items-center mb-4">
                <div class="bg-green-500 p-2">
                    PROGRESS MINGGU KE-9
                </div>
                <div class="text-gray-700">
                    NOMOR : PMSC 009/LCWU-RSPTN HETI PROJECT/V/2024
                </div>
            </div>
            <div class="mt-3 text-gray-700">
                <div>Periode: Minggu 09</div>
                <div>Tanggal: 28 April 2024 - 04 Mei 2024</div>
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <table class="table-auto w-full border-collapse border border-white-200">
                        <thead>
                            <tr class="bg-gray-500">
                                <td colspan="3" class="text-center py-2">Waktu Pelaksanaan: 08 Maret 2023 s/d 30 Agustus 2025</td>
                            </tr>
                            <tr>
                                <th class="py-2 px-4 border">Kontrak</th>
                                <th class="py-2 px-4 border">Terpakai</th>
                                <th class="py-2 px-4 border">Sisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border">540 Hari Kalender</td>
                                <td class="py-2 px-4 border">57 Hari</td>
                                <td class="py-2 px-4 border">483 Hari</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">78 Minggu</td>
                                <td class="py-2 px-4 border">9 Minggu</td>
                                <td class="py-2 px-4 border">69 Minggu</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <table class="table-auto w-full border-collapse border border-white-200">
                        <thead class="bg-gray-500">
                            <tr>
                                <td colspan="2" class="text-center py-2">Progress Kontrak Berdasarkan Kurva S</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-2 px-4 border">Rencana Kumulatif</td>
                                <td class="py-2 px-4 border">0.12%</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">Realisasi Kumulatif</td>
                                <td class="py-2 px-4 border">0.34%</td>
                            </tr>
                            <tr>
                                <td class="py-2 px-4 border">Deviasi</td>
                                <td class="py-2 px-4 border">0.22%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <div class="block mb-4 text-bold bg-gray-500 p-2">Grafik Progres Pekerjaan Semua Lokasi</div>
                    <canvas id="ctxBar1"></canvas>
                </div>
                <div>
                    <div class="block mb-4 text-bold bg-gray-500 p-2">Grafik Progres Pekerjaan Tiap Gedung</div>
                    <canvas id="ctxBar2"></canvas>
                </div>
            </div>
            <div class="mt-4">
                <div class="block mb-4 text-bold bg-gray-500 p-2">Kurva Master Plan</div>
                <canvas id="ctxLine"></canvas>
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-lg">
            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-white-200">
                    <thead class="bg-gray-500">
                        <tr class="bg-gray-500">
                            <th colspan="9" class="text-center py-2">MONITORING PROGRESS PEKERJAAN MINGGU 09 28 APRIL S/D 04 MEI 2024</th>
                        </tr>
                        <tr>
                            <th rowspan="2" class="py-2 px-4 border">URAIAN</th>
                            <th colspan="3" class="text-center py-2 px-4 border">RENCANA KUMULATIF</th>
                            <th colspan="3" class="text-center py-2 px-4 border">REALISASI KUMULATIF</th>
                            <th rowspan="2" class="py-2 px-4 border">DEVIASI</th>
                            <th rowspan="2" class="py-2 px-4 border">SISA PROGRES</th>
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
                            <td class="py-2 px-4 border">0.10%</td>
                            <td class="py-2 px-4 border">0.20%</td>
                            <td class="py-2 px-4 border">0.12%</td>
                            <td class="py-2 px-4 border">0.27%</td>
                            <td class="py-2 px-4 border">0.07%</td>
                            <td class="py-2 px-4 border">0.34%</td>
                            <td class="py-2 px-4 border">0.22%</td>
                            <td class="py-2 px-4 border">99.66%</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border">RSPTN & IRC</td>
                            <td class="py-2 px-4 border">0.10%</td>
                            <td class="py-2 px-4 border">0.20%</td>
                            <td class="py-2 px-4 border">0.12%</td>
                            <td class="py-2 px-4 border">0.27%</td>
                            <td class="py-2 px-4 border">0.07%</td>
                            <td class="py-2 px-4 border">0.34%</td>
                            <td class="py-2 px-4 border">0.22%</td>
                            <td class="py-2 px-4 border">99.66%</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border">WWTP</td>
                            <td class="py-2 px-4 border">0.00%</td>
                            <td class="py-2 px-4 border">0.00%</td>
                            <td class="py-2 px-4 border">0.00%</td>
                            <td class="py-2 px-4 border">0.00%</td>
                            <td class="py-2 px-4 border">0.00%</td>
                            <td class="py-2 px-4 border">0.00%</td>
                            <td class="py-2 px-4 border">0.00%</td>
                            <td class="py-2 px-4 border">100.00%</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="overflow-x-auto mt-4">
                <table class="table-auto w-full border-collapse border border-white-200">
                    <thead class="bg-gray-500">
                        <tr>
                            <th colspan="3" class="text-center py-2">RENCANA MINGGU DEPAN</th>
                        </tr>
                        <tr>
                            <th class="py-2 px-4 border">URAIAN</th>
                            <th class="py-2 px-4 border">RENANA MINGGUAN</th>
                            <th class="py-2 px-4 border">RENCANA KUMULATIF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-2 px-4 border">SEMUA LOKASI</td>
                            <td class="py-2 px-4 border">0.02%</td>
                            <td class="py-2 px-4 border">0.13%</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border">RSPTN & IRC</td>
                            <td class="py-2 px-4 border">0.02%</td>
                            <td class="py-2 px-4 border">0.13%</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-4 border">WWTP</td>
                            <td class="py-2 px-4 border">0.00%</td>
                            <td class="py-2 px-4 border">0.00%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-gray-700 mt-4">
            PROJECT MANAGMENT AND SUPERVISION CONSULTANT | PT. CIRIJASA MANDIRI | CONTRACT NO. 6919/UN26/LK.032023
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function () {
            $("[data-fancybox]").fancybox({});
        });

        const ctxBar1 = document.getElementById("ctxBar1").getContext("2d");
        const ctxBar2 = document.getElementById("ctxBar2").getContext("2d");
        const ctxLine = document.getElementById("ctxLine").getContext("2d");

        new Chart(ctxBar1, {
            type: "bar",
            data: {
                labels: ["M1", "M9"],
                datasets: [{
                    label: 'RENCANA KUMULATIF',
                    backgroundColor: "gray",
                    data: [0.02, 0.12],
                    stack: 'Stack 0',
                }, {
                    label: 'REALISASI KUMULATIF',
                    backgroundColor: "green",
                    data: [0.20, 0.34],
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

        new Chart(ctxBar2, {
            type: "bar",
            data: {
                labels: ["RSPTN & IRC", "WWTP"],
                datasets: [{
                    label: 'RENCANA KUMULATIF',
                    backgroundColor: "gray",
                    data: [0.02, 0.12],
                    stack: 'Stack 0',
                }, {
                    label: 'REALISASI KUMULATIF',
                    backgroundColor: "green",
                    data: [0.20, 0.34],
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

        new Chart(ctxLine, {
            type: "line",
            data: {
                labels: ["Minggu 1", "Minggu 2", "Minggu 3", "Minggu 4", "Minggu 5", "Minggu 6", "Minggu 7", "Minggu 8", "Minggu 9"],
                datasets: [
                    {
                        label: "Rencana Kumulatif",
                        data: [0, 0.01, 0.03, 0.05, 0.07, 0.09, 0.11, 0.12, 0.12],
                        borderColor: "gray",
                        fill: false,
                    },
                    {
                        label: "Realisasi Kumulatif",
                        data: [0, 0.02, 0.04, 0.06, 0.10, 0.14, 0.20, 0.30, 0.34],
                        borderColor: "green",
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
    </script>
</body>

</html>
