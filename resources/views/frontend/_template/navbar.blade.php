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
                <a href="/about" class="text-gray-800 font-semibold">ABOUT</a>
                <a href="/contact" class="text-gray-800 font-semibold">CONTACT</a>
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
                <a href="/" class="text-gray-800 font-semibold">HOME</a>
                <div class="relative">
                    <button class="text-gray-800 font-semibold">MONITORING</button>
                    <div class="absolute mt-2 w-48 bg-white shadow-lg rounded hidden">
                        <a href="{{ route('monitoring.cvw.index') }}" class="block px-4 py-2 text-gray-800 font-semibold hover:bg-gray-100">CIVIL WORK</a>
                        <a href="{{ route('monitoring.pmsc.indexxx') }}" class="block px-4 py-2 text-gray-800 font-semibold hover:bg-gray-100">PMSC</a>
                    </div>
                </div>
                <a href="/about" class="text-gray-800 font-semibold">ABOUT</a>
                <a href="/contact" class="text-gray-800 font-semibold">CONTACT</a>
            </nav>
        </div>
    </header>
