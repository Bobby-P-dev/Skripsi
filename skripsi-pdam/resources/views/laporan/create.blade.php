<!-- Modal Wrapper -->
<div id="buatLaporanModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <!-- Modal Box -->
    <div class="max-w-3xl w-full mx-4 bg-white rounded-lg shadow-md overflow-hidden relative">
        <!-- Header Modal -->
        <div class="bg-blue-600 py-4 px-6 relative">
            <!-- Tombol Close -->
            <button id="closeModalBtn" class="absolute top-3 right-3 text-white text-2xl hover:text-gray-200">
                &times;
            </button>
            <h1 class="text-2xl font-bold text-white">Buat Laporan Baru</h1>
        </div>

        <!-- Form -->
        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            {{-- Tampilkan error validasi --}}
            @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            {{-- Form Fields... (judul, deskripsi, dll tetap seperti yang kamu buat) --}}
            <!-- Judul -->
            <div class="mb-6">
                <label for="judul" class="block text-gray-700 font-medium mb-2">Judul Laporan</label>
                <input type="text" name="judul" id="judul" class="w-full px-4 py-2 border rounded-lg"
                    value="{{ old('judul') }}" required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label for="deskripsi" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="5"
                    class="w-full px-4 py-2 border rounded-lg">{{ old('deskripsi') }}</textarea>
            </div>

            <!-- Lokasi -->
            <div class="mb-6">
                <label for="lokasi" class="block text-gray-700 font-medium mb-2">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" class="w-full px-4 py-2 border rounded-lg"
                    value="{{ old('lokasi') }}" required>
            </div>

            <!-- Foto -->
            <div class="mb-6">
                <label for="foto_url" class="block text-gray-700 font-medium mb-2">Foto Bukti</label>
                <input type="file" name="foto_url" id="foto_url" class="w-full px-4 py-2 border rounded-lg"
                    accept="image/*" required>
            </div>

            <!-- Urgensi -->
            <div class="mb-6">
                <label for="tingkat_urgensi" class="block text-gray-700 font-medium mb-2">Tingkat Urgensi</label>
                <select name="tingkat_urgensi" id="tingkat_urgensi"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                    <option value="">Pilih Tingkat Urgensi</option>
                    <option value="rendah" {{ old('tingkat_urgensi') == 'rendah' ? 'selected' : '' }}>Rendah</option>
                    <option value="sedang" {{ old('tingkat_urgensi') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="tinggi" {{ old('tingkat_urgensi') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>

            <!-- Submit -->
            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>