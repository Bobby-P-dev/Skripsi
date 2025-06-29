<x-home>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Data Pengguna</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto shadow rounded-lg hidden lg:block">
            <table class="min-w-full bg-white border border-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr class="text-left text-gray-600 uppercase tracking-wider">
                        <th class="py-3 px-4">Foto</th>
                        <th class="py-3 px-4">Nama</th>
                        <th class="py-3 px-4">Email</th>
                        <th class="py-3 px-4">Alamat</th>
                        <th class="py-3 px-4">No Telepon</th>
                        <th class="py-3 px-4">Peran</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                        <td class="py-3 px-4">
                            <img src="{{ $user->foto_profil ? asset('storage/'.$user->foto_profil) : 'https://ui-avatars.com/api/?name='.urlencode($user->nama).'&background=0D8ABC&color=fff' }}"
                                class="w-10 h-10 rounded-full object-cover" alt="Foto Profil">
                        </td>
                        <td class="py-3 px-4 font-semibold">{{ $user->nama }}</td>
                        <td class="py-3 px-4">{{ $user->email }}</td>
                        <td class="py-3 px-4">{{ $user->alamat }}</td>
                        <td class="py-3 px-4">{{ $user->no_telepon }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 rounded-md text-xs 
                                {{ $user->peran === 'admin' ? 'bg-green-200 text-green-800' : ($user->peran === 'teknisi' ? 'bg-yellow-200 text-yellow-800' : 'bg-blue-200 text-blue-800') }}">
                                {{ ucfirst($user->peran) }}
                            </span>
                        </td>
                        <td class="py-3 px-4 flex flex-wrap gap-2">
                            <a href="{{ route('data.update', $user->pengguna_id) }}" 
                                class="flex items-center gap-1 px-3 py-1 rounded-md bg-blue-50 text-blue-700 font-semibold text-sm hover:bg-blue-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('data.delete', $user->pengguna_id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Yakin ingin menghapus pengguna ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="flex items-center gap-1 px-3 py-1 rounded-md bg-red-50 text-red-700 font-semibold text-sm hover:bg-red-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-4 px-4 text-center text-gray-500">Tidak ada data pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

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
                            <a href="#" class="flex items-center gap-1 px-3 py-1 rounded-full bg-blue-50 text-blue-700 font-semibold text-sm hover:bg-blue-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                                </svg>
                                Edit
                            </a>
                            <a href="#" class="flex items-center gap-1 px-3 py-1 rounded-full bg-red-50 text-red-700 font-semibold text-sm hover:bg-red-100 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
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

        @if ($users && $users->hasPages())
            <div class="mt-8 flex justify-center">
                <nav class="inline-flex items-center rounded-lg shadow bg-white border border-gray-200 px-3 py-2 space-x-1">
                    @if ($users->onFirstPage())
                        <span class="px-3 py-1 text-gray-300 cursor-default rounded">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="px-3 py-1 bg-white hover:bg-gray-50 rounded transition">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    @else
                        <span class="px-3 py-1 text-gray-300 cursor-default rounded">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                            </svg>
                        </span>
                    @endif
                </nav>
            </div>
        @endif
    </div>
</x-home>
