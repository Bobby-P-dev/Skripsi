<x-home>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Dokumentasi Anda</h1>

        @if($data && count($data) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($data as $item)
            <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col">
                <!-- Foto -->
                <div class="h-48 w-full overflow-hidden">
                    <img src="{{ $item->foto_url ?? 'https://via.placeholder.com/300x200?text=No+Image' }}"
                        alt="Foto dokumentasi"
                        class="w-full h-full object-cover">
                </div>
                <!-- Konten -->
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="text-indigo-700 font-semibold mb-2 truncate">Laporan UUID</h2>
                        <p class="text-gray-800 text-sm break-all mb-2">{{ $item->laporan_uuid }}</p>
                        <h3 class="text-sm text-gray-600 font-medium">Keterangan</h3>
                        <p class="text-gray-700 text-sm mb-2">{{ $item->keterangan }}</p>
                        <h3 class="text-sm text-gray-600 font-medium">Tindakan</h3>
                        <p class="text-gray-700 text-sm mb-2">{{ $item->tindakan }}</p>
                        <h3 class="text-sm text-gray-600 font-medium">Tanggal Dokumentasi</h3>
                        <p class="text-gray-700 text-sm mb-2">
                            {{ \Carbon\Carbon::parse($item->creation_date)->translatedFormat('d F Y H:i') }}
                        </p>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('penugasant.index') }}"
                            class="text-sm text-indigo-600 hover:underline">
                            🔗 Lihat Penugasan
                        </a>
                        <a href="{{ $item->foto_url ?? '#' }}" target="_blank"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-1 rounded text-xs shadow">
                            📷 Lihat Foto
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-20">
            <p class="text-gray-500 text-lg">Belum ada dokumentasi yang Anda buat.</p>
        </div>
        @endif
    </div>
</x-home>
