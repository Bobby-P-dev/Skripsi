<?php

namespace App\Exports;

use App\Models\Laporan_Model;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanExport implements FromQuery, WithHeadings, WithMapping
{
    protected $tanggalMulai;
    protected $tanggalSelesai;

    // 1. Constructor untuk menerima filter tanggal dari Controller
    public function __construct($tanggalMulai, $tanggalSelesai)
    {
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalSelesai = $tanggalSelesai;
    }

    /**
     * 2. Method ini mengambil data dari database menggunakan query.
     * Kita gunakan scope filter tanggal yang sudah dibuat sebelumnya.
     */
    public function query()
    {
        return Laporan_Model::query()
            ->with(['pelanggan', 'admin']) // Eager load relasi untuk performa lebih baik
            ->filterBerdasarkanTanggal($this->tanggalMulai, $this->tanggalSelesai)
            ->latest(); // Urutkan dari yang terbaru
    }

    /**
     * 3. Method ini mendefinisikan baris judul (header) untuk kolom di Excel.
     */
    public function headings(): array
    {
        return [
            'ID Laporan',
            'Judul',
            'Pelanggan',
            'Admin Penanggung Jawab',
            'Lokasi',
            'Status',
            'Tingkat Urgensi',
            'Tanggal Dibuat',
        ];
    }

    /**
     * 4. Method ini mengubah setiap baris data dari query menjadi format array
     * sesuai urutan yang kita inginkan di Excel.
     *
     * @var Laporan_Model $laporan
     */
    public function map($laporan): array
    {
        return [
            $laporan->laporan_uuid,
            $laporan->judul,
            $laporan->pelanggan->nama ?? 'N/A', // Mengambil nama dari relasi pelanggan
            $laporan->admin->nama ?? 'N/A', // Mengambil nama dari relasi admin
            $laporan->lokasi,
            $laporan->status,
            $laporan->tingkat_urgensi,
            $laporan->created_at->format('d-m-Y H:i'), // Format tanggal agar mudah dibaca
        ];
    }
}
