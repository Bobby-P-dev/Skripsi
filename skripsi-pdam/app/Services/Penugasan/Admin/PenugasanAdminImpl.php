<?php

namespace App\Services\Penugasan\Admin;

use App\Models\Laporan_Model;
use App\Models\Penugasan_Model;

class PenugasanAdminImpl implements PenugasanAdmin
{
    public function store(array $penugasan)
    {
        Penugasan_Model::store([
            'laporan_uuid' => $penugasan['laporan_uuid'],
            'pengguna_id' => $penugasan['teknisi_id'],
            'admin_id'    => $penugasan['admin_id'] ?? auth()->id(),
            'tenggat_waktu' => $penugasan['tenggat_waktu'],
            'catatan'     => $penugasan['catatan'] ?? null
        ]);
        Laporan_Model::where('laporan_uuid', $penugasan['laporan_uuid'])
            ->update(['status' => 'ditugaskan']);
    }

    public function index()
    {
        return Penugasan_Model::with(['pengguna' => function ($query) {
            $query->select('pengguna_id', 'nama', 'foto_profil');
        }])->get();
    }
}
