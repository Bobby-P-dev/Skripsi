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
    /**
     * Register any application services.
     */


    public function register(): void
    {
        $this->app->bind(
            LaporanPengguna::class,
            LaporanPenggunaImpl::class,

        );
        $this->app->bind(
            LaporanAdmin::class,
            LaporanAdminImpl::class,

        );

        $this->app->bind(
            PenugasanAdmin::class,
            PenugasanAdminImpl::class,
        );

        $this->app->bind(
            PenggunaAdmin::class,
            PenggunaAdminImpl::class,
        );

        $this->app->bind(
            DokumentasiTeknisi::class,
            DokumentasiTeknisiImpl::class,
        );

        $this->app->bind(
            DokumentasiAdmin::class,
            DokumentasiAdminImpl::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Periksa apakah kelas Type ada untuk menghindari error jika doctrine/dbal tidak terinstall
        // (meskipun untuk ->change() seharusnya sudah terinstall)
        if (class_exists(Type::class)) {
            try {
                // Cek apakah tipe 'enum' sudah terdaftar
                if (!Type::hasType('enum')) {
                    Type::addType('enum', \Doctrine\DBAL\Types\StringType::class);
                }

                // Dapatkan platform database yang sedang digunakan
                // $platform = DB::connection()->getDoctrineConnection()->getDatabasePlatform(); // Untuk Laravel versi < 9
                $platform = DB::connection()->getDoctrineSchemaManager()->getDatabasePlatform(); // Untuk Laravel 9+

                // Daftarkan pemetaan tipe 'enum' ke 'string' jika belum ada
                // Ini memberitahu Doctrine untuk memperlakukan kolom 'enum' sebagai 'string'
                if (!$platform->hasDoctrineTypeMappingFor('enum')) {
                    $platform->registerDoctrineTypeMapping('enum', 'string');
                }
            } catch (\Doctrine\DBAL\Exception $e) {
                // Tangani exception jika terjadi masalah saat mendaftarkan tipe
                // Misalnya, log error atau abaikan jika tidak kritis untuk semua environment
                // report($e); // Uncomment untuk melaporkan error jika perlu
            }
        }
    }
}
