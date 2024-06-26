<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HETI - Universitas Lampung</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-jLKHWM3rW64W7aGAA2lH6CwoA4H0ivS8Q+OQdL9PRsBLTqkJpL0JY5lZh7MGaT5y" crossorigin="anonymous"> --}}
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css"/>


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

    .slider img {
        width: 100%;
        height: 400px; /* Adjust height as needed */
        object-fit: cover;
    }
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- Header Section -->
    <header class="bg-white shadow text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center py-4 px-4">
            <a href="#hero" class="text-2xl font-bold"> <img src="{{ Storage::url('project_logos/1719297567_Logo-Be-Strong-Unila-2023.png') }}" alt="Logo" class="h-10"></a>
            <nav class="hidden md:flex space-x-8">
                <a href="/" class="text-gray-800 font-semibold">HOME</a>
                <div class="relative">
                    <button class="text-gray-800 font-semibold">MONITORING</button>
                    <div class="absolute mt-2 w-48 bg-white shadow-lg rounded hidden">
                        <a href="{{ route('monitoring.cvw.index') }}" class="block px-4 py-2 text-gray-800 font-semibold hover:bg-gray-100">CIVIL WORK</a>
                        <a href="{{ route('monitoring.pmsc.indexxx') }}" class="block px-4 py-2 text-gray-800 font-semibold hover:bg-gray-100">PMSC</a>
                    </div>
                </div>
                <a href="#news-announcements" class="text-gray-800 font-semibold">PUBLICATION</a>
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
                        <a href="{{ route('monitoring.pmsc.indexxx') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">PMSC</a>
                    </div>
                </div>
                <a href="#news-announcements" class="text-gray-800 font-semibold">PUBLICATION</a>
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
                <br>
                <br>
                <img src="{{ Storage::url('project_logos/struktur.png') }}" alt="About Us" class="w-full h-auto">
            </div>
        </div>
    </div>
</section>


<!-- Program Section -->
<section id="program" class="py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold mb-6 text-center">Program</h2>
        <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-16">
            <!-- Left Side: Slider -->
            <div class="md:w-1/2 px-4">
                <div class="slider">
                    <div>
                        <img src="https://pembaruan.id/wp-content/uploads/2024/03/IMG-20240325-WA0053.jpg" alt="Gambar 1" class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                    <div>
                        <img src="https://potensinews.id/wp-content/uploads/2024/03/Compress_20240325_184222_2055.jpg" alt="Gambar 2" class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                    <div>
                        <img src="https://www.indo-asia.com/wp-content/uploads/2022/01/download-2.jpg" alt="Gambar 3" class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                </div>
            </div>
            <!-- Right Side: Descriptions -->
            <div class="md:w-1/2 px-4">
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold">Construction of RSPTN</h3>
                    <p class="mt-4">Providing high-quality healthcare facilities to support medical education and research, improve healthcare services, and serve as a referral center for the region, benefiting both students and the local community.</p>
                </div>
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold">Construction of IRC</h3>
                    <p class="mt-4">Establishing an international research center to foster innovation, global collaboration, and high-quality scientific publications, enhancing research capabilities and promoting academic excellence.</p>
                </div>
                <div class="mb-8">
                    <h3 class="text-2xl font-semibold">Construction of WWTP</h3>
                    <p class="mt-4">Treating wastewater to reduce environmental pollution, promote sustainability, and enable the safe reuse of treated water for various purposes, supporting eco-friendly practices and ensuring compliance with regulations.</p>
                </div>
            </div>
        </div>
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
                <p class="mb-2"><strong>Periode:</strong> Minggu 16</p>
                <p class="mb-2"><strong>Date:</strong> 2024-06-18 16:00:00</p>
                <p class="mb-2"><strong>Location:</strong> Koordinasi Rapat Rutin Minggu Ke 15</p>
                <p class="mb-4"><strong>Agenda:</strong> Coordination of Regular Meetings Week 15</p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <img src="https://unilaprojectheti.id/storage/pmsc_galleries/I9hATFT03OYT9DW2XqQ5TDnQbAwKC2r3bt4vT2hl.jpg" alt="Gambar Rapat 1" class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                    <div>
                        <img src="https://unilaprojectheti.id/storage/pmsc_galleries/EgWS3IGv2KcAPk67dBzwfaASFn6Z5x9QWnYy0Ixa.jpg" alt="Gambar Rapat 2" class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                </div>
                <a href="{{ route('monitoring.pmsc.indexxx') }}" class="text-blue-500 hover:underline">Learn More</a>
            </div>
        </div>

        <div id="progress-tab" class="tab-content active">
            <!-- Konten Progress -->
            <div class="progress-content bg-white p-6 rounded-lg shadow-lg">
                <p class="mb-2"><strong>Periode:</strong> Minggu 16</p>
                <p class="mb-4"><strong>Date:</strong> 16 Juni 2024 s/d 22 Juni 2024</p>
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
                                    <td class="border px-4 py-2">107 Hari</td>
                                    <td class="border px-4 py-2">443 Hari</td>
                                </tr>
                                <tr>
                                    <td class="border px-4 py-2">78 Minggu</td>
                                    <td class="border px-4 py-2">16 Minggu</td>
                                    <td class="border px-4 py-2">62 Minggu</td>
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
                                    <td class="border px-4 py-2">1.77%</td>
                                    <td class="border px-4 py-2">2.22%</td>
                                    <td class="border px-4 py-2">0.59%</td>
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


