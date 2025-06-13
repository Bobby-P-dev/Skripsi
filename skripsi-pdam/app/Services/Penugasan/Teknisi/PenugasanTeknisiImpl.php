<?php

namespace App\Services\Penugasan\Teknisi;

use App\Models\Pengguna_Model;
use App\Models\Penugasan_Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class PenugasanTeknisiImpl implements PenugasanTeknisi
{
    public function GetIndex(int $teknisi_id)
    {
        $teknisi = Pengguna_Model::findOrFail($teknisi_id);

        try {
            return Penugasan_Model::where('teknisi_id', $teknisi->pengguna_id)->with('laporan', 'admin')->get();
        } catch (QueryException $e) {
            Log::error("Database Error di PenugasanService: " . $e->getMessage());
            Log::error("SQL Query: " . $e->getSql());

            throw new \Exception("Terjadi masalah saat mengambil data dari database.");
        }
    }
}
