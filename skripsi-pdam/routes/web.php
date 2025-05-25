<?php


use App\Http\Controllers\Admin\LaporanAdminController;
use App\Http\Controllers\Pelanggan\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PenggunaAdminController;
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
Route::get('/laporan', [LaporanController::class, 'getLaporan'])->name('laporan.index');
Route::get('/laporan/home', [LaporanController::class, 'index'])->name('laporan.home');
Route::get('/laporan/create', [LaporanController::class, 'create'])->name('laporan.create');
Route::post('/laporan', [LaporanController::class, 'store'])
    ->name('laporan.store')
    ->middleware('auth');


Route::Get('/laporan/show/update{id}', [LaporanController::class, 'showUpdate'])->name('laporan.showUpdate');
Route::put('/laporan/update/{id}', [LaporanController::class, 'update'])->name('laporan.update');
Route::get('/laporan/show/delete/{id}', [LaporanController::class, 'showDelete'])->name('laporan.delete');
Route::delete('/laporan/delete/{id}', [LaporanController::class, 'delete'])->name('laporan.delete');



//admin
Route::prefix('admin')->middleware(['role.admin'])->group(function () {
    Route::get('/data/pengguna', [PenggunaAdminController::class, 'index'])->name('data.admin');
    Route::get('/laporan/home/admin', [LaporanAdminController::class, 'index'])->name('laporan.admin');
    Route::get('/laporan/realtime', [LaporanController::class, 'realtime'])->name('laporan.realtime');
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
