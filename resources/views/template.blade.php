<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSPTN UNILA</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />

    @stack('css')
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <header class="bg-white shadow">
        <div class="container mx-auto flex items-center justify-between py-4">
            <div class="flex items-center space-x-1">
                <img src="{{ asset('assets/logo/default.PNG') }}" alt="Logo" class="h-10">
            </div>
            <nav class="flex space-x-6">
                <a href="/" class="text-orange-500 font-semibold">BERANDA</a>
                <div class="relative">
                    <button class="text-gray-700">MONITORING</button>
                    <div class="absolute mt-2 w-48 bg-white shadow-lg rounded hidden">
                        <a href="/" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Civil Work</a>
                        <a href="/meetings" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">PMSC</a>
                    </div>
                </div>
                <a href="/about" class="text-gray-700">TENTANG</a>
                <a href="/contact" class="text-gray-700">KONTAK</a>
            </nav>
        </div>
    </header>

    @yield('content')


    <footer class="bg-white shadow mt-8">
        <div class="container mx-auto py-4 flex justify-between items-center">
            <p>&copy; 2024 All rights reserved.</p>
            <div class="flex space-x-4">
                <a href="#" class="text-gray-400">Privacy Policy</a>
                <a href="#" class="text-gray-400">Terms of Service</a>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <script>
        document.querySelector('button').addEventListener('click', function() {
            const dropdown = this.nextElementSibling;
            dropdown.classList.toggle('hidden');
        });
    </script>

    @stack('js')
</body>

</html>
