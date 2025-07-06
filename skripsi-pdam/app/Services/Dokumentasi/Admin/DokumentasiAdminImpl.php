<?php

namespace App\Services\Dokumentasi\Admin;

use App\Models\Dokumentasi_Model;

class DokumentasiAdminImpl implements DokumentasiAdmin
{
    public function GetDokumentasiIndex()
    {
        return Dokumentasi_Model::with([
            'laporan.pelanggan',
            'teknisi'
        ])
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
