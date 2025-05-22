<!-- Tombol Hamburger (hanya tampil di mobile) -->
<div class="md:hidden p-4">
    <button id="toggleSidebar" class="text-gray-800 focus:outline-none">
        <!-- Icon Hamburger -->
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <div class="mt-10">
        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="40" height="40" viewBox="0 0 50 50">
            <path d="M 25 3 C 12.861562 3 3 12.861562 3 25 C 3 36.019135 11.127533 45.138355 21.712891 46.728516 L 22.861328 46.902344 L 22.861328 29.566406 L 17.664062 29.566406 L 17.664062 26.046875 L 22.861328 26.046875 L 22.861328 21.373047 C 22.861328 18.494965 23.551973 16.599417 24.695312 15.410156 C 25.838652 14.220896 27.528004 13.621094 29.878906 13.621094 C 31.758714 13.621094 32.490022 13.734993 33.185547 13.820312 L 33.185547 16.701172 L 30.738281 16.701172 C 29.349697 16.701172 28.210449 17.475903 27.619141 18.507812 C 27.027832 19.539724 26.84375 20.771816 26.84375 22.027344 L 26.84375 26.044922 L 32.966797 26.044922 L 32.421875 29.564453 L 26.84375 29.564453 L 26.84375 46.929688 L 27.978516 46.775391 C 38.71434 45.319366 47 36.126845 47 25 C 47 12.861562 37.138438 3 25 3 z M 25 5 C 36.057562 5 45 13.942438 45 25 C 45 34.729791 38.035799 42.731796 28.84375 44.533203 L 28.84375 31.564453 L 34.136719 31.564453 L 35.298828 24.044922 L 28.84375 24.044922 L 28.84375 22.027344 C 28.84375 20.989871 29.033574 20.060293 29.353516 19.501953 C 29.673457 18.943614 29.981865 18.701172 30.738281 18.701172 L 35.185547 18.701172 L 35.185547 12.009766 L 34.318359 11.892578 C 33.718567 11.811418 32.349197 11.621094 29.878906 11.621094 C 27.175808 11.621094 24.855567 12.357448 23.253906 14.023438 C 21.652246 15.689426 20.861328 18.170128 20.861328 21.373047 L 20.861328 24.046875 L 15.664062 24.046875 L 15.664062 31.566406 L 20.861328 31.566406 L 20.861328 44.470703 C 11.816995 42.554813 5 34.624447 5 25 C 5 13.942438 13.942438 5 25 5 z"></path>
        </svg>
    </div>
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

            <!-- umum -->
            <li>
                <a href="{{ route('dashboard') }}"
                    class="block px-4 py-2 rounded {{ request()->segment(1) == 'dashboard' ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                    Dashboard
                </a>
            </li>

            <!-- role admin -->
            @if (auth()->user()->peran === 'admin')
            <li>
                <a href="{{ route('laporan.admin') }}"
                    class="block px-4 py-2 rounded {{ request()->segment(2) == 'laporan' ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                    Laporan
                </a>
            </li>
            <li>
                <a href="{{ route('data.admin') }}"
                    class="block px-4 py-2 rounded {{ request()->segment(2) == 'data' ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                    Data Pengguna
                </a>
            </li>

            <li><a href="#" class="block px-4 py-2 rounded hover:bg-blue-50">Penugasan</a></li>
            <li><a href="#" class="block px-4 py-2 rounded hover:bg-blue-50">Dokumentasi</a></li>
            <li><a href="#" class="block px-4 py-2 rounded hover:bg-blue-50">Register</a></li>
            @endif

            <!-- role teknisi -->
            @if (auth()->user()->peran === 'teknisi')
            <li><a href="#" class="block px-4 py-2 rounded hover:bg-blue-50">Dokumentasi</a></li>
            <li>
                <a href="{{ route('laporan.index') }}"
                    class="block px-4 py-2 rounded {{ request()->segment(1) == 'laporan' ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                    Laporan
                </a>
            </li>
            @endif

            <!-- role pengguna -->
            @if (auth()->user()->peran === 'pelanggan')
            <li>
                <a href="{{ route('laporan.index') }}"
                    class="block px-4 py-2 rounded {{ request()->segment(1) == 'laporan' ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                    Laporan
                </a>
            </li>
            @endif

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