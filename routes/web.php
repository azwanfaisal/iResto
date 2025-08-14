<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AbsensiController,
    DashboardController,
    EvaluasiKinerjaController,
    JadwalKerjaController,
    KaryawanController,
    LaporanController,
    PenggajianController,
    ProfileController,
    UserController
};
use App\Exports\RekapAbsensiExport;
use Maatwebsite\Excel\Facades\Excel;

// Halaman awal
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (gunakan controller)
Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Export Absensi Excel (tanpa middleware karena hanya file download)
Route::get('/absensi/rekap/excel', function () {
    $bulan = request('bulan') ?? date('Y-m');
    $karyawan_id = request('karyawan_id') ?? null;
    return Excel::download(new RekapAbsensiExport($bulan, $karyawan_id), 'rekap-absensi.xlsx');
})->name('absensi.rekapBulananExcel');

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes
    Route::resource('users', UserController::class);
    Route::resource('karyawan', KaryawanController::class);

    Route::resource('absensi', AbsensiController::class)->except(['show']);
    Route::resource('penggajian', PenggajianController::class);
    Route::resource('laporans', LaporanController::class);
    Route::resource('evaluasi_kinerja', EvaluasiKinerjaController::class);

    // Jadwal kerja tambahan
   Route::middleware('auth')->group(function () {
    Route::resource('jadwalkerja', JadwalKerjaController::class)->except(['show']);
});


    Route::get('/jadwalkerja/create-weekly', [JadwalKerjaController::class, 'createWeekly'])->name('jadwalkerja.create-weekly');
    Route::post('/jadwalkerja/store-weekly', [JadwalKerjaController::class, 'storeWeekly'])->name('jadwalkerja.storeWeekly');
    Route::get('/jadwal-kerja/{id}/ajukan-pergantian', [JadwalKerjaController::class, 'ajukanPergantian'])->name('jadwalkerja.ajukan-pergantian');
    Route::post('/jadwal-kerja/{id}/ajukan-pergantian', [JadwalKerjaController::class, 'simpanPergantian'])->name('jadwalkerja.simpan-pergantian');
    Route::get('/pengajuan-pergantian', [JadwalKerjaController::class, 'pengajuanIndex'])->name('pengajuan.index');
    Route::post('/pengajuan-pergantian/{id}/status', [JadwalKerjaController::class, 'ubahStatus'])->name('pengajuan.ubah-status');

    // Absensi
    Route::post('/absensi/checkin', [AbsensiController::class, 'checkin'])->name('absensi.checkin');
    Route::post('/absensi/checkout', [AbsensiController::class, 'checkout'])->name('absensi.checkout');
    Route::post('/absensi/masuk', [AbsensiController::class, 'absenMasuk'])->name('absensi.masuk');
    Route::post('/absen/pulang', [AbsensiController::class, 'absenPulang'])->name('absensi.pulang');

    Route::get('/absensi/rekap-bulanan', [AbsensiController::class, 'rekapBulanan'])->name('absensi.rekapBulanan');
    Route::get('/absensi/rekap-bulanan/pdf', [AbsensiController::class, 'exportRekapBulananPdf'])->name('absensi.rekapBulananPdf');

    Route::get('/absensi/pengajuan', [AbsensiController::class, 'formPengajuan'])->name('absensi.formPengajuan');
    Route::post('/absensi/pengajuan', [AbsensiController::class, 'pengajuanIzinCuti'])->name('absensi.pengajuanIzinCuti');

    Route::get('/absensi/qr', [AbsensiController::class, 'showQrPage'])->name('absensi.qr');
    Route::resource('penggajians', PenggajianController::class);
    

    // Penggajian tambahan
    Route::prefix('penggajians')->controller(PenggajianController::class)->group(function () {
        Route::get('get-gaji-data/{id}', 'getGajiData');
        Route::get('{id}/slip', 'slip')->name('penggajians.slip');
        Route::get('{id}/slip/pdf', 'slipPdf')->name('penggajians.slip.pdf');
        Route::put('{id}/bayar', 'bayar')->name('penggajians.bayar');
    });

    // Laporan tambahan
    Route::prefix('laporans')->controller(LaporanController::class)->group(function () {
        Route::get('export/excel', 'exportExcel')->name('laporans.export.excel');
        Route::get('export/pdf', 'exportPdf')->name('laporans.export.pdf');
        Route::get('{laporan}', 'show')->name('laporans.show');
        Route::delete('{laporan}', 'destroy')->name('laporans.destroy');
    });

    // Karyawan show detail
    Route::get('/karyawan/{karyawan}', [KaryawanController::class, 'show'])->name('karyawan.show');
});

// Auth routes
require __DIR__ . '/auth.php';
