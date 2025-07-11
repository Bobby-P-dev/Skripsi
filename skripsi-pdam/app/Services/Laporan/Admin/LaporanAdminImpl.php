<?php

namespace App\Services\Laporan\Admin;

use App\Models\Laporan_Model;
use App\Models\Pengguna_Model;
use Phpml\Clustering\DBSCAN;

class LaporanAdminImpl implements LaporanAdmin
{
    public function clusterLaporanPending(float $epsilon, int $minSamples): array
    {
        // --- BAGIAN 1: PERSIAPAN - AMBIL DATA DAN BUAT 'PETA' ---

        $laporanAktif = Laporan_Model::with(['pelanggan' => function ($query) {
            $query->select('pengguna_id', 'nama', 'foto_profil');
        }])
            ->whereIn('status', ['pending', 'diterima'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        if ($laporanAktif->count() < $minSamples) {
            return ['clusters' => [], 'noise' => $laporanAktif->all()];
        }

        $samples = [];
        $laporanMap = [];
        foreach ($laporanAktif as $laporan) {
            $koordinat = [(float) $laporan->latitude, (float) $laporan->longitude];
            $key = $laporan->latitude . ',' . $laporan->longitude;

            // Algoritma perlu tahu ada 4 titik di lokasi yang sama untuk menghitung kepadatan.
            $samples[] = $koordinat;

            // Logika untuk $laporanMap tetap sama untuk menangani duplikat
            $laporanMap[$key][] = $laporan;
        }

        // --- BAGIAN 2: EKSEKUSI ALGORITMA ---
        $dbscan = new DBSCAN($epsilon, $minSamples);
        $hasilClusterKoordinat = $dbscan->cluster($samples);

        // --- BAGIAN 3: PROSES HASIL
        $laporanPerCluster = [];

        foreach ($hasilClusterKoordinat as $clusterKoordinat) {
            $laporanDiClusterIni = [];
            // mengambil kunci unik dari koordinat cluster untuk peta kita
            $uniqueKeysInCluster = [];
            foreach ($clusterKoordinat as $koordinat) {
                $uniqueKeysInCluster[$koordinat[0] . ',' . $koordinat[1]] = true;
            }

            foreach (array_keys($uniqueKeysInCluster) as $key) {
                if (isset($laporanMap[$key])) {
                    $laporanDiClusterIni = array_merge($laporanDiClusterIni, $laporanMap[$key]);
                    unset($laporanMap[$key]);
                }
            }
            $laporanPerCluster[] = $laporanDiClusterIni;
        }

        $noise = [];
        foreach ($laporanMap as $grupLaporanNoise) {
            $noise = array_merge($noise, $grupLaporanNoise);
        }

        return [
            'clusters' => $laporanPerCluster,
            'noise' => $noise,
        ];
    }

    public function laporanNotPending(): array
    {
        $data = Laporan_Model::with(['pelanggan' => function ($query) {
            $query->select('pengguna_id', 'nama', 'foto_profil');
        }])->whereNotIn('status', ['pending', 'diterima'])->orderBy('updated_at', 'desc')->paginate(6);

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

    public function tolakLaporan(Laporan_Model $laporan)
    {
        $laporan->update([
            'admin_id' => auth()->id(),
            'status'   => 'ditolak',
        ]);
    }

    public function GetcountLaporan()
    {
        return Laporan_Model::count();
    }
}
