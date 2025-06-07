<!-- tambahkan pagination -->

<x-home>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between py-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Pengguna</h1>
            <button id="openBtn" class="rounded-full bg-blue-600" type="submit">
                Create Akun
            </button>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Foto Profil
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No. Telepon
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Peran
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if($users && $users->count() > 0)
                    @foreach ($users as $user) {{-- $users di sini adalah pengguna untuk halaman saat ini --}}
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
                            <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <a href="#" class="text-red-600 hover:text-red-900">Hapus</a>
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
        </div>

        {{-- Ini bagian penting untuk navigasi halaman --}}
        @if ($users && $users->hasPages())
        <div class="mt-8 flex justify-center">
            <nav class="inline-flex items-center rounded-lg shadow bg-white border border-gray-200 px-3 py-2 space-x-1">
                {{-- Previous Page --}}
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

                {{-- Page Number --}}
                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                @if ($page == $users->currentPage())
                <span class="px-3 py-1 bg-blue-600 text-white font-semibold rounded">{{ $page }}</span>
                @else
                <a href="{{ $url }}" class="px-3 py-1 bg-white text-gray-700 hover:bg-gray-50 rounded transition">{{ $page }}</a>
                @endif
                @endforeach

                {{-- Next Page --}}
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

    </div>
</x-home>

@include('auth.register')
<!-- script untuk modal create, edit delete dll -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mata-mata #1: Apakah script ini berjalan?
        console.log('Script modal dimulai...');

        const openBtn = document.getElementById('openBtn');
        const modalCreate = document.getElementById('createModal');
        const closeBtn = document.getElementById('closeBtn');

        // Mata-mata #2: Apakah elemen-elemennya ditemukan?
        console.log('Elemen openBtn:', openBtn);
        console.log('Elemen modalCreate:', modalCreate);
        console.log('Elemen closeBtn:', closeBtn);

        // Pastikan semua elemen ditemukan sebelum menambahkan event listener
        if (openBtn && modalCreate && closeBtn) {

            // Mata-mata #3: Konfirmasi bahwa kita akan memasang event listener
            console.log('Semua elemen ditemukan, event listener akan dipasang.');

            // Event untuk membuka modal
            openBtn.addEventListener('click', () => {
                // Mata-mata #4: Apakah klik ini terdeteksi?
                console.log('TOMBOL BUKA DIKLIK!');
                modalCreate.classList.add('flex');
                modalCreate.classList.remove('hidden');
            });

            // Event untuk menutup modal dengan tombol 'X'
            closeBtn.addEventListener('click', () => {
                console.log('TOMBOL TUTUP DIKLIK!');
                modalCreate.classList.remove('flex');
                modalCreate.classList.add('hidden');
            });

            // Event untuk menutup modal dengan klik di luar area form
            modalCreate.addEventListener('click', (e) => {
                if (e.target === modalCreate) {
                    console.log('AREA LUAR DIKLIK!');
                    modalCreate.classList.remove('flex');
                    modalCreate.classList.add('hidden');
                }
            });

        } else {
            // Mata-mata #5: Jika ada elemen yang tidak ditemukan
            console.error('SATU ATAU LEBIH ELEMEN MODAL TIDAK DITEMUKAN!');
        }
    });
</script>