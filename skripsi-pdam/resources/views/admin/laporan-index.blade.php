<x-home>
    <div class="container mx-auto px-4 py-4">

        <!-- Header -->
        <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
            <div class="flex flex-col gap-3">
                <h1 class="text-3xl font-bold text-gray-800">Laporan Kerusakan</h1>
                
                <!-- Filter -->
                <form method="GET" action="{{ route('laporan.admin') }}" class="flex flex-col sm:flex-row items-center gap-4 bg-white p-4 rounded-xl shadow-md border border-gray-100 max-w-2xl">
                    <div class="flex-grow w-full">
                        <label for="status" class="sr-only">Filter Berdasarkan Status</label>
                            <div class="relative">
                                <select id="status" name="status"
                                    class="block w-full appearance-none bg-gray-50 border border-gray-200 rounded-lg py-2 pl-4 pr-10 text-base text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 sm:text-sm transition duration-200 ease-in-out cursor-pointer">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="flex-shrink-0 w-full sm:w-auto">
                            <button type="submit"
                            class="w-full inline-flex items-center justify-center px-3 py-1 gap-2 rounded-md bg-blue-50 text-blue-700 font-semibold shadow hover:bg-blue-100 transition">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V19l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Terapkan Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Export Excel -->
            <form action="{{ route('laporan.export') }}" method="GET"
                class="flex flex-wrap items-center gap-4 bg-white p-4 rounded-xl shadow-md border border-gray-100">

                <div class="flex flex-col">
                    <label for="tanggal_mulai" class="text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                        class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                </div>

                <div class="flex flex-col">
                    <label for="tanggal_selesai" class="text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                        class="border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                </div>

                <div class="flex">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-md bg-blue-50 text-blue-700 font-semibold shadow hover:bg-blue-100 transition">
                        Export ke Excel
                    </button>
                </div>
            </form>

            <!-- Tambah Laporan -->
            @if (auth()->user()->peran === 'pelanggan')
            <button id="openModalBtn"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow transition">
                + Buat Laporan
            </button>

            @endif
        </div>

        <!-- Cards Grid -->
        <div id="laporan-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">


            @if($laporanSaya['laporan'] && count($laporanSaya['laporan']) > 0)
            @foreach ($laporanSaya['laporan'] as $laporan)
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all overflow-hidden flex flex-col border">
                <!-- Gambar -->
                <div class="relative">
                    @if (!empty($laporan->foto_url))
                    <img src="{{ $laporan->foto_url }}"
                        alt="Gambar Laporan"
                        class="w-full h-48 object-cover cursor-pointer previewable"
                        data-src="{{ $laporan->foto_url }}">
                    @else
                    <img src="{{ asset('images/tirta.png') }}"
                        alt="Gambar Laporan"
                        class="w-full h-48 object-cover cursor-pointer previewable"
                        data-src="{{ asset('images/tirta.png') }}">
                    @endif
                    <!-- Badge Status -->
                    <span class="absolute top-3 right-3 bg-{{ $laporan->status == 'selesai' ? 'green' : ($laporan->status == 'proses' ? 'yellow' : 'red') }}-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                        {{ ucfirst($laporan->status) }}
                    </span>
                    <!-- Badge Urgensi -->
                    <span class="absolute top-3 left-3 bg-{{ $laporan->tingkat_urgensi == 'tinggi' ? 'red' : ($laporan->tingkat_urgensi == 'sedang' ? 'yellow' : 'blue') }}-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                        {{ ucfirst($laporan->tingkat_urgensi) }}
                    </span>
                </div>

                <!-- Konten -->
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800 line-clamp-1">{{ $laporan->judul }}</h2>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $laporan->deskripsi }}</p>
                        <div class="flex items-center gap-2 mb-2">
                            @if(isset($laporan->user) && $laporan->foto_pelanggan)
                            <img src="{{ asset('storage/' . $laporan->foto_pelanggan) }}" alt="User" class="w-7 h-7 rounded-full border">
                            @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($laporan->user->name ?? 'User') }}&background=4f46e5&color=fff&size=32" alt="User" class="w-7 h-7 rounded-full border">
                            @endif
                            <span class="text-xs text-gray-500">{{ $laporan->nama_pelanggan?? 'Anonim' }}</span>
                        </div>
                        <div class="flex items-center gap-1 text-sm text-gray-500">
                            <span class="inline-flex items-center gap-1">
                                📍{{ $laporan->lokasi }}
                            </span>
                            <span>|</span>
                            <span>{{ \Carbon\Carbon::parse($laporan->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="mt-3 flex justify-between items-center">
                        <button
                            class="inline-flex items-center gap-1 text-sm text-indigo-600 font-semibold hover:underline transition detail-btn"
                            data-id="{{ $laporan->id }}"
                            data-foto="{{ $laporan->foto_url ?: asset('images/tirta.png') }}"
                            data-status="{{ $laporan->status }}"
                            data-urgensi="{{ $laporan->tingkat_urgensi }}"
                            data-judul="{{ $laporan->judul }}"
                            data-deskripsi="{{ $laporan->deskripsi }}"
                            data-userfoto="{{ isset($laporan->user) && $laporan->user->profile_photo_path ? asset('storage/' . $laporan->user->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($laporan->user->name ?? 'User') . '&background=4f46e5&color=fff&size=32' }}"
                            data-username="{{ $laporan->nama_pelanggan ?? 'Anonim' }}"
                            data-lokasi="{{ $laporan->lokasi }}"
                            data-tanggal="{{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d F Y H:i') }}">
                            Lihat detail →
                        </button>

                        <div class="flex justify-end gap-2">
                            @if ($laporan->status === 'pending')
                            <form action="{{ route('laporan.tolak', ['laporan' => $laporan->getKey()]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="inline-flex items-center gap-1 rounded-lg border border-red-500 bg-red-50 text-red-600 hover:bg-red-100 px-4 py-1.5 text-sm font-semibold transition">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg> -->
                                    Tolak
                                </button>
                            </form>

                            <form action="{{ route('laporan.konfirmasi', ['laporan' => $laporan->getKey()]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="inline-flex items-center gap-1 rounded-lg border border-green-500 bg-green-50 text-green-600 hover:bg-green-100 px-4 py-1.5 text-sm font-semibold transition">
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg> -->
                                    Konfirmasi
                                </button>
                            </form>
                            @elseif ($laporan->status === 'diterima')
                            <button
                                type="button"
                                class="open-penugasan-modal-btn inline-flex items-center gap-1 rounded-lg border border-blue-500 bg-blue-50 text-blue-600 hover:bg-blue-100 px-4 py-1.5 text-sm font-semibold transition"
                                data-laporan-uuid="{{ $laporan->laporan_uuid }}">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg> -->
                                Buat Penugasan
                            </button>

                            @elseif ($laporan->status === 'ditolak')
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-span-full flex flex-col items-center justify-center min-h-[60vh] text-center px-4">
                <div class="w-32 mb-4 text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 88 88" fill="currentColor">
                        <path d="m86.69 32.608-8.65-4.868 8.65-4.868a1 1 0 0 0 0-1.744l-32-18a1.002 1.002 0 0 0-.98 0L44 8.593l-9.71-5.465a1.002 1.002 0 0 0-.98 0l-32 18a1 1 0 0 0 0 1.744l8.65 4.868-8.65 4.868a1 1 0 0 0 0 1.744l9.69 5.45V66a1.001 1.001 0 0 0 .51.872l32 18A1.203 1.203 0 0 0 44 85a1.232 1.232 0 0 0 .49-.128l32-18A1.001 1.001 0 0 0 77 66V39.802l9.69-5.45a1 1 0 0 0 0-1.744zM43 44.03 14.04 27.74 43 11.45zm2-32.58 28.96 16.29L45 44.03zm9.2-6.303L84.161 22 76 26.593 46.04 9.74zm-20.4 0 8.16 4.593-22.47 12.64L12 26.593 3.839 22zM12 28.887 41.96 45.74l-8.16 4.593L3.839 33.48zm1 12.042 20.31 11.423a1 1 0 0 0 .98 0L43 47.45v34.84L13 65.415zm62 0v24.486L45 82.29V47.45l8.71 4.901a1 1 0 0 0 .98 0zm-20.8 9.404-8.16-4.593L76 28.888l8.161 4.592z" />
                    </svg>
                </div>
                <h1 class="text-xl font-semibold text-gray-700">Tidak ada Data Laporan</h1>
                <p class="text-sm text-gray-500 mt-2">Data laporan belum tersedia saat ini. Silakan periksa kembali nanti.</p>
            </div>
            @endif
        </div>

        <!-- Modal -->
        <div id="detailModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-40 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg relative">
                <button id="closeDetailModal" class="absolute -top-2 right-1 text-gray-400 hover:text-gray-700 text-4xl">&times;</button>
                <div class="p-6">
                    <div class="mb-4">
                        <img id="detailFoto" src="" alt="Foto Laporan" class="w-full h-56 object-cover rounded mb-2">
                        <div class="flex gap-2 mb-2">
                            <span id="detailStatus" class="px-3 py-1 rounded-full text-xs font-semibold"></span>
                            <span id="detailUrgensi" class="px-3 py-1 rounded-full text-xs font-semibold"></span>
                        </div>
                    </div>
                    <h2 id="detailJudul" class="text-xl font-bold text-gray-800 mb-2"></h2>
                    <p id="detailDeskripsi" class="text-gray-700 mb-4"></p>
                    <div class="flex items-center gap-2 mb-2">
                        <img id="detailUserFoto" src="" alt="User" class="w-8 h-8 rounded-full border">
                        <span id="detailUserName" class="text-sm text-gray-600"></span>
                    </div>
                    <div class="text-sm text-gray-500 mb-1">
                        <span id="detailLokasi"></span> • <span id="detailTanggal"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- buatkan paginate nya mas 6 -->
    </div>

    @include('admin.penugasan.penugasan-create')
    @include('laporan.preview-image')
    @include('laporan.create')
    @include('admin.partials.laporan-js')

</x-home>