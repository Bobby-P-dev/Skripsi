{{-- Modal Edit Laporan --}}
<div id="editLaporanModal" class="fixed z-50 inset-0 overflow-y-auto hidden" aria-labelledby="modal-edit-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form id="editLaporanForm" method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="bg-white px-6 pt-6 pb-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4" id="modal-edit-title">Edit Laporan</h3>

                    <input type="hidden" name="laporan_uuid_edit" id="laporan_uuid_edit">

                    <!-- Judul -->
                    <div class="mb-4">
                        <label for="judul_edit" class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="judul" id="judul_edit" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="deskripsi_edit" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi_edit" rows="3" class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-4">
                        <label for="lokasi_edit" class="block text-sm font-medium text-gray-700">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi_edit" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>

                    <!-- Urgensi -->
                    <div class="mb-4">
                        <label for="urgensi_edit" class="block text-sm font-medium text-gray-700">Tingkat Urgensi</label>
                        <select name="tingkat_urgensi" id="urgensi_edit" required class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="tinggi">Tinggi</option>
                            <option value="sedang">Sedang</option>
                            <option value="rendah">Rendah</option>
                        </select>
                    </div>

                    <!-- Foto Laporan -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Foto Laporan Saat Ini</label>
                        <img id="current_foto_preview" src="" alt="Foto Laporan" class="mt-2 h-48 w-full object-cover border rounded-md hidden">
                        <input type="file" name="foto_url" id="foto_edit" class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <small class="text-gray-500">Kosongkan jika tidak ingin mengubah foto laporan.</small>
                    </div>

                <!-- Tombol -->
                <div class="py-4 flex justify-end gap-3">
                    <!-- Bagusnya pake button close yang mana ni bob, pilih dah -->
                    
                    <!-- Button close 1 -->
                    <!-- <button type="button" id="closeEditModalFooterBtn"
                        class="px-4 py-2 bg-white text-gray-700 border border-gray-300 rounded-md shadow-sm hover:bg-gray-100">
                        Batal
                    </button> -->
                    
                    <!-- Button close 2 -->
                    <button type="button" id="closeEditModalFooterBtn" class="absolute top-0 right-3 text-gray-400 hover:text-gray-700 text-4xl">&times;</button>
                    
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
