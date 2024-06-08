<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex">
        <div class="w-64 bg-blue-900 text-white h-screen">
            <div class="p-6">
                <h1 class="text-2xl font-bold">Admin Dashboard</h1>
            </div>
            <ul>
                <li class="p-4 hover:bg-blue-700 cursor-pointer" id="masterDataMenu">MASTER DATA</li>
                <ul id="masterDataSubmenu" class="hidden">
                    <li class="p-4 pl-8 hover:bg-blue-700 cursor-pointer" id="proyekSubmenu">PROYEK</li>
                    <li class="p-4 pl-8 hover:bg-blue-700 cursor-pointer" id="lokasiSubmenu">LOKASI</li>
                    <li class="p-4 pl-8 hover:bg-blue-700 cursor-pointer" id="adminSubmenu">ADMIN</li>
                </ul>
                <li class="p-4 hover:bg-blue-700 cursor-pointer" id="mainMenu">MAIN MENU</li>
                <ul id="mainMenuSubmenu" class="hidden">
                    <li class="p-4 pl-8 hover:bg-blue-700 cursor-pointer" id="entryProgressSubmenu">ENTRY PROGRESS</li>
                </ul>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-10">
            <!-- Form Container -->
            <div id="formContainer"></div>
        </div>
    </div>

    <script>
        document.getElementById('masterDataMenu').addEventListener('click', function() {
            document.getElementById('masterDataSubmenu').classList.toggle('hidden');
        });

        document.getElementById('mainMenu').addEventListener('click', function() {
            document.getElementById('mainMenuSubmenu').classList.toggle('hidden');
        });

        document.getElementById('proyekSubmenu').addEventListener('click', function() {
            loadForm('proyek');
        });

        document.getElementById('lokasiSubmenu').addEventListener('click', function() {
            loadForm('lokasi');
        });

        document.getElementById('adminSubmenu').addEventListener('click', function() {
            loadForm('admin');
        });

        document.getElementById('entryProgressSubmenu').addEventListener('click', function() {
            loadForm('entryProgress');
        });

        function loadForm(formType) {
            let formContainer = document.getElementById('formContainer');
            formContainer.innerHTML = '';

            switch(formType) {
                case 'proyek':
                    formContainer.innerHTML = `
                        <h2 class="text-xl font-bold mb-4">Form Proyek</h2>
                        <form class="space-y-4">
                            <div>
                                <label for="nomorKontrak" class="block">Nomor Kontrak</label>
                                <input type="text" id="nomorKontrak" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="namaProyek" class="block">Nama Proyek</label>
                                <input type="text" id="namaProyek" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="tanggalMulai" class="block">Tanggal Mulai Kontrak</label>
                                <input type="date" id="tanggalMulai" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="tanggalSelesai" class="block">Tanggal Selesai Kontrak</label>
                                <input type="date" id="tanggalSelesai" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="totalHari" class="block">Total Hari Kontrak</label>
                                <input type="number" id="totalHari" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="totalMinggu" class="block">Total Minggu Kontrak</label>
                                <input type="number" id="totalMinggu" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="logoPerusahaan" class="block">Logo Perusahaan</label>
                                <input type="file" id="logoPerusahaan" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
                        </form>
                    `;
                    break;
                case 'lokasi':
                    formContainer.innerHTML = `
                        <h2 class="text-xl font-bold mb-4">Form Lokasi</h2>
                        <form class="space-y-4">
                            <div>
                                <label for="namaLokasi" class="block">Nama Lokasi</label>
                                <input type="text" id="namaLokasi" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
                        </form>
                    `;
                    break;
                case 'admin':
                    formContainer.innerHTML = `
                        <h2 class="text-xl font-bold mb-4">Form Admin</h2>
                        <form class="space-y-4">
                            <div>
                                <label for="namaLengkap" class="block">Nama Lengkap</label>
                                <input type="text" id="namaLengkap" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="username" class="block">Username</label>
                                <input type="text" id="username" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="password" class="block">Password</label>
                                <input type="password" id="password" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
                        </form>
                    `;
                    break;
                case 'entryProgress':
                    formContainer.innerHTML = `
                        <h2 class="text-xl font-bold mb-4">Form Entry Progress</h2>
                        <form class="space-y-4">
                            <div>
                                <label for="mingguKe" class="block">Minggu Ke</label>
                                <input type="number" id="mingguKe" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="tanggalMulai" class="block">Tanggal Mulai</label>
                                <input type="date" id="tanggalMulai" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="tanggalSelesai" class="block">Tanggal Selesai</label>
                                <input type="date" id="tanggalSelesai" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="pilihLokasi" class="block">Pilih Lokasi</label>
                                <input type="text" id="pilihLokasi" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="rencanaKumulatif" class="block">Rencana Kumulatif</label>
                                <input type="text" id="rencanaKumulatif" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="realisasiKumulatif" class="block">Realisasi Kumulatif</label>
                                <input type="text" id="realisasiKumulatif" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <div>
                                <label for="unggahProgress" class="block">Unggah Progress Pekerjaan</label>
                                <input type="file" id="unggahProgress" class="w-full p-2 border border-gray-300 rounded">
                            </div>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
                        </form>
                    `;
                    break;
            }
        }
    </script>
</body>
</html>
