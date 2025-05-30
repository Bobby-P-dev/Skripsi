<?php

namespace App\Services\Laporan\User;

use App\Models\Laporan_Model;
use Illuminate\Database\Eloquent\Collection;

class LaporanPenggunaImpl implements LaporanPengguna
{
    public function IndexLaporan(int $userId): Collection
    {
        return Laporan_Model::with('pelanggan')
            ->where('pelanggan_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }


    public function CreateLaporan(array $data): ?Laporan_Model
    {
        return Laporan_Model::create($data);
    }

    public function UpdateLaporan(string $laporan_uuid, array $data): ?Laporan_Model
    {
        $laporan = Laporan_Model::where('laporan_uuid', $laporan_uuid)->first();
        if ($laporan) {
            $laporan->update($data);
            return $laporan->fresh();
        }

        return null;
    }

    public function getLaporanByUuId(string $laporan_uuid): ?Laporan_Model
    {
        return Laporan_Model::where('laporan_uuid', $laporan_uuid)->first();
    }

    // public function getLaporanById(string $laporan_uuid): ?Laporan_Model
    // {
    //     return Laporan_Model::where('laporan_uuid', $laporan_uuid)->first();
    // }


    // public function getAllLaporan(int $userId): Collection
    // {
    //     return Laporan_Model::where('pengguna_id', $userId)
    //         ->orderBy('created_at', 'desc')
    //         ->get();
    // }

    // public function updateLaporan(string $laporan_uuid, array $data): ?Laporan_Model
    // {
    //     $laporan = $this->getLaporanById($laporan_uuid);
    //     if ($laporan) {
    //         $laporan->update($data);
    //         return $laporan->fresh();
    //     }
    //     return null;
    // }

    // public function deleteLaporan(string $laporan_uuid): bool
    // {
    //     $laporan = $this->getLaporanById($laporan_uuid);
    //     if ($laporan) {
    //         return $laporan->delete();
    //     }
    //     return false;
    // }
}
