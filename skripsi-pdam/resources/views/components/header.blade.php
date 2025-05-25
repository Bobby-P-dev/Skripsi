<header class="bg-white shadow flex items-center justify-between px-8 py-4 relative">
    <h1 class="text-2xl font-semibold text-gray-700">Dashboard</h1>
    <div class="relative">

        <button id="dropdownUserButton" type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300" aria-expanded="false">
            <span class="sr-only">Open user menu</span>
            <img class="w-8 h-8 rounded-full"
                src="@if(Auth::check() && Auth::user()->path_fotonya_dmn_ini_bob)
                        {{ asset('storage/' . Auth::user()->foto_profil) }}
                    @else
                        https://flowbite.com/docs/images/people/profile-picture-5.jpg
                    @endif"
                alt="user photo">
        </button>

        <div id="dropdownUserMenu" class="z-50 hidden absolute right-0 mt-2 w-48 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm">
            <div class="px-4 py-3">
                @if(Auth::check())
                <p class="text-sm text-gray-900">{{ Auth::user()->nama_juga_bob }}</p>
                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->email }}</p>
                @else
                <p class="text-sm text-gray-900">Guest</p>
                <p class="text-sm font-medium text-gray-900 truncate">-</p>
                @endif
            </div>
            <ul class="py-1" role="none">
                <li>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left block px-4 py-2 rounded hover:bg-blue-50 text-red-600">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>

    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('dropdownUserButton');
        const dropdownMenu = document.getElementById('dropdownUserMenu');

        toggleBtn.addEventListener('click', function(event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', function(event) {
            if (!dropdownMenu.contains(event.target) && !toggleBtn.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });
    });
</script>