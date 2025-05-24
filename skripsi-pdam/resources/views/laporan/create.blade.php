<!-- Modal Wrapper -->
<div id="buatLaporanModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 overflow-y-auto">
    <!-- Modal Box -->
    <div class="w-full max-w-2xl mx-4 my-10 bg-white rounded-xl shadow-xl overflow-hidden relative">
        <!-- Header -->
        <div class="bg-indigo-600 px-6 py-4 flex justify-between items-center sticky top-0 z-10">
            <h2 class="text-xl font-semibold text-white">📝 Buat Laporan Baru</h2>
            <button id="closeModalBtn" class="text-white text-3xl font-bold hover:text-gray-200">&times;</button>
        </div>

        <!-- Form (scrollable if needed) -->
        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="px-6 py-5 space-y-5 max-h-[80vh] overflow-y-auto">
            @csrf

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 text-sm px-4 py-3 rounded">
                    <ul class="list-disc ml-5">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form fields -->
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Laporan</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    placeholder="Contoh: Pipa Bocor di Jalan Merdeka" required>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    placeholder="Jelaskan detail kerusakan atau masalah...">{{ old('deskripsi') }}</textarea>
            </div>

            <div>
                <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    placeholder="Contoh: Jl. Raya No. 123" required>
            </div>

            <div>
                <label for="foto_url" class="block text-sm font-medium text-gray-700 mb-1">Foto Bukti</label>
                <input type="file" name="foto_url" id="foto_url"
                    class="w-full text-sm px-3 py-2 border border-gray-300 rounded-md bg-white file:mr-4 file:py-2 file:px-4 file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 transition"
                    accept="image/*" required>
            </div>

            <div>
                <label for="tingkat_urgensi" class="block text-sm font-medium text-gray-700 mb-1">Tingkat Urgensi</label>
                <select name="tingkat_urgensi" id="tingkat_urgensi"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                    required>
                    <option value="">-- Pilih Urgensi --</option>
                    <option value="rendah" {{ old('tingkat_urgensi') == 'rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="sedang" {{ old('tingkat_urgensi') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="tinggi" {{ old('tingkat_urgensi') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>

            <div class="pt-3 flex justify-end">
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-200 shadow">
                    🚀 Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>
