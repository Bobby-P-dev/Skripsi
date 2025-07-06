<?php

namespace App\Services\Dokumentasi\Teknisi;

use App\Models\Dokumentasi_Model;
use App\Models\Laporan_Model;
use App\Models\Penugasan_Model;
use DB;
use Illuminate\Support\Facades\Auth;

class DokumentasiTeknisiImpl implements DokumentasiTeknisi
{
    public function GetPenugasanIndex()
    {
        $teknisiOn = Auth::id();
        $penugasan = Penugasan_Model::where('teknisi_id', $teknisiOn)
            ->with('laporan')
            ->orderBy('created_at', 'desc')
            ->get();

        return $penugasan;
    }

    public function GetDokumentasiIndex(int $teknisi_id)
    {
        return Dokumentasi_Model::where('teknisi_id', $teknisi_id)
            ->with('laporan.pelanggan')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function CreateDokumentasi(array $data)
    {
        return DB::transaction(function () use ($data) {
            $dokumentasi = Dokumentasi_Model::create($data);
            $laporan = Laporan_Model::where('laporan_uuid', $dokumentasi->laporan_uuid)->firstOrFail();
            $laporan->update(['status_laporan' => 'selesai']);
            return $dokumentasi;
        });
    }

    public function EditDokumentasi(array $data, int $dokumentasi_id)
    {
        $dokumentasi = Dokumentasi_Model::where('dokumentasi_id', $dokumentasi_id)->first();
        if ($dokumentasi) {
            $dokumentasi->update($data);
            return $dokumentasi->fresh();
        }
    }
}
