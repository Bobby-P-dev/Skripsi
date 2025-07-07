<x-home>
    <div class="container mx-auto px-4 py-4">

        <!-- Header -->
        <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800">Laporan Kerusakan</h1>

            <form action="{{ route('laporan.export') }}" method="GET">
                @csrf <div class="bg-white p-4 mb-4 rounded-lg border shadow-sm flex flex-col md:flex-row items-end gap-4">

                    <div class="w-full md:flex-1">
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" required
                            class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div class="w-full md:flex-1">
                        <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" required
                            class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    </div>

                    <div class="w-full md:w-auto">
                        <button type="submit"
                            class="inline-flex w-full md:w-auto items-center justify-center px-4 py-2 bg-blue-600 text-white font-semibold text-sm rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m.75 12l3 3m0 0l3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            Export ke Excel
                        </button>
                    </div>

                </div>
            </form>
        </div>

        <!-- Cards Grid -->
        <div id="laporan-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">


            @if($laporanSaya['laporan'] && count($laporanSaya['laporan']) > 0)
            @foreach ($laporanSaya['laporan'] as $laporan)
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all overflow-hidden flex flex-col">
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
                            class="inline-flex items-center gap-1 text-sm text-indigo-600 font-semibold hover:underline transition detail-data-laporan-btn"
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

        <div class="mt-8 w-full">
            {{ $laporanSaya['laporan']->links() }}
        </div>
    </div>

    @include('admin.penugasan.penugasan-create')
    @include('laporan.preview-image')
    @include('laporan.create')
    @include('admin.partials.laporan-js')
</x-home>