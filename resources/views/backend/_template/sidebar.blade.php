<aside id="sidebar" class="w-64 bg-gray-800 text-white transition-transform duration-300 transform">
    <div class="h-16 flex items-center justify-between px-4">
        <span id="sidebarTitle" class="text-xl font-semibold">HETI UNILA</span>
        {{-- <button id="sidebarToggle" class="text-white focus:outline-none">
            <i id="sidebarIcon" class="fas fa-times"></i>
        </button> --}}
    </div>
    <nav class="mt-10">
        <span class="flex items-center py-2.5 px-4 rounded">
            <span class="sidebar-text">Master Data</span>
        </span>
        <div class="pl-4">
            <a href="{{ route('backend.masterdata.project.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                <i class="fas fa-bank mr-3"></i>
                <span class="sidebar-text">Project</span>
            </a>
            <a href="{{ route('backend.masterdata.timeline.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                <i class="fas fa-clock mr-3"></i>
                <span class="sidebar-text">Timeline</span>
            </a>
            <a href="{{ route('backend.masterdata.location.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                <i class="fas fa-project-diagram mr-3"></i>
                <span class="sidebar-text">Location</span>
            </a>
        </div>
        <span class="flex items-center py-2.5 px-4 rounded">
            <span class="sidebar-text">Monitoring</span>
        </span>
        <div class="pl-4">
            <a href="{{ route('backend.monitoring.cvw.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                <i class="fas fa-hammer mr-3"></i>
                <span class="sidebar-text">Civil Work</span>
            </a>
            <a href="{{ route('backend.monitoring.pmsc.index') }}"
                class="flex items-center py-2.5 px-4 rounded transition duration-200 hover:bg-gray-700">
                <i class="fas fa-cogs mr-3"></i>
                <span class="sidebar-text">PMSC</span>
            </a>
        </div>
    </nav>
</aside>
