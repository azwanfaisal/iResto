<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Absensi;
use App\Models\Penggajian;
use Carbon\Carbon;
use App\Models\Laporan;
use App\Exports\LaporansExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
   public function index(Request $request)
{
    $query = Laporan::query();

    // Filter berdasarkan tanggal jika tersedia
    if ($request->filled('from') && $request->filled('to')) {
        $query->whereBetween('periode_awal', [$request->from, $request->to]);
    }

    $laporans = $query->orderBy('periode_awal', 'desc')->get();

    return view('laporans.index', compact('laporans'));
}


public function store(Request $request)
{
    $request->validate([
        'periode_awal' => 'required|date',
        'periode_akhir' => 'required|date|after_or_equal:periode_awal',
    ]);

    // Hitung data berdasarkan periode
    $totalKaryawan = \App\Models\Karyawan::count();

    $totalAbsensi = \App\Models\Absensi::whereBetween('tanggal', [
        $request->periode_awal,
        $request->periode_akhir
    ])->count();

    $totalPenggajian = \App\Models\Penggajian::whereBetween('tanggal_gajian', [
        $request->periode_awal,
        $request->periode_akhir
    ])->sum('total_gaji');

    // Simpan ke database
    \App\Models\Laporan::create([
        'periode_awal' => $request->periode_awal,
        'periode_akhir' => $request->periode_akhir,
        'total_karyawan' => $totalKaryawan,
        'total_absensi' => $totalAbsensi,
        'total_penggajian' => $totalPenggajian,
    ]);

    return redirect()->route('laporans.index')->with('success', 'Laporan berhasil disimpan.');
}




    public function simpanLaporan(Request $request)
{
    $awal = Carbon::parse($request->periode_awal);
    $akhir = Carbon::parse($request->periode_akhir);

    $laporan = new Laporan();
    $laporan->periode_awal = $awal;
    $laporan->periode_akhir = $akhir;
    $laporan->total_karyawan = Karyawan::count();
    $laporan->total_absensi = Absensi::whereBetween('tanggal', [$awal, $akhir])->count();
    $laporan->total_penggajian = Penggajian::whereBetween('tanggal_gajian', [$awal, $akhir])->sum('total_gaji');
    $laporan->save();

    return redirect()->route('laporans.index')->with('success', 'Laporan berhasil disimpan.');
}
public function exportExcel()
{
    return Excel::download(new LaporansExport, 'laporan.xlsx');
}

public function exportPdf()
{
    $laporans = \App\Models\Laporan::all();
    $pdf = PDF::loadView('laporans.export_pdf', compact('laporans'));
    return $pdf->download('laporan.pdf');
}
public function show($id)
{
    $laporan = Laporan::findOrFail($id);

    return view('laporans.show', compact('laporan'));
}
public function destroy(Laporan $laporan)
{
    $laporan->delete();

    return redirect()->route('laporans.index')
        ->with('success', 'Laporan berhasil dihapus.');
}


}
