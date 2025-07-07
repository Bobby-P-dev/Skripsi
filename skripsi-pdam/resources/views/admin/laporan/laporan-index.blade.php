<x-home>
    <div class="container mx-auto p-6">

        <!-- Header -->
        <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800">Laporan Kerusakan</h1>
        </div>
        <!-- batas pembuatan menu -->

        <div class="mb-10">
            <h2 class="text-2xl font-bold text-gray-800 border-b pb-2 mb-6">
                <i class="fas fa-star text-yellow-500 mr-2"></i>Cluster Laporan
            </h2>

            @forelse ($clusters as $index => $cluster)
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4 mb-6 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-gray-700">Cluster #{{ $index + 1 }} - ({{ count($cluster) }} Laporan Berdekatan)</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($cluster as $laporan)
                    {{-- KARTU LAPORAN LENGKAP ANDA DITERAPKAN DI SINI --}}
                    <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all overflow-hidden flex flex-col">
                        <div class="relative">
                            @if (!empty($laporan->foto_url))
                            <img src="{{ $laporan->foto_url }}" alt="Gambar Laporan" class="w-full h-48 object-cover cursor-pointer previewable" data-src="{{ $laporan->foto_url }}">
                            @else
                            <img src="{{ asset('images/tirta.png') }}" alt="Gambar Laporan" class="w-full h-48 object-cover cursor-pointer previewable" data-src="{{ asset('images/tirta.png') }}">
                            @endif
                            <span class="absolute top-3 right-3 bg-{{ $laporan->status == 'selesai' ? 'green' : ($laporan->status == 'proses' ? 'yellow' : 'red') }}-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">{{ ucfirst($laporan->status) }}</span>
                            <span class="absolute top-3 left-3 bg-{{ $laporan->tingkat_urgensi == 'tinggi' ? 'red' : ($laporan->tingkat_urgensi == 'sedang' ? 'yellow' : 'blue') }}-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">{{ ucfirst($laporan->tingkat_urgensi) }}</span>
                        </div>

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
                                    <span class="inline-flex items-center gap-1">📍{{ $laporan->lokasi }}</span>
                                    <span>|</span>
                                    <span>{{ \Carbon\Carbon::parse($laporan->created_at)->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div class="mt-3 flex justify-between items-center">
                                <button class="inline-flex items-center gap-1 text-sm text-indigo-600 font-semibold hover:underline transition detail-btn"
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
                                        <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-red-500 bg-red-50 text-red-600 hover:bg-red-100 px-4 py-1.5 text-sm font-semibold transition">Tolak</button>
                                    </form>
                                    <form action="{{ route('laporan.konfirmasi', ['laporan' => $laporan->getKey()]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-green-500 bg-green-50 text-green-600 hover:bg-green-100 px-4 py-1.5 text-sm font-semibold transition">Konfirmasi</button>
                                    </form>
                                    @elseif ($laporan->status === 'diterima')
                                    <button type="button" class="open-penugasan-modal-btn inline-flex items-center gap-1 rounded-lg border border-blue-500 bg-blue-50 text-blue-600 hover:bg-blue-100 px-4 py-1.5 text-sm font-semibold transition" data-laporan-uuid="{{ $laporan->laporan_uuid }}">Buat Penugasan</button>
                                    @elseif ($laporan->status === 'ditolak')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @empty
            <div class="bg-gray-50 rounded-lg p-6 text-center text-gray-500">
                <p>Tidak ada cluster laporan yang terbentuk saat ini.</p>
            </div>
            @endforelse
        </div>

        <!-- noise -->
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-6 shadow-sm mt-9">
            <h2 class="text-2xl font-bold text-gray-800 border-b pb-2 mb-6">
                <i class="fas fa-map-pin text-gray-600 mr-2"></i>Laporan Individual
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($noise as $laporans)
                {{-- KARTU LAPORAN LENGKAP ANDA DITERAPKAN LAGI DI SINI --}}
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all overflow-hidden flex flex-col">
                    <div class="relative">
                        @if (!empty($laporans->foto_url))
                        <img src="{{ $laporans->foto_url }}" alt="Gambar Laporan" class="w-full h-48 object-cover cursor-pointer previewable" data-src="{{ $laporans->foto_url }}">
                        @else
                        <img src="{{ asset('images/tirta.png') }}" alt="Gambar Laporan" class="w-full h-48 object-cover cursor-pointer previewable" data-src="{{ asset('images/tirta.png') }}">
                        @endif
                        <span class="absolute top-3 right-3 bg-{{ $laporans->status == 'selesai' ? 'green' : ($laporans->status == 'proses' ? 'yellow' : 'red') }}-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">{{ ucfirst($laporans->status) }}</span>
                        <span class="absolute top-3 left-3 bg-{{ $laporans->tingkat_urgensi == 'tinggi' ? 'red' : ($laporans->tingkat_urgensi == 'sedang' ? 'yellow' : 'blue') }}-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">{{ ucfirst($laporans->tingkat_urgensi) }}</span>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <h2 class="text-lg font-bold text-gray-800 line-clamp-1">{{ $laporans->judul }}</h2>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $laporans->deskripsi }}</p>
                            <div class="flex items-center gap-2 mb-2">
                                @if(isset($laporans->user) && $laporans->foto_pelanggan)
                                <img src="{{ asset('storage/' . $laporans->foto_pelanggan) }}" alt="User" class="w-7 h-7 rounded-full border">
                                @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($laporans->user->name ?? 'User') }}&background=4f46e5&color=fff&size=32" alt="User" class="w-7 h-7 rounded-full border">
                                @endif
                                <span class="text-xs text-gray-500">{{ $laporans->nama_pelanggan ?? 'Anonim' }}</span>
                            </div>
                            <div class="flex items-center gap-1 text-sm text-gray-500">
                                <span class="inline-flex items-center gap-1">📍{{ $laporans->lokasi }}</span>
                                <span>|</span>
                                <span>{{ \Carbon\Carbon::parse($laporans->created_at)->diffForHumans() }}</span>
                            </div>
                        </div>

                        <div class="mt-3 flex justify-between items-center">
                            <button class="inline-flex items-center gap-1 text-sm text-indigo-600 font-semibold hover:underline transition detail-btn"
                                data-id="{{ $laporans->id }}"
                                data-foto="{{ $laporans->foto_url ?: asset('images/tirta.png') }}"
                                data-status="{{ $laporans->status }}"
                                data-urgensi="{{ $laporans->tingkat_urgensi }}"
                                data-judul="{{ $laporans->judul }}"
                                data-deskripsi="{{ $laporans->deskripsi }}"
                                data-userfoto="{{ isset($laporans->user) && $laporans->user->profile_photo_path ? asset('storage/' . $laporans->user->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($laporans->user->name ?? 'User') . '&background=4f46e5&color=fff&size=32' }}"
                                data-username="{{ $laporans->nama_pelanggan ?? 'Anonim' }}"
                                data-lokasi="{{ $laporans->lokasi }}"
                                data-tanggal="{{ \Carbon\Carbon::parse($laporans->created_at)->translatedFormat('d F Y H:i') }}">
                                Lihat detail →
                            </button>
                            <div class="flex justify-end gap-2">
                                @if ($laporans->status === 'pending')
                                <form action="{{ route('laporan.tolak', ['laporan' => $laporans->getKey()]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-red-500 bg-red-50 text-red-600 hover:bg-red-100 px-4 py-1.5 text-sm font-semibold transition">Tolak</button>
                                </form>
                                <form action="{{ route('laporan.konfirmasi', ['laporan' => $laporans->getKey()]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-green-500 bg-green-50 text-green-600 hover:bg-green-100 px-4 py-1.5 text-sm font-semibold transition">Konfirmasi</button>
                                </form>
                                @elseif ($laporans->status === 'diterima')
                                <button type="button" class="open-penugasan-modal-btn inline-flex items-center gap-1 rounded-lg border border-blue-500 bg-blue-50 text-blue-600 hover:bg-blue-100 px-4 py-1.5 text-sm font-semibold transition" data-laporan-uuid="{{ $laporans->laporan_uuid }}">Buat Penugasan</button>
                                @elseif ($laporans->status === 'ditolak')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-gray-50 rounded-lg p-6 text-center text-gray-500">
                    <p>Tidak ada laporan individual (noise) saat ini.</p>
                </div>
                @endforelse
            </div>
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