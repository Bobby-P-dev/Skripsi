<?php

namespace App\Services\Penugasan\Admin;

use App\Models\Laporan_Model;
use App\Models\Pengguna_Model;
use App\Models\Penugasan_Model;
use Illuminate\Support\Facades\Log;

class PenugasanAdminImpl implements PenugasanAdmin
{

    public function create(string $laporan_uuid)
    {
        $user = Pengguna_Model::where('role', 'teknisi')->select('pengguna_id', 'nama')
            ->orderBy('nama', 'asc')
            ->get();

        if ($user->isEmpty()) {
            throw new \Exception('Teknisi tidak ditemukan');
        }
        try {
            $laporan = Laporan_Model::where('laporan_uuid', $laporan_uuid)->firstOrFail();
        } catch (\Exception $e) {
            throw new \Exception("Laporan dengan UUID '{$laporan_uuid}' tidak ditemukan.");
        }
        return [
            'user' => $user,
            'laporan' => $laporan,
        ];
    }


    public function store(array $data)
    {
        try {
            Log::info('Memanggil Penugasan_Model::create', $data);
            $penugasan = Penugasan_Model::create($data);

            if ($penugasan) {
                Laporan_Model::where('laporan_uuid', $data['laporan_uuid'])
                    ->update(['status' => 'ditugaskan']);
            }

            return $penugasan;
        } catch (\Exception $e) {
            Log::error('PenugasanAdminService@store: Terjadi kesalahan saat menyimpan penugasan:', [
                'error' => $e->getMessage(),
                'data' => $data,
            ]);
            throw $e;
        }
    }

    public function index()
    {
        $penugasans = Penugasan_Model::with([
            'teknisi' => function ($query) {
                $query->select('pengguna_id', 'nama');
            },
            'laporan' => function ($query) {
                $query->select('laporan_uuid', 'judul');
            }
        ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $penugasans;
    }
}
