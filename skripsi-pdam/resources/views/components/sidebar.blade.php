<!-- Tombol Hamburger (hanya tampil di mobile) -->
<div class="md:hidden p-4">
    <button id="toggleSidebar" class="text-gray-800 focus:outline-none">
        <!-- Icon Hamburger -->
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>
</div>

<!-- Sidebar -->
<aside id="sidebarMenu"
    class="fixed top-0 left-0 w-64 h-full bg-gray-100 shadow-md flex flex-col z-50 transform -translate-x-full md:static md:translate-x-0 transition-transform duration-300 ease-in-out">

    <!-- Tombol Close (hanya mobile) -->
    <div class="md:hidden flex justify-end p-4">
        <button id="closeSidebar" class="text-gray-600 hover:text-red-500">
            <!-- Icon Close -->
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Logo -->
    <div class="p-6 border-b flex justify-center items-center">
        <img src="{{ asset('images/tirta.png') }}" alt="Tirta.png" class="w-24 h-24 mx-auto">
    </div>

    <!-- Menu -->
    <nav class="flex-1 p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="block px-4 py-2 rounded {{ request()->segment(1) == 'dashboard' ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#"
                    class="block px-4 py-2 rounded hover:bg-blue-50">
                    Data Pengguna
                </a>
            </li>
            <li>
                <a href="{{ route('laporan.index') }}"
                    class="block px-4 py-2 rounded {{ request()->segment(1) == 'laporan' ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                    Laporan
                </a>
            </li>
            <li><a href="#" class="block px-4 py-2 rounded hover:bg-blue-50">Penugasan</a></li>
            <li><a href="#" class="block px-4 py-2 rounded hover:bg-blue-50">Dokumentasi</a></li>
            <li><a href="#" class="block px-4 py-2 rounded hover:bg-blue-50">Register</a></li>
        </ul>
    </nav>
</aside>

<!-- Script JavaScript -->
<script>
    const toggleSidebar = document.getElementById('toggleSidebar');
    const closeSidebar = document.getElementById('closeSidebar');
    const sidebar = document.getElementById('sidebarMenu');

    toggleSidebar.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
    });

    closeSidebar.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
    });
</script>
