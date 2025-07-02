<?php

use App\Http\Controllers\Admin\DokumentasiAdminController;
use App\Http\Controllers\Admin\LaporanAdminController;
use App\Http\Controllers\Admin\LaporanTestController;
use App\Http\Controllers\Admin\PenugasanAdminController;
use App\Http\Controllers\Pelanggan\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PenggunaAdminController;
use App\Http\Controllers\Teknisi\DokumentasiTeknisiController;
use App\Http\Controllers\Teknisi\PenugasanTeknisiController;
use App\Services\Penugasan\Admin\PenugasanAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//penguna
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
Route::post('/laporan', [LaporanController::class, 'store'])->name('laporan.store')->middleware('auth');
Route::get('/laporan/edit/{laporan_uuid}', [LaporanController::class, 'edit'])->name('laporan.edit');
Route::put('/laporan/update/{laporan_uuid}', [LaporanController::class, 'update'])->name('laporan.update');

//---
Route::Get('/laporan/show/update{id}', [LaporanController::class, 'showUpdate'])->name('laporan.showUpdate');
Route::put('/laporan/update/{id}', [LaporanController::class, 'update'])->name('laporan.update');
Route::get('/laporan/show/delete/{id}', [LaporanController::class, 'showDelete'])->name('laporan.delete');
Route::delete('/laporan/delete/{id}', [LaporanController::class, 'delete'])->name('laporan.delete');

//teknisi
Route::post('dokumentasi/store', [DokumentasiTeknisiController::class, 'store'])->name('dokumentasi.create');
Route::get('/penugasan/get', [PenugasanTeknisiController::class, 'getIndex'])->name('penugasant.index');

//admin
Route::prefix('admin')->middleware(['role.admin'])->group(function () {
    //pengguna
    Route::get('/data/pengguna', [PenggunaAdminController::class, 'index'])->name('data.admin');
    Route::put('/data/pengguna/{user_id}/update', [PenggunaAdminController::class, 'EditStore'])->name('data.update');
    Route::delete('/data/pengguna/{user_id}/delete', [PenggunaAdminController::class, 'Delet'])->name('data.delete');

    //laporan
    Route::get('/laporan/pengaduan', [LaporanAdminController::class, 'indexKlusterLaporanPending'])->name('laporan.admin');
    Route::get('/laporan/index', [LaporanAdminController::class, 'index'])->name('alllaporan.index');
    Route::get('/laporan/realtime', [LaporanController::class, 'realtime'])->name('laporan.realtime');
    Route::put('/laporan/{laporan}/tolak', [LaporanAdminController::class, 'tolakLaporan'])->name('laporan.tolak');
    Route::put('/laporan/{laporan}/konfirmasi', [LaporanAdminController::class, 'accLaporan'])->name('laporan.konfirmasi');
    Route::get('/teknisi', [PenggunaAdminController::class, 'teknisiGetOption'])->name('teknisi.option');
    Route::get('/laporan/export', [LaporanAdminController::class, 'export'])->name('laporan.export');

    //penugasan
    Route::get('/laporan/penugasan', [PenugasanAdmin::class, 'create'])->name('penugasan.show');
    Route::get('/penugasan/index', [PenugasanAdminController::class, 'index'])->name('penugasan.index');
    Route::post('/laporan/penugasan/create', [PenugasanAdminController::class, 'store'])->name('penugasan.store');

    //dokumentasi
    Route::get('/dokumentasi', [DokumentasiAdminController::class, 'index'])->name('dokumentasi.index');
});

// Route::get('/laporan/home/admin', [LaporanAdminController::class, 'index'])->name('laporan.admin');
// Route::get('/laporan/validate/admin', [LaporanAdminController::class, 'accLaporan'])->name('laporan.show');
// Route::post('/laporan/validate/admin', [LaporanAdminController::class, 'accLaporan'])->name('laporan.acc');

//dll
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('components.laporan');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
