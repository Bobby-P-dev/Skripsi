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
use App\Services\Penugasan\Teknisi\PenugasanTeknisi;
use App\Services\Penugasan\Teknisi\PenugasanTeknisiImpl;
use Doctrine\DBAL\Types\Type;
use Illuminate\Support\Facades\DB;
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
        if (class_exists(Type::class)) {
            try {
                if (!Type::hasType('enum')) {
                    Type::addType('enum', \Doctrine\DBAL\Types\StringType::class);
                }
                $platform = DB::connection()->getDoctrineSchemaManager()->getDatabasePlatform();
                if (!$platform->hasDoctrineTypeMappingFor('enum')) {
                    $platform->registerDoctrineTypeMapping('enum', 'string');
                }
            } catch (\Throwable $e) {
                // Abaikan error koneksi database saat startup agar aplikasi tidak crash.
                // Fungsionalitas enum akan berjalan saat koneksi normal.
            }
        }
    }
}
