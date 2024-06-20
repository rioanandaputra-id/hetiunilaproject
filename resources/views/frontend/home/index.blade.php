<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HETI - Universitas Lampung</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom Animations */
        .fade-in {
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .slide-in-bottom {
            animation: slideInBottom 1s ease-in-out;
        }

        @keyframes slideInBottom {
            from {
                transform: translateY(50%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .about-image {
        width: 300px;
        height: auto; /* Menjaga proporsi gambar */
        border-radius: 0.5rem; /* Menggunakan radius sudut */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Efek bayangan */
    }

/* CSS untuk video latar belakang penuh */
.video-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100vw; /* Mengatur lebar penuh */
    height: 100vh; /* Mengatur tinggi penuh */
    border: none;
    z-index: -1;
    pointer-events: none;
    object-fit: cover;
}

/* Overlay untuk meningkatkan keterbacaan teks */
.video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    z-index: 0; /* Pastikan overlay berada di depan video tetapi di belakang konten */
}


/* Styling untuk Section Monitoring */
#monitoring {
    background-color: #F3F4F6;
    padding: 2rem 0;
}

#monitoring h2 {
    color: #333;
    font-weight: 700;
    margin-bottom: 1rem;
}

#monitoring .tabs {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
}

#monitoring .tab-link {
    padding: 0.5rem 1rem;
    cursor: pointer;
    background-color: #D1D5DB;
    border: none;
    border-radius: 0.5rem;
    transition: background-color 0.3s ease;
}

#monitoring .tab-link.active {
    background-color: #4B5563;
    color: white;
}

#monitoring .tab-content {
    display: none;
}

#monitoring .tab-content.active {
    display: block;
}

#monitoring .flex {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

#monitoring .flex img {
    width: 100%;
    height: auto;
    border-radius: 0.5rem;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

#monitoring table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

#monitoring th,
#monitoring td {
    border: 1px solid #E5E7EB;
    padding: 0.5rem;
    text-align: left;
}


    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Header Section -->
    <header class="bg-white shadow text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center py-4 px-4">
            <a href="#hero" class="text-2xl font-bold"> <img src="{{ Storage::url('project_logos/default.PNG') }}" alt="Logo" class="h-10"></a>
            <nav class="hidden md:flex space-x-8">
                <a href="/" class="text-gray-800 font-semibold">HOME</a>
                <div class="relative">
                    <button class="text-gray-800 font-semibold">MONITORING</button>
                    <div class="absolute mt-2 w-48 bg-white shadow-lg rounded hidden">
                        <a href="{{ route('monitoring.cvw.index') }}" class="block px-4 py-2 text-gray-800 font-semibold hover:bg-gray-100">CIVIL WORK</a>
                        <a href="{{ route('monitoring.pmsc.index') }}" class="block px-4 py-2 text-gray-800 font-semibold hover:bg-gray-100">PMSC</a>
                    </div>
                </div>
                <a href="#about" class="text-gray-800 font-semibold">ABOUT</a>
                <a href="#contact" class="text-gray-800 font-semibold">CONTACT</a>
            </nav>
            <div class="md:hidden">
                <button id="menu-button" class="focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white shadow text-white">
            <nav class="flex flex-col space-y-2 py-4 px-4">
                <a href="/" class="text-gray-800">HOME</a>
                <div class="relative">
                    <button class="text-gray-800">MONITORING</button>
                    <div class="absolute mt-2 w-48 bg-white shadow-lg rounded hidden">
                        <a href="{{ route('monitoring.cvw.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">CIVIL WORK</a>
                        <a href="{{ route('monitoring.pmsc.index') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">PMSC</a>
                    </div>
                </div>
                <a href="#about" class="text-gray-800 font-semibold">ABOUT</a>
                <a href="#contact" class="text-gray-800 font-semibold">CONTACT</a>
            </nav>
        </div>
    </header>


<!-- Hero Section -->
<section id="hero" class="h-screen relative flex items-center justify-center overflow-hidden">
    <!-- Updated iframe for YouTube video -->
    <iframe class="video-bg" src="https://www.youtube.com/embed/gDrywz8vqjU?autoplay=1&mute=1&loop=1&playlist=gDrywz8vqjU&controls=0&showinfo=0&modestbranding=1&rel=0"
        frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    <div class="video-overlay"></div>
    <div class="text-center text-white px-4 fade-in relative">
        <h2 class="text-5xl font-bold">Innovating for a Better Future</h2>
        <p class="mt-4 text-lg">Leading Technology and Innovation in Higher Education</p>
        <a href="#about"
            class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded transition duration-300">Learn
            More</a>
    </div>
</section>


