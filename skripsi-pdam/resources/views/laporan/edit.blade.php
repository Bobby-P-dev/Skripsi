<div id="editLaporanModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 overflow-y-auto hidden" aria-labelledby="modal-edit-title" role="dialog" aria-modal="true">
    <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-xl mx-4 my-8">
        <!-- Tombol close bulat di kanan atas -->
        <button type="button" id="closeEditModalFooterBtn" class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center text-4xl text-gray-500 hover:text-red-500">
            &times;
        </button>
        <!-- Tambahkan wrapper overflow-y-auto + max-h-[90vh] -->
        <div class="overflow-y-auto max-h-[90vh] p-8 pt-6">
            <form id="editLaporanForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h3 class="text-2xl font-extrabold text-gray-800 mb-7 text-center" id="modal-edit-title">
                    Edit Laporan
                </h3>
                <input type="hidden" name="laporan_uuid" id="laporan_uuid_edit" value="">
                <!-- Judul -->
                <div class="mb-5">
                    <label for="judul_edit" class="block text-sm font-semibold text-gray-700 mb-1">Judul</label>
                    <input type="text" name="judul" id="judul_edit" required
                        class="block w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 px-4 py-2 shadow-sm transition text-base" />
                </div>
                <!-- Deskripsi -->
                <div class="mb-5">
                    <label for="deskripsi_edit" class="block text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi_edit" rows="3"
                        class="block w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 px-4 py-2 shadow-sm transition text-base"></textarea>
                </div>
                <!-- Lokasi -->
                <div class="mb-5">
                    <label for="lokasi_edit" class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="lokasi" id="lokasi_edit" required
                        class="block w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 px-4 py-2 shadow-sm transition text-base" />
                </div>
                <!-- Urgensi -->
                <div class="mb-5">
                    <label for="urgensi_edit" class="block text-sm font-semibold text-gray-700 mb-1">Tingkat Urgensi</label>
                    <select name="tingkat_urgensi" id="urgensi_edit" required
                        class="block w-full rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 px-4 py-2 shadow-sm transition text-base">
                        <option value="tinggi">Tinggi</option>
                        <option value="sedang">Sedang</option>
                        <option value="rendah">Rendah</option>
                    </select>
                </div>
                <!-- Foto Laporan -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Laporan Saat Ini</label>
                    <img id="current_foto_preview" src="" alt="Foto Laporan Saat Ini"
                        class="mt-2 h-48 w-full object-cover border rounded-lg shadow hidden" />
                    <input type="file" name="foto_url" id="foto_edit"
                        class="mt-3 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                    <small class="text-gray-500">Kosongkan jika tidak ingin mengubah foto laporan.</small>
                </div>
                <!-- Tombol aksi -->
                <div class="flex justify-end gap-3 mt-4">
                    <button type="submit"
                        class="inline-block px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
