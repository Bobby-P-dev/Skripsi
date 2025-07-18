<?php

namespace App\Services\Laporan\Admin;

use App\Models\Laporan_Model;
use App\Models\Pengguna_Model;
use Phpml\Clustering\DBSCAN;
use Rubix\ML\Datasets\Unlabeled;

class LaporanAdminImpl implements LaporanAdmin
{
    public function clusterLaporanPending(float $epsilon, int $minSamples): array
    {
        // --- BAGIAN 1: PERSIAPAN - HAMPIR TIDAK ADA PERUBAHAN ---


        $laporanAktif = Laporan_Model::with(['pelanggan' => function ($query) {
            $query->select('pengguna_id', 'nama', 'foto_profil');
        }])
            ->whereIn('status', ['pending', 'diterima'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();


        if ($laporanAktif->count() < $minSamples) {
            // Logika guard clause Anda sudah benar, tidak perlu diubah
            return ['clusters' => [], 'noise' => $laporanAktif->all()];
        }


        // Persiapan $samples tetap sama
        $samples = [];
        foreach ($laporanAktif as $laporan) {
            $samples[] = [(float) $laporan->latitude, (float) $laporan->longitude];
        }


        // Perubahan 1: RubixML butuh data dalam format objek Dataset
        $dataset = Unlabeled::build($samples);


        // --- BAGIAN 2: EKSEKUSI ALGORITMA - DIGANTI DENGAN SINTAKS RUBIXML ---


        // Ganti 'new DBSCAN(...)->cluster($samples)'
        // menjadi 'new DBSCAN(...)->predict($dataset)'
        $estimator = new \Rubix\ML\Clusterers\DBSCAN($epsilon, $minSamples);
        $labels = $estimator->predict($dataset);


        // --- BAGIAN 3: PROSES HASIL - DIPERBARUI TOTAL SESUAI OUTPUT RUBIXML ---


        $clusters = [];
        $noise = [];


        // Looping berdasarkan label yang dihasilkan oleh RubixML
        foreach ($labels as $index => $label) {
            // Ambil objek Laporan_Model yang sesuai dengan index-nya
            $laporan = $laporanAktif[$index];


            if ($label === -1) {
                // Label -1 adalah noise (data pencilan)
                $noise[] = $laporan;
            } else {
                // Kelompokkan laporan ke dalam cluster berdasarkan nomor labelnya
                $clusters[$label][] = $laporan;
            }
        }


        return [
            // array_values digunakan untuk mereset key (0, 1, 2...) menjadi array biasa
            'clusters' => array_values($clusters),
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
