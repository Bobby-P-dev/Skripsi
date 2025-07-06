<x-home>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Daftar Penugasan Teknisi</h1>

        @if($data && count($data) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($data as $penugasan)
            <div class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-lg transition flex flex-col justify-between h-full">

                <!-- Gambar -->
                <div class="h-48 w-full overflow-hidden">
                    <img src="kaga ada"
                        alt="Fotonya kaga ada"
                        class="w-full h-full object-cover">
                </div>

                <!-- Konten -->
                <div class="p-6 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="mb-4">
                            <h2 class="text-lg font-semibold text-indigo-700 truncate">Laporan UUID</h2>
                            <p class="text-gray-800 text-sm break-all">{{ $penugasan->laporan_uuid }}</p>
                            <p class="text-gray-800 text-sm break-all">{{ $penugasan->judul }}</p>
                            <p class="text-gray-800 text-sm break-all">{{ $penugasan->deskripsi }}</p>
                        </div>
                        <div class="mb-2">
                            <h2 class="text-sm font-semibold text-gray-600">Tenggat Waktu</h2>
                            <p class="text-gray-700">{{ \Carbon\Carbon::parse($penugasan->tenggat_waktu)->translatedFormat('d F Y H:i') }}</p>
                        </div>
                        <div class="mb-2">
                            <h2 class="text-sm font-semibold text-gray-600">Catatan</h2>
                            <p class="text-gray-700">{{ $penugasan->catatan ?: '-' }}</p>
                        </div>
                    </div>

                    <!-- Action -->
                    <div class="mt-4 flex flex-wrap items-center justify-between gap-2">
                        <span class="inline-block text-xs font-medium bg-blue-100 text-blue-800 px-3 py-1 rounded-full">
                            Tenggat: {{ \Carbon\Carbon::parse($penugasan->tenggat_waktu)->diffForHumans() }}
                        </span>

                        @if ($penugasan->link_dokumentasi)
                                <a href="{{ $penugasan->link_dokumentasi }}" target="_blank"
                                    class="bg-green-600 hover:bg-green-700 text-white text-sm px-4 py-2 rounded-lg shadow transition">
                                    📄 Lihat Dokumentasi
                                </a>
                            @else
                                <button
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm px-4 py-2 rounded-lg shadow transition"
                                    onclick="openModal({{ $penugasan->penugasan_id }}, '{{ $penugasan->laporan_uuid }}')"
                                >
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
     <!-- Modal -->
<div id="modalDokumentasi" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-lg w-full shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Buat Dokumentasi</h2>
        <form id="formDokumentasi" method="POST" action="{{ route('dokumentasi.create') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="penugasan_id" id="penugasan_id">
            <!-- taroin laporan uuid dan teknisi id tapi di hidden, valuenya ngambil dari laporan uuid dan teknisi id ini -->
            <div class="mb-4">
                <label class="font-medium">Keterangan</label>
                <textarea name="keterangan" required class="w-full border rounded p-2"></textarea>
            </div>
            <div class="mb-4">
                <label class="font-medium">Tindakan</label>
                <textarea name="tindakan" required class="w-full border rounded p-2"></textarea>
            </div>
            <div class="mb-4">
                <label class="font-medium">Upload File</label>
                <input type="file" name="foto_url" required class="w-full border rounded p-2">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeModal()"
                    class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded">Batal</button>
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(penugasanId, laporanUuid) {
        document.getElementById('penugasan_id').value = penugasanId;
        document.getElementById('modalDokumentasi').classList.remove('hidden');
        document.getElementById('modalDokumentasi').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modalDokumentasi').classList.add('hidden');
        document.getElementById('modalDokumentasi').classList.remove('flex');
    }
</script>

</x-home>
