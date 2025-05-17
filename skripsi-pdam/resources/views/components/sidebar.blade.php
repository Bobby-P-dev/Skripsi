<aside class="w-64 bg-gray-100 shadow-md flex flex-col">
    <div class="p-6 border-b flex justify-center items-center">
        <img src="{{ asset('images/tirta.png') }}" alt="Tirta.png" class="w-24 h-24 mx-ato">
    </div>
    <nav class="flex-1 p-4">
        <ul class="space-y-2">
            <li><a href="{{ route('dashboard') }}"
                    class="block px-4 py-2 rounded {{ request()->segment(1) == 'dashboard' ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                    Dashboard
                </a></li>
            <li><a href="#"
                    class="block px-4 py-2 rounded {{ request()->segment(1) == '#' ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                    Data Pengguna
                </a></li>
            <li>
                <a href="{{ route('laporan.index') }}"
                    class="block px-4 py-2 rounded {{ request()->segment(1) == 'laporan' ? 'bg-blue-100 text-blue-700 font-semibold' : 'hover:bg-blue-50' }}">
                    Laporan
                </a>
            </li>
            <li><a href="#" class="block px-4 py-2 rounded hover:bg-blue-50">Penuggasan</a></li>
            <li><a href="#" class="block px-4 py-2 rounded hover:bg-blue-50">Dokumentasi</a></li>
            <li><a href="#" class="block px-4 py-2 rounded hover:bg-blue-50">Register</a></li>
        </ul>
    </nav>
</aside>