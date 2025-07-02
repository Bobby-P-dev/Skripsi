<!-- Tombol Hamburger (hanya tampil di mobile) -->
<div class="md:hidden p-4 border-r">
    <button id="toggleSidebar" class="text-gray-800 focus:outline-none">
        <!-- Icon Hamburger -->
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
    </button>

    <div class="flex flex-col justify-center items-center gap-6 mt-8">
        <a href="{{ route('dashboard') }}" class="block rounded {{ request()->segment(1) == 'dashboard' ? 'border-b-4 border-blue-700' : 'hover:bg-blue-0' }}">
            <div>
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 48 48">
                    <path d="M 23.951172 4 A 1.50015 1.50015 0 0 0 23.072266 4.3222656 L 8.859375 15.519531 C 7.0554772 16.941163 6 19.113506 6 21.410156 L 6 40.5 C 6 41.863594 7.1364058 43 8.5 43 L 18.5 43 C 19.863594 43 21 41.863594 21 40.5 L 21 30.5 C 21 30.204955 21.204955 30 21.5 30 L 26.5 30 C 26.795045 30 27 30.204955 27 30.5 L 27 40.5 C 27 41.863594 28.136406 43 29.5 43 L 39.5 43 C 40.863594 43 42 41.863594 42 40.5 L 42 21.410156 C 42 19.113506 40.944523 16.941163 39.140625 15.519531 L 24.927734 4.3222656 A 1.50015 1.50015 0 0 0 23.951172 4 z M 24 7.4101562 L 37.285156 17.876953 C 38.369258 18.731322 39 20.030807 39 21.410156 L 39 40 L 30 40 L 30 30.5 C 30 28.585045 28.414955 27 26.5 27 L 21.5 27 C 19.585045 27 18 28.585045 18 30.5 L 18 40 L 9 40 L 9 21.410156 C 9 20.030807 9.6307412 18.731322 10.714844 17.876953 L 24 7.4101562 z"></path>
                </svg>
            </div>
        </a>

        @if (auth()->user()->peran === 'admin')
        <a href="{{ route('laporan.admin') }}" class="block rounded {{ request()->segment(2) == 'laporan' ? 'border-b-4 border-blue-700' : 'hover:bg-blue-0' }}">
            <div class="w-8 h-8">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 300 300" xml:space="preserve">
                    <path d="m221.615 93.924.001-.001-39.891-39.891a5.162 5.162 0 0 0-3.662-1.518H82.045a5.179 5.179 0 0 0-5.178 5.178v184.616a5.177 5.177 0 0 0 5.178 5.177h135.909a5.176 5.176 0 0 0 5.178-5.177V97.584a5.251 5.251 0 0 0-1.517-3.66zm-8.838 143.207H87.222V62.87h88.698l29.537 29.537H183.24V81.588a5.177 5.177 0 0 0-10.354 0v15.996a5.174 5.174 0 0 0 5.176 5.177l34.714.001v134.369z" />
                    <path d="m122.876 104.546-10.317 10.317-1.475-1.475a5.18 5.18 0 0 0-7.323 0 5.175 5.175 0 0 0 0 7.322l5.137 5.136a5.172 5.172 0 0 0 7.321 0l13.979-13.979a5.178 5.178 0 0 0-7.322-7.321zM190.86 127.364h1.721a5.179 5.179 0 0 0 0-10.356h-1.721a5.178 5.178 0 1 0 0 10.356zM141.559 117.008a5.18 5.18 0 1 0 0 10.356h33.552a5.177 5.177 0 1 0 0-10.356h-33.552zM190.86 159.204h1.721a5.177 5.177 0 1 0 0-10.355h-1.721a5.177 5.177 0 1 0 0 10.355zM175.111 148.85h-33.552a5.178 5.178 0 1 0 0 10.355h33.552a5.178 5.178 0 1 0 0-10.355zM190.86 191.045h1.721a5.18 5.18 0 0 0 0-10.356h-1.721a5.177 5.177 0 1 0 0 10.356zM175.111 180.69h-33.552a5.18 5.18 0 1 0 0 10.356h33.552a5.178 5.178 0 1 0 0-10.356zM190.86 222.885h1.721a5.178 5.178 0 0 0 0-10.355h-1.721a5.177 5.177 0 1 0 0 10.355zM175.111 212.531h-33.552a5.179 5.179 0 1 0 0 10.355h33.552a5.178 5.178 0 1 0 0-10.355zM112.558 159.204c1.372 0 2.69-.546 3.66-1.517l13.979-13.979a5.178 5.178 0 0 0-7.321-7.322l-10.317 10.317-1.475-1.475a5.178 5.178 0 0 0-7.323 7.321l5.137 5.137a5.17 5.17 0 0 0 3.66 1.518zM107.089 178.878l-3.329 3.329a5.18 5.18 0 0 0 3.662 8.838 5.165 5.165 0 0 0 3.661-1.516l3.327-3.33 3.329 3.33a5.161 5.161 0 0 0 3.661 1.516 5.175 5.175 0 0 0 3.66-8.838l-3.329-3.329 3.329-3.329a5.178 5.178 0 0 0-7.323-7.321l-3.327 3.327-3.327-3.327a5.178 5.178 0 0 0-7.323 7.321l3.329 3.329zM122.876 200.067l-10.317 10.318-1.475-1.474a5.177 5.177 0 0 0-7.323 0 5.175 5.175 0 0 0 0 7.322l5.137 5.136a5.175 5.175 0 0 0 7.321 0l13.979-13.98a5.178 5.178 0 0 0-7.322-7.322z" />
                </svg>
            </div>
        </a>
        <a href="{{ route('data.admin') }}" class="block rounded {{ request()->segment(2) == 'data' ? 'border-b-4 border-blue-700 p-1' : 'hover:bg-blue-0' }}">
            <div class="w-5 h-5">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32" xml:space="preserve">
                    <path d="M30.625 12.914H20.254a1 1 0 1 1 0-2h10.371a1 1 0 1 1 0 2zM30.625 20.293h-6.844a1 1 0 1 1 0-2h6.844a1 1 0 1 1 0 2zM30.625 27.672h-4.336a1 1 0 1 1 0-2h4.336a1 1 0 1 1 0 2z" />
                    <g>
                        <path d="M12.375 14c-3.86 0-7-3.14-7-7s3.14-7 7-7 7 3.14 7 7-3.14 7-7 7zm0-12c-2.757 0-5 2.243-5 5s2.243 5 5 5 5-2.243 5-5-2.243-5-5-5zM20.317 32H4.433a4.062 4.062 0 0 1-4.058-4.058c0-6.616 5.383-12 12-12s12 5.384 12 12A4.062 4.062 0 0 1 20.317 32zm-7.942-14.058c-5.514 0-10 4.486-10 10A2.06 2.06 0 0 0 4.433 30h15.884a2.06 2.06 0 0 0 2.058-2.058c0-5.514-4.486-10-10-10z" />
                    </g>
                </svg>
            </div>
        </a>
        <a href="">
            <div class="w-6 h-6">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6.827 6.827">
                    <g id="Layer_x0020_1">
                        <path class="fil0" d="M1.1.96h4.627c.047 0 .089.019.12.05h-.001c.03.03.05.072.05.118v3.568a.168.168 0 0 1-.168.168H4.605l.204-.207h.879v-3.49H1.138v3.49h2.451l-.204.207H1.1a.168.168 0 0 1-.168-.168V1.128c0-.046.019-.088.05-.119.03-.03.072-.049.118-.049z" />
                        <path class="fil0" d="M1.387 4.078a.107.107 0 0 0 .151.15l1.27-1.268.958.958a.107.107 0 0 0 .15-.15L2.884 2.734a.107.107 0 0 0-.151 0L1.387 4.077z" />
                        <path class="fil0" d="M3.3 3.302a.107.107 0 0 0 .152.151l.878-.878.958.959a.107.107 0 0 0 .151-.151L4.406 2.349a.107.107 0 0 0-.152 0l-.953.953zM2.187 1.564a.519.519 0 0 1 .368.889.519.519 0 0 1-.889-.368.519.519 0 0 1 .52-.52zm.217.304a.306.306 0 0 0-.524.217.306.306 0 0 0 .524.217.306.306 0 0 0 0-.434zM3.481 5.023l.364.358-.149.152-.364-.359zM4.69 3.794l.365.359-.15.151-.363-.358z" />
                        <path class="fil0" d="m3.815 5.55-.666.317-.139-.136.302-.674.021-.03 1.44-1.463a.259.259 0 0 1 .128-.072.17.17 0 0 1 .158.042l.25.246a.17.17 0 0 1 .045.158.259.259 0 0 1-.07.13l-1.44 1.461-.03.021zm-.502.01.397-.189 1.426-1.448a.07.07 0 0 0 .01-.013l-.214-.211a.071.071 0 0 0-.013.01L3.493 5.159l-.18.402z" />
                    </g>
                    <path style="fill:none" d="M0 0h6.827v6.827H0z" />
                </svg>
            </div>
        </a>
        @endif

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
            @if (auth()->user()->peran === 'admin')


            <!-- admin -->
            {{-- 1. DROPDOWN UNTUK LAPORAN --}}
            {{-- Kita beri id dan data-is-active untuk 'ditangkap' oleh JS --}}
            <li id="laporan-dropdown-container" data-is-active="{{ request()->is('admin/laporan*') ? 'true' : 'false' }}">

                {{-- Tombol trigger diberi id 'laporan-dropdown-btn' --}}
                <button id="laporan-dropdown-btn"
                    class="w-full flex justify-between items-center px-4 py-2 rounded text-left {{ request()->is('admin/laporan*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                    <span>Laporan</span>

                    {{-- Ikon panah diberi id 'laporan-dropdown-icon' --}}
                    <svg id="laporan-dropdown-icon" class="w-4 h-4 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                {{-- Panel dropdown diberi id 'laporan-dropdown-panel' dan class 'hidden' secara default --}}
                <div id="laporan-dropdown-panel" class="hidden mt-1 pl-4">
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('laporan.admin') }}"
                                class="block px-4 py-2 rounded text-sm {{ request()->routeIs('laporan.admin') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                                Laporan Masuk
                            </a>
                        </li>
                        <li>
                            <a href=" {{ route( 'alllaporan.index') }}"
                                class="block px-4 py-2 rounded text-sm {{ request()->routeIs('alllaporan.index') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                                Data Laporan
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            {{-- Menu lain tidak perlu diubah --}}
            <li>
                <a href="{{ route('data.admin') }}" class="block px-4 py-2 rounded {{ request()->is('admin/data*') ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                    Data Pengguna
                </a>
            </li>
            <li>
                <a href="{{ route('dokumentasi.index') }}" class="block px-4 py-2 rounded hover:bg-blue-50">
                    Dokumentasi
                </a>
            </li>

            @endif

            <!-- role teknisi -->
            @if (auth()->user()->peran === 'teknisi')
            <li><a href="#" class="block px-4 py-2 rounded hover:bg-blue-50">Dokumentasi</a></li>
            <li>
                <a href=" {{ route('penugasant.index') }}"
                    class="block px-4 py-2 rounded {{ request()->segment(1) == 'penugasan' ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                    Penugasan
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

    document.addEventListener('DOMContentLoaded', function() {

        // 1. Tangkap semua elemen yang kita butuhkan berdasarkan ID-nya
        const dropdownContainer = document.getElementById('laporan-dropdown-container');
        const dropdownButton = document.getElementById('laporan-dropdown-btn');
        const dropdownPanel = document.getElementById('laporan-dropdown-panel');
        const dropdownIcon = document.getElementById('laporan-dropdown-icon');

        // Periksa apakah elemen-elemen tersebut ada di halaman ini untuk menghindari error
        if (dropdownButton && dropdownPanel && dropdownIcon && dropdownContainer) {

            // 2. Cek status awal (apakah harus terbuka saat halaman dimuat?)
            // Kita membaca atribut 'data-is-active' yang kita set di Blade
            const isActive = dropdownContainer.dataset.isActive === 'true';
            if (isActive) {
                // Jika aktif, tampilkan panel dan putar ikonnya
                dropdownPanel.classList.remove('hidden');
                dropdownIcon.classList.add('rotate-180');
            }

            // 3. Tambahkan event 'click' pada tombol
            dropdownButton.addEventListener('click', function() {
                // Toggle (tambah/hapus) class 'hidden' pada panel
                dropdownPanel.classList.toggle('hidden');

                // Toggle (tambah/hapus) class 'rotate-180' pada ikon
                dropdownIcon.classList.toggle('rotate-180');
            });
        }
    });
</script>