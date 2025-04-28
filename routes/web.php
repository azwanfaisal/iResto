<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EvaluasiKinerjaController;
use App\Http\Controllers\JadwalKerjaController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users',UserController::class);
    Route::resource('karyawan', KaryawanController::class); 
    Route::resource('jadwalkerja', JadwalKerjaController::class); 
    Route::resource('absensi', AbsensiController::class); 
    Route::post('/absensi/checkin', [AbsensiController::class, 'checkin'])->name('absensi.checkin');
    Route::post('/absensi/checkout', [AbsensiController::class, 'checkout'])->name('absensi.checkout');
    Route::resource('penggajian', PenggajianController::class);
    Route::resource('laporans', LaporanController::class);
    Route::get('laporans/{laporan}/download', [LaporanController::class, 'download'])
    ->name('laporans.download');
    Route::resource('penggajians', PenggajianController::class);
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('evaluasi_kinerja', EvaluasiKinerjaController::class);
    


});

require __DIR__.'/auth.php';
