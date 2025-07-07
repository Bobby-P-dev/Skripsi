<x-home>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800">Dokumentasi Teknisi</h1>

        @if($data && count($data) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($data as $dokumentasi)
            <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col justify-between h-full">
                <!-- Gambar -->
                <div class="h-48 w-full overflow-hidden">
                    <img src="{{ $dokumentasi->foto_url ?? 'https://via.placeholder.com/300x200?text=No+Image' }}"
                        alt="Foto Dokumentasi"
                        class="w-full h-full object-cover">
                </div>
                <!-- Konten -->
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="text-indigo-700 text-lg font-semibold mb-1 truncate">Judul Laporan</h2>
                        <p class="text-gray-800 text-sm break-all">{{ $dokumentasi->laporan->judul }}</p>
                        <p class="text-gray-600 text-xs mt-1">UUID: {{ $dokumentasi->laporan_uuid }}</p>
                        <p class="text-gray-600 text-xs mt-1">Lokasi: {{ $dokumentasi->laporan->lokasi }}</p>
                        <div class="mt-2 text-xs text-gray-700">
                            <strong>Teknisi:</strong> {{ $dokumentasi->teknisi->nama }}
                        </div>
                        <div class="text-xs text-gray-700 mt-1"><strong>Keterangan:</strong> {{ $dokumentasi->keterangan }}</div>
                        <div class="text-xs text-gray-700 mt-1"><strong>Tindakan:</strong> {{ $dokumentasi->tindakan }}</div>
                    </div>
                    <!-- Action -->
                    <div class="mt-4 flex justify-between items-center gap-2">
                        <span class="inline-block text-xs font-medium bg-green-100 text-green-800 px-3 py-1 rounded-full">
                            Dibuat: {{ \Carbon\Carbon::parse($dokumentasi->creation_date)->diffForHumans() }}
                        </span>
                        <a href="{{ $dokumentasi->foto_url }}" target="_blank"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs px-4 py-2 rounded shadow transition">
                            🔍 Lihat Foto
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-20">
            <p class="text-gray-500 text-lg">Belum ada dokumentasi teknisi.</p>
        </div>
        @endif
    </div>
</x-home>
