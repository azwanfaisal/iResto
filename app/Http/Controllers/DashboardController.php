<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Penggajian;
use App\Models\Absensi;
use App\Models\Laporan;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        // Hitung total data
        $totalKaryawan = Karyawan::count();
        $totalPenggajian = Penggajian::count();
        $totalAbsensi = Absensi::count();
        $totalLaporan = Laporan::count();

        // Ambil 5 data penggajian terbaru
        $recentPenggajian = Penggajian::with('karyawan')->latest()->take(5)->get();

        // Data untuk grafik
        $penggajianLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
        $penggajianData = [5000, 7000, 6000, 8000, 9000, 10000];

        $absensiLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
        $absensiData = [30, 40, 35, 50, 45, 60];

        // Kirim data ke view dashboard
        return view('dashboard', compact(
            'totalKaryawan',
            'totalPenggajian',
            'totalAbsensi',
            'totalLaporan',
            'recentPenggajian',
            'penggajianLabels',
            'penggajianData',
            'absensiLabels',
            'absensiData'
        ));
    }
}