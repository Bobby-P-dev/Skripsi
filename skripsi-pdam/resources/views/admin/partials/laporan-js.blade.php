<script>
    //modal create open-penugasan-modal-btn
    const openPenugasanModalBtns = document.querySelectorAll('.open-penugasan-modal-btn');
    const penugasanModal = document.getElementById('penugasan-modal');
    const closeModalBtn = document.getElementById('closeModalBtn');

    openPenugasanModalBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const laporanUuid = this.dataset.laporanUuid;
            const inputLaporanUuid = document.getElementById('data-laporan-uuid')
            if (inputLaporanUuid) {
                inputLaporanUuid.value = laporanUuid;
            } else {
                console.error('Input dengan ID "data-laporan-uuid" tidak ditemukan.');
            }

            penugasanModal.classList.remove('hidden');
            penugasanModal.classList.add('flex');
        });
    });

    closeModalBtn.addEventListener('click', function() {
        penugasanModal.classList.add('hidden');
        penugasanModal.classList.remove('flex');
    });
    penugasanModal.addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
            this.classList.remove('flex');
        }
    });

    //preview gambar
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

    // modal card ini bob
// Modal untuk semua tombol detail (baik di halaman cluster/noise atau index biasa)
document.querySelectorAll('.detail-btn, .detail-data-laporan-btn').forEach(btn => {
    btn.addEventListener('click', function (e) {
        e.preventDefault();

        // Isi modal dengan data dari tombol
        document.getElementById('detailFoto').src = btn.dataset.foto;
        document.getElementById('detailStatus').textContent = capitalizeFirst(btn.dataset.status);
        document.getElementById('detailUrgensi').textContent = capitalizeFirst(btn.dataset.urgensi);
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
        // Tombol dan modal detail
const closeDetailModalBtn = document.getElementById('closeDetailModal');
const detailModal = document.getElementById('detailModal');

// Tombol close
if (closeDetailModalBtn) {
    closeDetailModalBtn.addEventListener('click', function () {
        detailModal.classList.add('hidden');
        detailModal.classList.remove('flex');
    });
}

// Klik luar modal
if (detailModal) {
    detailModal.addEventListener('click', function (e) {
        if (e.target === this) {
            this.classList.add('hidden');
            this.classList.remove('flex');
        }
    });
}

    });
});

// Fungsi bantu untuk kapitalisasi huruf pertama
function capitalizeFirst(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
</script>