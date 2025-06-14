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
use App\Http\Controllers\PengajuanController;
use Illuminate\Support\Facades\Route;
use App\Exports\RekapAbsensiExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/absensi/rekap/excel', function () {
    $bulan = request('bulan') ?? date('Y-m');
    $karyawan_id = request('karyawan_id') ?? null;

    return Excel::download(new RekapAbsensiExport($bulan, $karyawan_id), 'rekap-absensi.xlsx');
})->name('absensi.rekapBulananExcel');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', UserController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('jadwalkerja', JadwalKerjaController::class)->except(['show']);
    Route::resource('jadwalkerja', JadwalKerjaController::class)->middleware('auth');

    Route::resource('absensi', AbsensiController::class)->except(['show']);

    Route::post('/absensi/checkin', [AbsensiController::class, 'checkin'])->name('absensi.checkin');
    Route::post('/absensi/checkout', [AbsensiController::class, 'checkout'])->name('absensi.checkout');
    Route::resource('penggajian', PenggajianController::class);
Route::resource('laporans', LaporanController::class);
    Route::resource('penggajians', PenggajianController::class);
 Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::resource('evaluasi_kinerja', EvaluasiKinerjaController::class);
    Route::get('/karyawan/{karyawan}', [KaryawanController::class, 'show'])->name('karyawan.show');
    Route::prefix('jadwal')->group(function () {
        Route::post('/', [JadwalKerjaController::class, 'create']);
        Route::post('/change/{id}', [JadwalKerjaController::class, 'requestChange']);
        Route::get('/calendar', [JadwalKerjaController::class, 'calendar']);
    });
    // Tambahkan rute baru
    Route::get('/jadwalkerja/create-weekly', [JadwalKerjaController::class, 'createWeekly'])->name('jadwalkerja.create-weekly');
    Route::post('/jadwalkerja/store-weekly', [JadwalKerjaController::class, 'storeWeekly'])->name('jadwalkerja.storeWeekly');
    Route::get('/jadwal-kerja/{id}/ajukan-pergantian', [JadwalKerjaController::class, 'ajukanPergantian'])
        ->name('jadwalkerja.ajukan-pergantian');
    Route::post('/jadwal-kerja/{id}/ajukan-pergantian', [JadwalKerjaController::class, 'simpanPergantian'])
        ->name('jadwalkerja.simpan-pergantian');
    // Untuk admin melihat & memproses pengajuan
    Route::get('/pengajuan-pergantian', [JadwalKerjaController::class, 'pengajuanIndex'])->name('pengajuan.index');
    Route::post('/pengajuan-pergantian/{id}/status', [JadwalKerjaController::class, 'ubahStatus'])->name('pengajuan.ubah-status');
    Route::post('/absensi/masuk', [AbsensiController::class, 'absenMasuk'])->name('absensi.masuk');
    Route::post('/absen/pulang', [AbsensiController::class, 'absenPulang'])->name('absensi.pulang');
    Route::get('/absensi/rekap-bulanan', [AbsensiController::class, 'rekapBulanan'])->name('absensi.rekapBulanan');
    Route::get('/absensi/rekap-bulanan/pdf', [AbsensiController::class, 'exportRekapBulananPdf'])->name('absensi.rekapBulananPdf');
    Route::get('/absensi/form-pengajuan', [AbsensiController::class, 'formPengajuan'])->name('absensi.formPengajuan');
    Route::get('/absensi/pengajuan', [AbsensiController::class, 'formPengajuan'])->name('absensi.formPengajuan');
    Route::post('/absensi/pengajuan', [AbsensiController::class, 'pengajuanIzinCuti'])->name('absensi.pengajuanIzinCuti');

Route::get('/absensi/qr', [AbsensiController::class, 'showQrPage'])->name('absensi.qr');
    Route::get('/penggajians/get-gaji-data/{karyawan}', [PenggajianController::class, 'getGajiData']);
    Route::get('/penggajians/get-gaji-data/{id}', [App\Http\Controllers\PenggajianController::class, 'getGajiData']);
    Route::get('/penggajians/{id}/slip', [PenggajianController::class, 'slip'])->name('penggajians.slip');
    Route::get('/penggajians/{id}/slip/pdf', [PenggajianController::class, 'slipPdf'])->name('penggajians.slip.pdf');
    Route::put('/penggajians/{id}/bayar', [PenggajianController::class, 'bayar'])->name('penggajians.bayar');;
Route::resource('laporans', \App\Http\Controllers\LaporanController::class);
Route::get('/laporans/export/excel', [App\Http\Controllers\LaporanController::class, 'exportExcel'])->name('laporans.export.excel');
Route::get('/laporans/export/pdf', [App\Http\Controllers\LaporanController::class, 'exportPdf'])->name('laporans.export.pdf');
Route::get('/laporans/{laporan}', [\App\Http\Controllers\LaporanController::class, 'show'])->name('laporans.show');
Route::delete('/laporans/{laporan}', [LaporanController::class, 'destroy'])->name('laporans.destroy');



});

require __DIR__ . '/auth.php';
