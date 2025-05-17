<?php

use App\Http\Controllers\admin\LaporanAdminController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
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
// Route::get('/laporan', [LaporanController::class, 'create'])->name('laporan.index');
Route::post('/laporan', [LaporanController::class, 'store'])
    ->name('laporan.store')
    ->middleware('auth');


Route::Get('/laporan/show/update{id}', [LaporanController::class, 'showUpdate'])->name('laporan.showUpdate');
Route::put('/laporan/update/{id}', [LaporanController::class, 'update'])->name('laporan.update');
Route::get('/laporan/show/delete/{id}', [LaporanController::class, 'showDelete'])->name('laporan.delete');
Route::delete('/laporan/delete/{id}', [LaporanController::class, 'delete'])->name('laporan.delete');



//admin
Route::get('/laporan/home/admin', [LaporanAdminController::class, 'index'])->name('laporan.admin');
Route::get('/laporan/validate/admin', [LaporanAdminController::class, 'accLaporan'])->name('laporan.show');
Route::post('/laporan/validate/admin', [LaporanAdminController::class, 'accLaporan'])->name('laporan.acc');

//dll
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('layouts.home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
