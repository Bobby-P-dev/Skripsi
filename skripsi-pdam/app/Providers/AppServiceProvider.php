<?php

namespace App\Providers;

use App\Services\Dokumentasi\Admin\DokumentasiAdmin;
use App\Services\Dokumentasi\Admin\DokumentasiAdminImpl;
use App\Services\Dokumentasi\Teknisi\DokumentasiTeknisi;
use App\Services\Dokumentasi\Teknisi\DokumentasiTeknisiImpl;
use App\Services\Laporan\Admin\LaporanAdmin;
use App\Services\Laporan\Admin\LaporanAdminImpl;
use App\Services\Laporan\User\LaporanPengguna;
use App\Services\Laporan\User\LaporanPenggunaImpl;
use App\Services\Pengguna\Admin\PenggunaAdmin;
use App\Services\Pengguna\Admin\PenggunaAdminImpl;
use App\Services\Penugasan\Admin\PenugasanAdmin;
use App\Services\Penugasan\Admin\PenugasanAdminImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LaporanPengguna::class, LaporanPenggunaImpl::class);
        $this->app->bind(LaporanAdmin::class, LaporanAdminImpl::class);
        $this->app->bind(PenugasanAdmin::class, PenugasanAdminImpl::class);
        $this->app->bind(PenggunaAdmin::class, PenggunaAdminImpl::class);
        $this->app->bind(DokumentasiTeknisi::class, DokumentasiTeknisiImpl::class);
        $this->app->bind(DokumentasiAdmin::class, DokumentasiAdminImpl::class);
    }

    public function boot(): void
    {
        // Dikosongkan untuk stabilitas aplikasi
    }
}
