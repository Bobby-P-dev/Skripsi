<x-home>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Penugasan Teknisi</h1>

        @if($data && count($data) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($data as $penugasan)
            <div class="bg-white shadow rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col justify-between h-full">
                <!-- Gambar -->
                <div class="h-48 w-full overflow-hidden">
                    <img src="{{ $penugasan->laporan->foto_url ?? 'https://via.placeholder.com/300x200?text=No+Image' }}"
                        alt="Foto Laporan"
                        class="w-full h-full object-cover">
                </div>
                <!-- Konten -->
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="text-indigo-700 text-lg font-semibold mb-1 truncate">Laporan UUID</h2>
                        <p class="text-gray-800 text-sm break-all">{{ $penugasan->laporan_uuid }}</p>
                        <p class="text-gray-800 text-sm break-all">{{ $penugasan->laporan->judul }}</p>
                        <p class="text-gray-600 text-xs mt-2">Deskripsi: {{ $penugasan->laporan->deskripsi }}</p>
                        <p class="text-gray-600 text-xs">Lokasi: {{ $penugasan->laporan->lokasi }}</p>
                        <div class="mt-2 text-xs text-gray-700">
                            <strong>Tenggat:</strong> {{ \Carbon\Carbon::parse($penugasan->tenggat_waktu)->translatedFormat('d F Y H:i') }}
                        </div>
                        <div class="text-xs text-gray-700"><strong>Catatan:</strong> {{ $penugasan->catatan ?: '-' }}</div>
                    </div>
                    <!-- Action -->
                    <div class="mt-4 flex flex-wrap justify-between items-center gap-2">
                        <span class="inline-block text-xs font-medium bg-blue-100 text-blue-800 px-3 py-1 rounded-full">
                            Tenggat: {{ \Carbon\Carbon::parse($penugasan->tenggat_waktu)->diffForHumans() }}
                        </span>
                        @if ($penugasan->link_dokumentasi)
                        <a href="{{ $penugasan->link_dokumentasi }}" target="_blank"
                            class="bg-green-600 hover:bg-green-700 text-white text-xs px-4 py-2 rounded shadow transition">
                            📄 Lihat Dokumentasi
                        </a>
                        @else
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs px-4 py-2 rounded shadow transition"
                            onclick="openModal('{{ $penugasan->laporan_uuid }}')">
                            ✍️ Buat Dokumentasi
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-20">
            <p class="text-gray-500 text-lg">Belum ada penugasan untuk Anda.</p>
        </div>
        @endif
    </div>

    <!-- Modal -->
    <div id="modalDokumentasi" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-lg shadow-lg relative">
            <h2 class="text-xl font-semibold mb-4">Buat Dokumentasi</h2>
            <form id="formDokumentasi" method="POST" action="{{ route('dokumentasi.create') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="laporan_uuid" id="laporan_uuid">

                <div class="mb-4">
                    <label class="font-medium text-gray-700">Keterangan</label>
                    <textarea name="keterangan" required class="w-full border rounded p-2" placeholder="Tuliskan keterangan"></textarea>
                </div>
                <div class="mb-4">
                    <label class="font-medium text-gray-700">Tindakan</label>
                    <textarea name="tindakan" required class="w-full border rounded p-2" placeholder="Jelaskan tindakan perbaikan"></textarea>
                </div>
                <div class="mb-4">
                    <label class="font-medium text-gray-700">Upload Bukti Foto</label>
                    <input type="file" name="foto_url" id="foto_url" accept="image/*" required class="w-full border rounded p-2">
                    <div id="previewContainer" class="mt-2 hidden">
                        <p class="text-xs text-gray-500">Preview:</p>
                        <img id="previewImage" src="" alt="Preview" class="w-32 rounded border">
                    </div>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeModal()"
                        class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">Batal</button>
                    <button type="submit" id="submitButton"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded flex items-center space-x-2">
                        <span>Simpan</span>
                        <svg id="loadingSpinner" class="animate-spin hidden w-4 h-4 text-white" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8v8z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Terjadi Kesalahan:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <script>
        function openModal(laporanUuid) {
            document.getElementById('laporan_uuid').value = laporanUuid;
            document.getElementById('modalDokumentasi').classList.remove('hidden');
            document.getElementById('modalDokumentasi').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('modalDokumentasi').classList.add('hidden');
            document.getElementById('modalDokumentasi').classList.remove('flex');
            document.getElementById('previewContainer').classList.add('hidden');
            document.getElementById('foto_url').value = '';
        }

        document.getElementById('foto_url').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert("File maksimal 5MB!");
                    event.target.value = "";
                    document.getElementById('previewContainer').classList.add('hidden');
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                    document.getElementById('previewContainer').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('formDokumentasi').addEventListener('submit', function() {
            const submitBtn = document.getElementById('submitButton');
            submitBtn.disabled = true;
            document.getElementById('loadingSpinner').classList.remove('hidden');
        });
    </script>
</x-home>