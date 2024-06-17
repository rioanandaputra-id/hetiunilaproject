<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HETI UNILA</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar-collapsed {
            width: 64px;
        }
    </style>
    @stack('css')
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        @include('backend._template.sidebar')
        <div class="flex-1">
            @include('backend._template.navbar')

            <main class="p-6">
                @yield('content')
            </main>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarIcon = document.getElementById('sidebarIcon');
        const sidebarTitle = document.getElementById('sidebarTitle');
        const sidebarTextElements = document.querySelectorAll('.sidebar-text');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            if (sidebar.classList.contains('sidebar-collapsed')) {
                sidebarTitle.classList.add('hidden');
                sidebarIcon.classList.remove('fa-times');
                sidebarIcon.classList.add('fa-bars');
                sidebarTextElements.forEach(element => element.classList.add('hidden'));
            } else {
                sidebarTitle.classList.remove('hidden');
                sidebarIcon.classList.remove('fa-bars');
                sidebarIcon.classList.add('fa-times');
                sidebarTextElements.forEach(element => element.classList.remove('hidden'));
            }
        });
    </script>
    @stack('js')
</body>

</html>
