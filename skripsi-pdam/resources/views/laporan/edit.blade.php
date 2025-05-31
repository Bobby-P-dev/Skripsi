<div id="editLaporanModal">
    @foreach ($laporans as $laporan)

<div class="fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">Edit Laporan</h3>
                        <div class="mt-2">
                            <form action="{{ route('laporan.edit', $laporan->laporan_uuid) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <!-- Gambar -->
                                <div>
                                    
                                </div>
                                <div class="mb-4">
                                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul
                                        Laporan</label>
                                    <input type="text" name="judul" id="judul" value="{{ $laporan->judul }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                                        placeholder="Contoh: Pipa Bocor di Jalan Merdeka" required>
                                </div>

                                <div class="mb-4">
                                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Jelaskan detail kerusakan atau masalah...">{{ $laporan->deskripsi }}</textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                                    <input type="text" name="lokasi" id="lokasi" value="{{ $laporan->lokasi }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                                        placeholder="Contoh: Jalan Merdeka No. 10" required>
                                </div>

                                <div class="mb-4">
                                    <label for="tingkat_urgensi" class="block text-sm font-medium text-gray-700 mb-1">Tingkat Urgensi</label>
                                    <select name="tingkat_urgensi" id="tingkat_urgensi"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
                                        <option value="tinggi" {{ $laporan->tingkat_urgensi == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                                        <option value="sedang" {{ $laporan->tingkat_urgensi == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                        <option value="rendah" {{ $laporan->tingkat_urgensi == 'rendah' ? 'selected' : '' }}>Rendah</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select name="status" id="status"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
                                        <option value="pending" {{ $laporan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                        <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </div>

                                <div class="flex justify-end gap-2 mt-6">
                                    <button type="button" onclick="this.closest('.fixed').classList.add('hidden')" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Batal</button>
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>