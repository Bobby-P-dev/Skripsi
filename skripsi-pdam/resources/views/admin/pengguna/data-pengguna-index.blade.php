<!-- tambahkan pagination -->

<x-home>
    <div class="md:shadow-md md:rounded-lg overflow-x-auto px-4 py-4 md:px-0 md:py-0">

        <!-- TABEL: hanya tampil di desktop -->
        <table class="min-w-max w-full divide-y divide-gray-200 hidden lg:table">
            <thead class="bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto Profil</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Telepon</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peran</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @if($users && $users->count() > 0)
                @foreach ($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex-shrink-0 h-12 w-12">
                            @if ($user->foto_profil)
                            <img class="h-12 w-12 rounded-full object-cover" src="{{ $user->foto_profil }}" alt="Foto Profil {{ $user->nama }}">
                            @else
                            <img class="h-12 w-12 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=random&color=fff" alt="Avatar {{ $user->nama }}">
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $user->nama }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-700">{{ $user->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-700">{{ $user->no_telepon ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-700 line-clamp-2">{{ $user->alamat ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($user->peran == 'admin')
                                bg-indigo-100 text-indigo-800
                            @elseif($user->peran == 'pelanggan')
                                bg-green-100 text-green-800
                            @else
                                bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($user->peran) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <button class="text-blue-600 hover:text-blue-900"
                            data-id="{{ $user->id }}"
                            data-nama="{{ $user->nama }}"
                            data-email="{{ $user->email }}"
                            data-no-telepon="{{ $user->no_telepon }}"
                            data-alamat="{{ $user->alamat }}"
                            data-peran="{{ $user->peran }}">Edit</button>
                        <button class=" text-red-600 hover:text-red-900">Hapus</button>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center">
                        <p class="text-lg text-gray-600">Tidak ada data pengguna.</p>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>

        <!-- CARD: hanya tampil di mobile & tablet -->
        <div class="block lg:hidden">
            @if($users && $users->count() > 0)
            <div class="space-y-4">
                @foreach ($users as $user)
                <div class="bg-white rounded-xl shadow-md p-4 flex flex-col gap-2 transition hover:shadow-lg">
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0">
                            @if ($user->foto_profil)
                            <img class="h-14 w-14 rounded-full object-cover border-2 border-blue-500" src="{{ $user->foto_profil }}" alt="Foto Profil {{ $user->nama }}">
                            @else
                            <img class="h-14 w-14 rounded-full object-cover border-2 border-blue-300" src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=random&color=fff" alt="Avatar {{ $user->nama }}">
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="font-bold text-lg text-gray-900">{{ $user->nama }}</div>
                            <span class="inline-block mt-1 text-xs font-semibold rounded px-2 py-0.5
                                @if($user->peran == 'admin')
                                    bg-indigo-100 text-indigo-800
                                @elseif($user->peran == 'pelanggan')
                                    bg-green-100 text-green-800
                                @else
                                    bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($user->peran) }}
                            </span>
                        </div>
                    </div>
                    <div class="mt-2 grid grid-cols-1 gap-1 text-sm">
                        <div>
                            <span class="font-medium text-gray-500">Email:</span>
                            <span class="ml-1 text-gray-800">{{ $user->email }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-500">No. Telepon:</span>
                            <span class="ml-1 text-gray-800">{{ $user->no_telepon ?? '-' }}</span>
                        </div>
                        <div>
                            <span class="font-medium text-gray-500">Alamat:</span>
                            <span class="ml-1 text-gray-800">{{ $user->alamat ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="flex gap-4 mt-3">
                        <a href="#" class="flex items-center gap-1 px-3 py-1 rounded-full bg-red-50 text-red-700 font-semibold text-sm hover:bg-red-100 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Hapus
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="py-12 text-center">
                <p class="text-lg text-gray-600">Tidak ada data pengguna.</p>
            </div>
            @endif
        </div>
    </div>

    @if ($users && $users->hasPages())
    <div class="mt-8 flex justify-center">
        <nav class="inline-flex items-center rounded-lg shadow bg-white border border-gray-200 px-3 py-2 space-x-1">
            @if ($users->onFirstPage())
            <span class="px-3 py-1 text-gray-300 cursor-default rounded">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
            @else
            <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1 bg-white hover:bg-gray-50 rounded transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            @endif

            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
            @if ($page == $users->currentPage())
            <span class="px-3 py-1 bg-blue-600 text-white font-semibold rounded">{{ $page }}</span>
            @else
            <a href="{{ $url }}" class="px-3 py-1 bg-white text-gray-700 hover:bg-gray-50 rounded transition">{{ $page }}</a>
            @endif
            @endforeach

            @if ($users->hasMorePages())
            <a href="{{ $users->nextPageUrl() }}" class="px-3 py-1 bg-white hover:bg-gray-50 rounded transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
            @else
            <span class="px-3 py-1 text-gray-300 cursor-default rounded">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </span>
            @endif
        </nav>
    </div>
    @endif
</x-home>