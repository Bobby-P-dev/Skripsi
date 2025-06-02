<x-home>
    <div class="container mx-auto px-4 py-4">

        <!-- Header -->
        <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800">Laporan Kerusakan</h1>
            @if (auth()->user()->peran === 'pelanggan')
            <button id="openModalBtn"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow transition">
                + Buat Laporan
            </button>
            @endif
        </div>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @if($laporans && count($laporans) > 0)
            @foreach ($laporans as $laporan)
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all overflow-hidden flex flex-col">
                <!-- Gambar -->
                <div class="relative">
                    @if (!empty($laporan->foto_url))
                    <img src="{{ $laporan->foto_url }}"
                        alt="Gambar Laporan"
                        class="w-full h-48 object-cover cursor-pointer previewable"
                        data-src="{{ $laporan->foto_url }}">
                    @else
                    <img src="{{ asset('images/tirta.png') }}"
                        alt="Gambar Laporan"
                        class="w-full h-48 object-cover cursor-pointer previewable"
                        data-src="{{ asset('images/tirta.png') }}">
                    @endif
                    <!-- Badge Status -->
                    <span class="absolute top-3 right-3 bg-{{ $laporan->status == 'selesai' ? 'green' : ($laporan->status == 'proses' ? 'yellow' : 'red') }}-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                        {{ ucfirst($laporan->status) }}
                    </span>
                    <!-- Badge Urgensi -->
                    <span class="absolute top-3 left-3 bg-{{ $laporan->tingkat_urgensi == 'tinggi' ? 'red' : ($laporan->tingkat_urgensi == 'sedang' ? 'yellow' : 'blue') }}-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">
                        {{ ucfirst($laporan->tingkat_urgensi) }}
                    </span>
                </div>

                <!-- Konten -->
                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800 line-clamp-1">{{ $laporan->judul }}</h2>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $laporan->deskripsi }}</p>
                        <div class="flex items-center gap-2 mb-2">
                            @if(isset($laporan->user) && $laporan->foto_pelanggan)
                            <img src="{{ asset('storage/' . $laporan->foto_pelanggan) }}" alt="User" class="w-7 h-7 rounded-full border">
                            @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode( 'User') }}&background=4f46e5&color=fff&size=32" alt="User" class="w-7 h-7 rounded-full border">
                            @endif
                            <span class="text-xs text-gray-500">{{ $laporan->nama_pelanggan ?? 'Anonim' }}</span>
                        </div>
                        <div class="flex items-center gap-1 text-sm text-gray-500">
                            <span class="inline-flex items-center gap-1">
                                📍{{ $laporan->lokasi }}
                            </span>
                            <span>|</span>
                            <span>{{ \Carbon\Carbon::parse($laporan->created_at)->diffForHumans() }}</span>
                        </div>
                    </div>
                    <div class="mt-3 flex justify-between items-center">
                        <button
                            class="inline-flex items-center gap-1 text-sm text-indigo-600 font-semibold hover:underline transition detail-btn"
                            data-foto="{{ $laporan->foto_url ?: asset('images/tirta.png') }}"
                            data-status="{{ $laporan->status }}"
                            data-urgensi="{{ $laporan->tingkat_urgensi }}"
                            data-judul="{{ $laporan->judul }}"
                            data-deskripsi="{{ $laporan->deskripsi }}"
                            data-userfoto="{{ isset($laporan->user) && $laporan->user->foto_pelanggan ? asset('storage/' . $laporan->user->profile_photo_path) : 'https://ui-avatars.com/api/?name=' . urlencode($laporan->user->name ?? 'User') . '&background=4f46e5&color=fff&size=32' }}"
                            data-username="{{ $laporan->nama_pelanggan ?? 'Anonim' }}"
                            data-lokasi="{{ $laporan->lokasi }}"
                            data-tanggal="{{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d F Y H:i') }}">
                            Lihat detail →
                        </button>
                        <!-- button edit -->
                        <div>
                            <button class="show-modal rounded-full bg-blue-500 border px-3 py-3"
                                data-id="{{ $laporan->laporan_uuid }}">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


            @else
            <div class="col-span-full flex flex-col items-center justify-center min-h-[60vh] text-center px-4">
                <div class="w-32 mb-4 text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 88 88" fill="currentColor">
                        <path d="m86.69 32.608-8.65-4.868 8.65-4.868a1 1 0 0 0 0-1.744l-32-18a1.002 1.002 0 0 0-.98 0L44 8.593l-9.71-5.465a1.002 1.002 0 0 0-.98 0l-32 18a1 1 0 0 0 0 1.744l8.65 4.868-8.65 4.868a1 1 0 0 0 0 1.744l9.69 5.45V66a1.001 1.001 0 0 0 .51.872l32 18A1.203 1.203 0 0 0 44 85a1.232 1.232 0 0 0 .49-.128l32-18A1.001 1.001 0 0 0 77 66V39.802l9.69-5.45a1 1 0 0 0 0-1.744zM43 44.03 14.04 27.74 43 11.45zm2-32.58 28.96 16.29L45 44.03zm9.2-6.303L84.161 22 76 26.593 46.04 9.74zm-20.4 0 8.16 4.593-22.47 12.64L12 26.593 3.839 22zM12 28.887 41.96 45.74l-8.16 4.593L3.839 33.48zm1 12.042 20.31 11.423a1 1 0 0 0 .98 0L43 47.45v34.84L13 65.415zm62 0v24.486L45 82.29V47.45l8.71 4.901a1 1 0 0 0 .98 0zm-20.8 9.404-8.16-4.593L76 28.888l8.161 4.592z" />
                    </svg>
                </div>
                <h1 class="text-xl font-semibold text-gray-700">Tidak ada Data Laporan</h1>
                <p class="text-sm text-gray-500 mt-2">Silakan tambahkan laporan terlebih dahulu.</p>
            </div>
            @endif

        </div>

        <!-- Modal -->

        <div id="detailModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-40 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg relative">
                <button id="closeDetailModal" class="absolute -top-2 right-1 text-gray-400 hover:text-gray-700 text-4xl">&times;</button>
                <div class="p-6">
                    <div class="mb-4">
                        <img id="detailFoto" src="" alt="Foto Laporan" class="w-full h-56 object-cover rounded mb-2">
                        <div class="flex gap-2 mb-2">
                            <span id="detailStatus" class="px-3 py-1 rounded-full text-xs font-semibold"></span>
                            <span id="detailUrgensi" class="px-3 py-1 rounded-full text-xs font-semibold"></span>
                        </div>
                    </div>
                    <h2 id="detailJudul" class="text-xl font-bold text-gray-800 mb-2"></h2>
                    <p id="detailDeskripsi" class="text-gray-700 mb-4"></p>
                    <div class="flex items-center gap-2 mb-2">
                        <img id="detailUserFoto" src="" alt="User" class="w-8 h-8 rounded-full border">
                        <span id="detailUserName" class="text-sm text-gray-600"></span>
                    </div>
                    <div class="text-sm text-gray-500 mb-1">
                        <span id="detailLokasi"></span> • <span id="detailTanggal"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('laporan.preview-image')
    @include('laporan.create')
    @include('laporan.edit')
    <script>
        //create modal
        document.addEventListener('DOMContentLoaded', () => {
            const buatLaporanModalElement = document.getElementById('buatLaporanModal');
            const openBuatLaporanBtns = document.getElementById('openModalBtn');
            const closeBuatLaporanBtn = document.getElementById('closeModalBtn');

            openBuatLaporanBtns.addEventListener('click', () => {
                if (buatLaporanModalElement) {
                    buatLaporanModalElement.classList.add('flex');
                    buatLaporanModalElement.classList.remove('hidden');
                }
            });

            closeBuatLaporanBtn.addEventListener('click', () => {
                if (buatLaporanModalElement) {
                    buatLaporanModalElement.classList.add('hidden');
                    buatLaporanModalElement.classList.remove('flex');
                }
            });

            if (buatLaporanModalElement) {
                buatLaporanModalElement.addEventListener('click', (event) => {
                    if (event.target === buatLaporanModalElement) {
                        buatLaporanModalElement.classList.add('hidden');
                        buatLaporanModalElement.classList.remove('flex');
                    }
                });
            }

            //edit
            const editModalElement = document.getElementById('editLaporanModal');
            const openEditModalBtns = document.querySelectorAll('.show-modal');
            const closeModalHeaderBtn = document.getElementById('closeModalHeaderBtn');
            const closeEditModalFooterBtn = document.getElementById('closeEditModalFooterBtn');
            let triggerElement = null;
            const animationDuration = 300;

            if (editModalElement) {
                const openEditModal = async function(event) {
                    triggerElement = event.currentTarget;
                    const laporanUuid = triggerElement.dataset.id;

                    console.log('Tombol .show-modal diklik. UUID Laporan:', laporanUuid);

                    if (laporanUuid) {
                        try {
                            const response = await fetch(`/laporan/edit/${laporanUuid}`);

                            if (!response.ok) {
                                const errorData = await response.text();
                                console.error('Gagal mengambil data laporan:', response.status, errorData);
                                alert(`Gagal memuat detail laporan (Status: ${response.status}). Silakan coba lagi.`);
                                return;
                            }

                            const data = await response.json();

                            const judulEditEl = document.getElementById('judul_edit');
                            const deskripsiEditEl = document.getElementById('deskripsi_edit');
                            const lokasiEditEl = document.getElementById('lokasi_edit');
                            const latitudeEditEl = document.getElementById('latitude_edit'); // Pastikan ID ini ada di HTML jika Anda menggunakannya
                            const longitudeEditEl = document.getElementById('longitude_edit'); // Pastikan ID ini ada di HTML jika Anda menggunakannya
                            const currentFotoPreviewEl = document.getElementById('current_foto_preview');
                            const fotoEditEl = document.getElementById('foto_edit');
                            const hiddenUuidInputEl = document.getElementById('laporan_uuid_edit');
                            const editFormEl = document.getElementById('editLaporanForm');

                            if (judulEditEl) judulEditEl.value = data.judul || '';
                            if (deskripsiEditEl) deskripsiEditEl.value = data.deskripsi || '';
                            if (lokasiEditEl) lokasiEditEl.value = data.lokasi || '';

                            // Jika Anda memiliki field latitude dan longitude di form edit:
                            if (latitudeEditEl) latitudeEditEl.value = data.latitude || '';
                            if (longitudeEditEl) longitudeEditEl.value = data.longitude || '';

                            if (currentFotoPreviewEl) {
                                if (data.foto_url) {
                                    currentFotoPreviewEl.src = data.foto_url;
                                    currentFotoPreviewEl.classList.remove('hidden');
                                } else {
                                    currentFotoPreviewEl.classList.add('hidden');
                                    currentFotoPreviewEl.src = '';
                                }
                            }
                            if (fotoEditEl) fotoEditEl.value = null;

                            if (hiddenUuidInputEl) {
                                hiddenUuidInputEl.value = laporanUuid;
                            }

                            if (editFormEl) {
                                editFormEl.action = `/laporan/update/${laporanUuid}`;
                            } else {
                                console.error('Elemen form dengan ID "editLaporanForm" tidak ditemukan.');
                            }

                            editModalElement.classList.remove('hidden');
                            editModalElement.removeAttribute('aria-hidden');
                            requestAnimationFrame(() => {
                                editModalElement.classList.remove('opacity-0', 'scale-95');
                            });
                            editModalElement.focus();

                        } catch (error) {
                            console.error('Terjadi kesalahan saat mengambil atau memproses data laporan:', error.message, error.stack);
                            alert('Terjadi kesalahan. Detail laporan tidak dapat dimuat.');
                        }
                    } else {
                        console.error('data-id (UUID Laporan) tidak ditemukan pada tombol .show-modal');
                        alert('ID Laporan tidak ditemukan pada tombol.');
                    }
                };

                const closeEditModal = function() {
                    if (!editModalElement.classList.contains('hidden')) {
                        editModalElement.classList.add('opacity-0', 'scale-95');
                        setTimeout(() => {
                            editModalElement.classList.add('hidden');
                            editModalElement.setAttribute('aria-hidden', 'true');
                            if (triggerElement) {
                                try {
                                    triggerElement.focus();
                                } catch (e) {
                                    // Kosongkan
                                }
                                triggerElement = null;
                            }
                        }, animationDuration);
                    }
                };

                openEditModalBtns.forEach(function(btn) {
                    btn.addEventListener('click', openEditModal);
                });

                if (closeModalHeaderBtn) {
                    closeModalHeaderBtn.addEventListener('click', closeEditModal);
                }

                if (closeEditModalFooterBtn) {
                    closeEditModalFooterBtn.addEventListener('click', closeEditModal);
                }

                editModalElement.addEventListener('click', function(event) {
                    if (event.target === editModalElement) {
                        closeEditModal();
                    }
                });
            }
        });
        //batas
        const previewModal = document.getElementById('imagePreviewModal');
        const previewImg = document.getElementById('previewImage');
        const closePreview = document.getElementById('closeImagePreview');

        document.querySelectorAll('.previewable').forEach(img => {
            img.addEventListener('click', () => {
                previewImg.src = img.getAttribute('data-src');
                previewModal.classList.remove('hidden');
                previewModal.classList.add('flex');
            });
        });

        closePreview.addEventListener('click', () => {
            previewModal.classList.add('hidden');
            previewModal.classList.remove('flex');
        });

        previewModal.addEventListener('click', (e) => {
            if (e.target === previewModal) {
                previewModal.classList.add('hidden');
                previewModal.classList.remove('flex');
            }
        });


        document.querySelectorAll('.detail-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                // Isi modal dengan data dari tombol
                document.getElementById('detailFoto').src = btn.dataset.foto;
                document.getElementById('detailStatus').textContent = btn.dataset.status.charAt(0).toUpperCase() + btn.dataset.status.slice(1);
                document.getElementById('detailUrgensi').textContent = btn.dataset.urgensi.charAt(0).toUpperCase() + btn.dataset.urgensi.slice(1);
                document.getElementById('detailJudul').textContent = btn.dataset.judul;
                document.getElementById('detailDeskripsi').textContent = btn.dataset.deskripsi;
                document.getElementById('detailUserFoto').src = btn.dataset.userfoto;
                document.getElementById('detailUserName').textContent = btn.dataset.username;
                document.getElementById('detailLokasi').textContent = btn.dataset.lokasi;
                document.getElementById('detailTanggal').textContent = btn.dataset.tanggal;

                // Badge warna
                const statusBadge = document.getElementById('detailStatus');
                statusBadge.className = 'px-3 py-1 rounded-full text-xs font-semibold ' +
                    (btn.dataset.status === 'selesai' ? 'bg-green-500 text-white' :
                        (btn.dataset.status === 'proses' ? 'bg-yellow-500 text-white' : 'bg-red-500 text-white'));

                const urgensiBadge = document.getElementById('detailUrgensi');
                urgensiBadge.className = 'px-3 py-1 rounded-full text-xs font-semibold ' +
                    (btn.dataset.urgensi === 'tinggi' ? 'bg-red-500 text-white' :
                        (btn.dataset.urgensi === 'sedang' ? 'bg-yellow-500 text-white' : 'bg-blue-500 text-white'));

                // Tampilkan modal
                document.getElementById('detailModal').classList.remove('hidden');
                document.getElementById('detailModal').classList.add('flex');
            });
        });

        // Tutup modal detail
        document.getElementById('closeDetailModal').addEventListener('click', function() {
            document.getElementById('detailModal').classList.add('hidden');
            document.getElementById('detailModal').classList.remove('flex');
        });
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.add('hidden');
                this.classList.remove('flex');
            }
        });
    </script>

    @stack('scripts')

</x-home>