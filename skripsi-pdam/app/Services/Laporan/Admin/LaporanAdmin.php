<?php

namespace App\Services\Laporan\Admin;

use App\Models\Laporan_Model;

interface LaporanAdmin
{
    public function clusterLaporanPending(float $epsilon, int $minSamples): array;
    public function laporanNotPending(): array;
    public function accLaporan(Laporan_Model $laporan);

    public function tolakLaporan(Laporan_Model $laporan);
}
