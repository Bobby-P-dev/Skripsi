<?php

namespace App\Services\Laporan\Admin;

use App\Models\Laporan_Model;
use App\Models\Pengguna_Model;

class LaporanAdminImpl implements LaporanAdmin
{
    public function index()
    {
        $data = Laporan_Model::with(['pelanggan' => function ($query) {
            $query->select('pengguna_id', 'nama', 'foto_profil');
        }])->paginate(6);

        $teknisi = Pengguna_Model::where('peran', 'teknisi')->select('pengguna_id', 'nama')
            ->orderBy('pengguna_id', 'asc')
            ->paginate(6);

        return [
            'laporan' => $data,
            'teknisi' => $teknisi,
        ];
    }

    public function accLaporan(Laporan_Model $laporan)
    {
        $laporan->update([
            'admin_id' => auth()->id(),
            'status'   => 'diterima',
        ]);
    }

    public function tolakLaporan(Laporan_model $laporan)
    {
        $laporan->update([
            'admin_id' => auth()->id(),
            'status'   => 'ditolak',
        ]);
    }
}
