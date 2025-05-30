<?php

namespace App\Services\Laporan\User;

use App\Models\Laporan_Model;
use Illuminate\Database\Eloquent\Collection;

interface LaporanPengguna
{
    public function IndexLaporan(int $userId): Collection;
    public function CreateLaporan(array $data): ?Laporan_Model;
    public function UpdateLaporan(string $laporan_uuid, array $data): ?Laporan_Model;
    public function getLaporanByUuId(string $laporan_uuid): ?Laporan_Model;
    // public function getLaporanById(string $laporan_uuid): ?Laporan_Model;
    // public function getAllLaporan(int $userId): Collection;
    // public function updateLaporan(string $laporan_uuid, array $data): ?Laporan_Model;
    // public function deleteLaporan(string $laporan_uuid): bool;
}
