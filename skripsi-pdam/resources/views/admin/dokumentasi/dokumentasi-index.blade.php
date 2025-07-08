<x-home>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Dokumentasi Teknisi</h1>

        @if($data && count($data) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($data as $dokumentasi)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-[1.02] flex flex-col h-full">
                <!-- Foto -->
                <div class="h-48 overflow-hidden">
                    <img src="{{ $dokumentasi->foto_url ?? 'https://via.placeholder.com/300x200?text=No+Image' }}"
                        alt="Foto Dokumentasi"
                        class="w-full h-full object-cover object-center">
                </div>

                <!-- Konten -->
                <div class="p-5 flex flex-col flex-1 justify-between">
                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-gray-500">
                            <span class="font-semibold text-indigo-600 truncate">
                                {{ $dokumentasi->laporan->judul }}
                            </span>
                            <span class="bg-green-100 text-green-700 text-sm px-2 py-1 rounded-full">
                                {{ \Carbon\Carbon::parse($dokumentasi->creation_date)->diffForHumans() }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-500 break-all">UUID - {{ $dokumentasi->laporan_uuid }}</div>
                        <div class="text-sm text-gray-500">📍 Lokasi: <span class="text-gray-700">{{ $dokumentasi->laporan->lokasi }}</span></div>
                        <div class="text-sm text-gray-500">👨‍🔧 Teknisi: <span class="text-gray-700">{{ $dokumentasi->teknisi->nama }}</span></div>

                        <hr class="my-2">

                        <div class="text-sm text-gray-600">
                            <strong>Keterangan:</strong>
                            <p class="text-gray-800">{{ $dokumentasi->keterangan }}</p>
                        </div>
                        <div class="text-sm text-gray-600">
                            <strong>Tindakan:</strong>
                            <p class="text-gray-800">{{ $dokumentasi->tindakan }}</p>
                        </div>
                    </div>

                    <!-- Action -->
                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ $dokumentasi->foto_url }}" target="_blank"
                            class="inline-flex items-center gap-2 text-sm bg-indigo-600 text-white px-3 py-1.5 rounded hover:bg-indigo-700 transition shadow-sm">
                            🔍 Lihat Foto
                        </a>

                        <button onclick="showModal({{ $loop->index }})"
                            class="inline-flex items-center gap-2 text-sm bg-gray-100 text-gray-800 px-3 py-1.5 rounded hover:bg-gray-200 transition shadow-sm">
                            📄 Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Detail -->
            <div id="modal-{{ $loop->index }}" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
                <div class="bg-white rounded-xl w-full max-w-md p-6 shadow-xl relative">
                    <button onclick="closeModal({{ $loop->index }})"
                        class="absolute top-3 right-4 text-gray-400 hover:text-red-500 text-xl">&times;</button>

                    <h2 class="text-lg font-bold text-gray-800 mb-3">📄 Detail Dokumentasi</h2>
                    <div class="text-sm space-y-2">
                        <p><strong>Judul Laporan:</strong> {{ $dokumentasi->laporan->judul }}</p>
                        <p><strong>UUID:</strong> {{ $dokumentasi->laporan_uuid }}</p>
                        <p><strong>Lokasi:</strong> {{ $dokumentasi->laporan->lokasi }}</p>
                        <p><strong>Keterangan:</strong> {{ $dokumentasi->keterangan }}</p>
                        <p><strong>Tindakan:</strong> {{ $dokumentasi->tindakan }}</p>
                        <p><strong>Dibuat:</strong> {{ \Carbon\Carbon::parse($dokumentasi->creation_date)->translatedFormat('d F Y H:i') }}</p>
                        <div class="mt-3">
                            <img src="{{ $dokumentasi->foto_url }}" alt="Foto Dokumentasi" class="rounded-lg border shadow w-full">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @else
        <div class="text-center py-20 text-gray-500">
            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 4v16m8-8H4" />
            </svg>
            <h2 class="text-xl font-semibold">Belum ada dokumentasi yang tersedia</h2>
        </div>
        @endif
    </div>

    <!-- Modal Script -->
    <script>
        function showModal(index) {
            document.getElementById('modal-' + index).classList.remove('hidden');
            document.getElementById('modal-' + index).classList.add('flex');
        }

        function closeModal(index) {
            document.getElementById('modal-' + index).classList.add('hidden');
            document.getElementById('modal-' + index).classList.remove('flex');
        }
    </script>
</x-home>
