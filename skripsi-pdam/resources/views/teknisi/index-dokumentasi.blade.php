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
            <div class="col-span-full flex flex-col items-center justify-center min-h-[60vh] text-center px-4">
                <div class="w-32 mb-4 text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 88 88" fill="currentColor">
                        <path d="m86.69 32.608-8.65-4.868 8.65-4.868a1 1 0 0 0 0-1.744l-32-18a1.002 1.002 0 0 0-.98 0L44 8.593l-9.71-5.465a1.002 1.002 0 0 0-.98 0l-32 18a1 1 0 0 0 0 1.744l8.65 4.868-8.65 4.868a1 1 0 0 0 0 1.744l9.69 5.45V66a1.001 1.001 0 0 0 .51.872l32 18A1.203 1.203 0 0 0 44 85a1.232 1.232 0 0 0 .49-.128l32-18A1.001 1.001 0 0 0 77 66V39.802l9.69-5.45a1 1 0 0 0 0-1.744zM43 44.03 14.04 27.74 43 11.45zm2-32.58 28.96 16.29L45 44.03zm9.2-6.303L84.161 22 76 26.593 46.04 9.74zm-20.4 0 8.16 4.593-22.47 12.64L12 26.593 3.839 22zM12 28.887 41.96 45.74l-8.16 4.593L3.839 33.48zm1 12.042 20.31 11.423a1 1 0 0 0 .98 0L43 47.45v34.84L13 65.415zm62 0v24.486L45 82.29V47.45l8.71 4.901a1 1 0 0 0 .98 0zm-20.8 9.404-8.16-4.593L76 28.888l8.161 4.592z" />
                    </svg>
                </div>
                <h1 class="text-xl font-semibold text-gray-700">Tidak ada Data Dokumentasi</h1>
                <!-- <p class="text-sm text-gray-500 mt-2">Silahkan membuat dokumentasi.</p> -->
            </div>
        @endif
    </div>
</x-home>
