<div id="buatLaporanModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 overflow-y-auto">
    <div class="w-full max-w-2xl mx-4 my-10 bg-white rounded-xl shadow-xl overflow-hidden relative">
        <div class="bg-indigo-600 px-6 py-4 flex justify-between items-center sticky top-0 z-10">
            <h2 class="text-xl font-semibold text-white">📝 Buat Laporan Baru</h2>
            <button id="closeModalBtn" class="text-white text-3xl font-bold hover:text-gray-200">&times;</button>
        </div>

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
                <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi (Alamat)</label> {{-- Saya tambahkan (Alamat) untuk memperjelas --}}
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
            <div class="border-t border-gray-200 pt-4 mt-4">
                <p class="text-sm font-medium text-gray-700 mb-2">Koordinat Lokasi (Otomatis/Manual)</p>
                <div>
                    <label for="latitude" class="block text-xs font-medium text-gray-600">Latitude:</label>
                    <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-indigo-500 focus:outline-none"
                        required>
                </div>
                <div class="mt-2">
                    <label for="longitude" class="block text-xs font-medium text-gray-600">Longitude:</label>
                    <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-1 focus:ring-indigo-500 focus:outline-none"
                        required>
                </div>
                <button type="button" id="tombolGunakanLokasi"
                    class="mt-3 w-full inline-flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-lg text-sm transition duration-200 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Gunakan Lokasi Saya Saat Ini
                </button>
                <p id="pesanLokasi" class="text-xs mt-2"></p>
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


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded and parsed');

        const tombolLokasi = document.getElementById('tombolGunakanLokasi');
        const inputLatitude = document.getElementById('latitude');
        const inputLongitude = document.getElementById('longitude');
        const pesanLokasi = document.getElementById('pesanLokasi');

        console.log('Tombol Lokasi:', tombolLokasi);
        console.log('Input Latitude:', inputLatitude);
        console.log('Input Longitude:', inputLongitude);
        console.log('Pesan Lokasi Element:', pesanLokasi);

        if (tombolLokasi && inputLatitude && inputLongitude) {
            console.log('Event listener akan ditambahkan ke tombolLokasi.');
            tombolLokasi.addEventListener('click', function() {
                console.log('Tombol "Gunakan Lokasi Saya" DIKLIK!');

                if (navigator.geolocation) {
                    console.log('Geolocation didukung.');
                    if (pesanLokasi) {
                        pesanLokasi.textContent = 'Sedang mengambil lokasi Anda...';
                        pesanLokasi.style.color = 'blue';
                    } else {
                        console.warn('Elemen pesanLokasi tidak ditemukan, pesan tidak akan ditampilkan.');
                    }

                    navigator.geolocation.getCurrentPosition(function(position) {
                        console.log('Posisi berhasil didapatkan:', position);
                        const latitude = position.coords.latitude;
                        const longitude = position.coords.longitude;

                        inputLatitude.value = latitude.toFixed(7);
                        inputLongitude.value = longitude.toFixed(7);

                        if (pesanLokasi) {
                            pesanLokasi.textContent = 'Lokasi berhasil didapatkan!';
                            pesanLokasi.style.color = 'green';
                        }

                    }, function(error) {
                        console.error('Error geolocation:', error);
                        let message = 'Gagal mendapatkan lokasi: ';
                        if (pesanLokasi) {
                            pesanLokasi.textContent = message;
                            pesanLokasi.style.color = 'red';
                        }
                        console.error("Error Code = " + error.code + " - " + error.message);
                    }, {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    });
                } else {
                    console.warn('Geolocation tidak didukung oleh browser ini.');
                    if (pesanLokasi) {
                        pesanLokasi.textContent = "Geolocation tidak didukung oleh browser ini.";
                        pesanLokasi.style.color = 'red';
                    }
                }
            });
        } else {
            let missingElements = [];
            if (!tombolLokasi) missingElements.push('tombolGunakanLokasi');
            if (!inputLatitude) missingElements.push('latitude');
            if (!inputLongitude) missingElements.push('longitude');
            console.error('Satu atau lebih elemen penting (tombolLokasi, latitude, longitude) tidak ditemukan. Event listener TIDAK ditambahkan. Missing: ' + missingElements.join(', ')); // Log 12
        }
    });
</script>
@endpush