<!-- About Section -->
<section id="about" class="py-16">
    <div class="container mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-6">About Us</h2>
        <div class="max-w-2xl mx-auto mb-4">
            <p class="text-lg mb-4">Higher Education for Technology and Innovation (HETI) is an integral part of
                Universitas Lampung, dedicated to advancing technology and fostering innovation in education.</p>
            <div class="flex justify-center space-x-4">
                <img src="https://pembaruan.id/wp-content/uploads/2024/03/IMG-20240325-WA0053.jpg" alt="About Us"
                    class="about-image">
                <img src="https://potensinews.id/wp-content/uploads/2024/03/Compress_20240325_184222_2055.jpg" alt="About Us"
                    class="about-image">
                <img src="https://www.indo-asia.com/wp-content/uploads/2022/01/download-2.jpg" alt="About Us"
                    class="about-image">
            </div>
        </div>
        <a href="#" class="text-blue-500 hover:underline">Learn More</a>
    </div>
</section>




    <!-- Vision & Mission Section -->
    <section id="vision" class="bg-gray-200 py-16">
        <div class="container mx-auto text-center px-4">
            <h2 class="text-3xl font-bold mb-6">Vision & Mission</h2>
            <div class="flex flex-col md:flex-row justify-center space-y-8 md:space-y-0 md:space-x-16">
                <div class="md:w-1/2 px-4 slide-in-bottom">
                    <h3 class="text-2xl font-semibold">Vision</h3>
                    <p class="mt-4">To be a leading center for technology and innovation in higher education,
                        contributing
                        to societal advancement and sustainable development.</p>
                </div>
                <div class="md:w-1/2 px-4 slide-in-bottom">
                    <h3 class="text-2xl font-semibold">Mission</h3>
                    <ul class="list-disc list-inside mt-4 text-left mx-auto">
                        <li>Provide top-quality education in technology and innovation.</li>
                        <li>Foster research and development that addresses real-world challenges.</li>
                        <li>Collaborate with industry and community partners.</li>
                        <li>Promote sustainable and inclusive growth.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-16">
        <div class="container mx-auto text-center px-4">
            <h2 class="text-3xl font-bold mb-6">Our Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://www.iberian-partners.com/wp-content/uploads/2023/12/Research-and-Development-Adalah.webp" alt="Research & Development"
                        class="w-full h-40 object-cover rounded-lg mb-4">
                    <h3 class="text-2xl font-semibold mb-4">Research & Development</h3>
                    <p>Conducting cutting-edge research to drive innovation and solve industry challenges.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://c2.staticflickr.com/2/1867/30764685118_aa610493b5_b.jpg" alt="Consultancy"
                        class="w-full h-40 object-cover rounded-lg mb-4">
                    <h3 class="text-2xl font-semibold mb-4">Consultancy</h3>
                    <p>Providing expert advice and solutions for technology and innovation projects.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://suneducationgroup.com/wp-content/uploads/2023/01/jason-goodman-Oalh2MojUuk-unsplash-1024x683.jpg.webp" alt="Training & Workshops"
                        class="w-full h-40 object-cover rounded-lg mb-4">
                    <h3 class="text-2xl font-semibold mb-4">Training & Workshops</h3>
                    <p>Offering training programs and workshops to enhance skills and knowledge in technology and
                        innovation.</p>
                </div>
            </div>
        </div>
    </section>