<!-- News and Announcements Section -->
<section id="news-announcements" class="bg-gray-200 py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Berita -->
            <div>
                <h2 class="text-3xl font-bold mb-6 text-center md:text-left">Latest News</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <!-- News Item -->
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex flex-col">
                        <img src="https://heti.unila.ac.id/wp-content/uploads/2024/06/WhatsApp-Image-2024-06-05-at-6.46.17-PM-696x393.jpeg" alt="News Title 1" class="w-full h-40 object-cover rounded-lg mb-4">
                        <h3 class="text-2xl font-semibold mb-4">News Title 1</h3>
                        <p class="flex-grow">Brief description of the news item 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a href="#" class="text-blue-500 hover:underline mt-4">Read more</a>
                    </div>
                    <!-- News Item -->
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex flex-col">
                        <img src="https://heti.unila.ac.id/wp-content/uploads/2024/03/WhatsApp-Image-2024-02-19-at-09.50.12-696x464.jpeg" alt="News Title 2" class="w-full h-40 object-cover rounded-lg mb-4">
                        <h3 class="text-2xl font-semibold mb-4">News Title 2</h3>
                        <p class="flex-grow">Brief description of the news item 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a href="#" class="text-blue-500 hover:underline mt-4">Read more</a>
                    </div>
                    <!-- News Item -->
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex flex-col">
                        <img src="https://heti.unila.ac.id/wp-content/uploads/2024/03/IMG-20240302-WA0013-696x522.jpg" alt="News Title 3" class="w-full h-40 object-cover rounded-lg mb-4">
                        <h3 class="text-2xl font-semibold mb-4">News Title 3</h3>
                        <p class="flex-grow">Brief description of the news item 3. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a href="#" class="text-blue-500 hover:underline mt-4">Read more</a>
                    </div>
                    <!-- News Item -->
                    <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex flex-col">
                        <img src="https://heti.unila.ac.id/wp-content/uploads/2023/10/JDN07836-1-696x456.jpg" alt="News Title 4" class="w-full h-40 object-cover rounded-lg mb-4">
                        <h3 class="text-2xl font-semibold mb-4">News Title 4</h3>
                        <p class="flex-grow">Brief description of the news item 4. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a href="#" class="text-blue-500 hover:underline mt-4">Read more</a>
                    </div>
                </div>
            </div>
            <!-- Announcement -->
            <div>
                <h2 class="text-3xl font-bold mb-6 text-center md:text-left">Latest Announcement</h2>
                <div class="grid grid-cols-1 gap-4">
                    <!-- Announcement Item -->
                    <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex flex-col">
                        <h3 class="text-xl font-semibold mb-2">Announcement Title 1</h3>
                        <p class="text-sm flex-grow">Brief description of the announcement item 1. Lorem ipsum dolor sit amet.</p>
                        <a href="#" class="text-blue-500 hover:underline mt-2">Read more</a>
                    </div>
                    <!-- Announcement Item -->
                    <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex flex-col">
                        <h3 class="text-xl font-semibold mb-2">Announcement Title 2</h3>
                        <p class="text-sm flex-grow">Brief description of the announcement item 2. Lorem ipsum dolor sit amet.</p>
                        <a href="#" class="text-blue-500 hover:underline mt-2">Read more</a>
                    </div>
                    <!-- Announcement Item -->
                    <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex flex-col">
                        <h3 class="text-xl font-semibold mb-2">Announcement Title 3</h3>
                        <p class="text-sm flex-grow">Brief description of the announcement item 3. Lorem ipsum dolor sit amet.</p>
                        <a href="#" class="text-blue-500 hover:underline mt-2">Read more</a>
                    </div>
                    <!-- Announcement Item -->
                    <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex flex-col">
                        <h3 class="text-xl font-semibold mb-2">Announcement Title 4</h3>
                        <p class="text-sm flex-grow">Brief description of the announcement item 4. Lorem ipsum dolor sit amet.</p>
                        <a href="#" class="text-blue-500 hover:underline mt-2">Read more</a>
                    </div>
                    <!-- Announcement Item -->
                    <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex flex-col">
                        <h3 class="text-xl font-semibold mb-2">Announcement Title 5</h3>
                        <p class="text-sm flex-grow">Brief description of the announcement item 5. Lorem ipsum dolor sit amet.</p>
                        <a href="#" class="text-blue-500 hover:underline mt-2">Read more</a>
                    </div>
                    <!-- Announcement Item -->
                    <div class="bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transition duration-300 flex flex-col">
                        <h3 class="text-xl font-semibold mb-2">Announcement Title 6</h3>
                        <p class="text-sm flex-grow">Brief description of the announcement item 6. Lorem ipsum dolor sit amet.</p>
                        <a href="#" class="text-blue-500 hover:underline mt-2">Read more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="bg-blue-800 text-white py-16">
    <div class="container mx-auto flex flex-wrap items-center justify-between px-4">
        <!-- Bagian kiri: Peta -->
        <div class="w-full md:w-1/2 mb-6 md:mb-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3972.3076030144216!2d105.2367075749838!3d-5.369971794608866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e40dbcd47ce7835%3A0x234fee8ad9173d21!2sHETI%20Project%20Office!5e0!3m2!1sid!2sid!4v1719429100360!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- Bagian kanan: Alamat dan Kontak -->
        <div class="w-full md:w-1/2 text-center md:text-left md:pl-8">
            <h2 class="text-3xl font-bold mb-4">Contact Us</h2>
            <p class="mb-6">Get in touch with us for more information about our programs and services.</p>
            <p class="mb-2"><i class="fas fa-envelope mr-2"></i><strong>Email:</strong> <a href="mailto:pmsc.unilaproject@gmail.com" class="text-blue-300 hover:underline">pmsc.unilaproject@gmail.com</a></p>
            <p class="mb-2"><i class="fas fa-phone-alt mr-2"></i><strong>Phone:</strong> <a href="https://wa.me/6285954041681" class="text-blue-300 hover:underline">+62 859-5404-1681</a></p>
            <p class="mb-2"><i class="fas fa-map-marker-alt mr-2"></i><strong>Address:</strong> Universitas Lampung, Jl. Sumantri Brojonegoro No.1, Bandar Lampung, Indonesia</p>
            <div class="mt-6">
                <h3 class="text-2xl font-bold mb-4">Follow Us</h3>
                <div class="flex justify-center md:justify-start space-x-4">
                    <a href="#" class="text-blue-300 hover:underline"><i class="fas fa-facebook-f"></i></a>
                    <a href="#" class="text-blue-300 hover:underline"><i class="fas fa-twitter"></i></a>
                    <a href="#" class="text-blue-300 hover:underline"><i class="fas fa-instagram"></i></a>
                    <a href="#" class="text-blue-300 hover:underline"><i class="fas fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center px-4">
            <p>&copy; 2024 Higher Education for Technology and Innovation (HETI), Universitas Lampung. All rights
                reserved.</p>
        </div>
    </footer>

<!-- Load FontAwesome -->
{{-- <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> --}}
 <!-- jQuery -->
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <!-- Slick Carousel JS -->
 <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js"></script>





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

    $('.slider').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            slidesToScroll: 1,
            adaptiveHeight: true,
            autoplay: true,
            autoplaySpeed: 1500
        });

});


document.querySelector('button').addEventListener('click', function() {
            const dropdown = this.nextElementSibling;
            dropdown.classList.toggle('hidden');
        });
    </script>

</body>

</html>