<!-- Section Monitoring -->
<section id="monitoring" class="bg-gray-200 py-8">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-8 text-center">Monitoring</h2>

        <!-- Tab Navigation -->
        <div class="tabs flex justify-center mb-8">
            <button class="tab-link active px-4 py-2 mx-2 bg-blue-500 text-white rounded-lg" data-tab="progress-tab">CIVIL WORK</button>
            <button class="tab-link px-4 py-2 mx-2 bg-blue-500 text-white rounded-lg" data-tab="meeting-tab">PMSC</button>
        </div>

        <!-- Tab Content -->
        <div id="meeting-tab" class="tab-content hidden">
            <!-- Konten Meeting -->
            <div class="meeting-content bg-white p-6 rounded-lg shadow-lg">
                <p class="mb-2"><strong>Periode:</strong> Minggu 14</p>
                <p class="mb-2"><strong>Date:</strong> 2024-06-18 03:14:00</p>
                <p class="mb-2"><strong>Location:</strong> Lorem ipsum dolor sit.</p>
                <p class="mb-4"><strong>Agenda:</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <img src="https://suneducationgroup.com/wp-content/uploads/2023/01/jason-goodman-Oalh2MojUuk-unsplash-1024x683.jpg.webp" alt="Gambar Rapat 1" class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                    <div>
                        <img src="https://suneducationgroup.com/wp-content/uploads/2023/01/jason-goodman-Oalh2MojUuk-unsplash-1024x683.jpg.webp" alt="Gambar Rapat 2" class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                </div>
                <a href="{{ route('monitoring.pmsc.index') }}" class="text-blue-500 hover:underline">Learn More</a>
            </div>
        </div>

        <div id="progress-tab" class="tab-content active">
            <!-- Konten Progress -->
            <div class="progress-content bg-white p-6 rounded-lg shadow-lg">
                <p class="mb-2"><strong>Periode:</strong> Minggu 14</p>
                <p class="mb-4"><strong>Date:</strong> 2 Juni 2024 s/d 8 Juni 2024</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                        <h4 class="text-lg font-bold mb-2">Waktu Kontrak</h4>
                        <p class="mb-4">8 Maret 2024 s/d 30 Agustus 2025</p>
                        <table class="table-auto w-full mb-4">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Kontrak</th>
                                    <th class="px-4 py-2">Terpakai</th>
                                    <th class="px-4 py-2">Sisa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-4 py-2">540 Hari Kalender</td>
                                    <td class="border px-4 py-2">100 Hari</td>
                                    <td class="border px-4 py-2">440 Hari</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">78 Minggu</td>
                                    <td class="border px-4 py-2">14 Minggu</td>
                                    <td class="border px-4 py-2">64 Minggu</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
                        <h4 class="text-lg font-bold mb-2">Progress Kontrak Berdasarkan Kurva S</h4>
                        <table class="table-auto w-full mb-4">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Rencana Kumulatif</th>
                                    <th class="px-4 py-2">Realisasi Kumulatif</th>
                                    <th class="px-4 py-2">Deviasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border px-4 py-2">1.31%</td>
                                    <td class="border px-4 py-2">3.71%</td>
                                    <td class="border px-4 py-2">2.4%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="{{ route('monitoring.cvw.index') }}" class="text-blue-500 hover:underline">Learn More</a>
            </div>
        </div>
    </div>
</section>


    <!-- News Section -->
    <section id="news" class="bg-gray-200 py-16">
        <div class="container mx-auto text-center px-4">
            <h2 class="text-3xl font-bold mb-6">Latest News</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- News Item -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://www.unila.ac.id/wp-content/uploads/2024/06/IMG-20240614-WA0020-324x235.jpg" alt="News Title 1"
                        class="w-full h-40 object-cover rounded-lg mb-4">
                    <h3 class="text-2xl font-semibold mb-4">News Title 1</h3>
                    <p>Brief description of the news. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <a href="#" class="text-blue-500 hover:underline mt-4 block">Read more</a>
                </div>
                <!-- News Item -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://www.unila.ac.id/wp-content/uploads/2024/06/IMG-20240614-WA0007-324x235.jpg" alt="News Title 2"
                        class="w-full h-40 object-cover rounded-lg mb-4">
                    <h3 class="text-2xl font-semibold mb-4">News Title 2</h3>
                    <p>Brief description of the news. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <a href="#" class="text-blue-500 hover:underline mt-4 block">Read more</a>
                </div>
                <!-- News Item -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://www.unila.ac.id/wp-content/uploads/2024/06/IMG-20240613-WA0011-324x235.jpg" alt="News Title 3"
                        class="w-full h-40 object-cover rounded-lg mb-4">
                    <h3 class="text-2xl font-semibold mb-4">News Title 3</h3>
                    <p>Brief description of the news. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <a href="#" class="text-blue-500 hover:underline mt-4 block">Read more</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="bg-blue-800 text-white py-16">
        <div class="container mx-auto text-center px-4">
            <h2 class="text-3xl font-bold mb-6">Contact Us</h2>
            <p class="mb-6">Get in touch with us for more information about our programs and services.</p>
            <p>Email: <a href="mailto:heti@unila.ac.id" class="text-blue-300 hover:underline">heti@unila.ac.id</a></p>
            <p>Phone: <a href="tel:+62721123456" class="text-blue-300 hover:underline">+62 721 123456</a></p>
            <p>Address: Universitas Lampung, Jl. Sumantri Brojonegoro No.1, Bandar Lampung, Indonesia</p>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center px-4">
            <p>&copy; 2024 Higher Education for Technology and Innovation (HETI), Universitas Lampung. All rights
                reserved.</p>
        </div>
    </footer>

    <script>
        // Toggle mobile menu
        document.getElementById('menu-button').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        document.addEventListener('DOMContentLoaded', function () {
    const tabs = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');
    const weekSelect = document.getElementById('week-select');

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            // Remove active class from all tabs and contents
            tabs.forEach(t => t.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add active class to clicked tab and corresponding content
            this.classList.add('active');
            document.getElementById(this.dataset.tab).classList.add('active');
        });
    });

});


document.querySelector('button').addEventListener('click', function() {
            const dropdown = this.nextElementSibling;
            dropdown.classList.toggle('hidden');
        });
    </script>

</body>

</html>
