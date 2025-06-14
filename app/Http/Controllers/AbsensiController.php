<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // Tambahkan di atas controller

class AbsensiController extends Controller
{
    // Tampilkan daftar absensi
    public function index()
    {
        $absensis = Absensi::with('karyawan')->latest()->paginate(10);
        return view('absensi.index', compact('absensis'));
    }

    // Simpan data absensi manual (opsional dari admin)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_pulang' => 'nullable|date_format:H:i|after:jam_masuk',
            'status' => 'required|in:hadir,izin,sakit,cuti,alpa',
            'keterangan' => 'nullable|string|max:255',
        ]);

        Absensi::create($validated);
        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil ditambahkan!');
    }

  public function absenMasuk()
{
    $user = Auth::user();

    if (!$user->karyawan_id) {
        return redirect()->back()->with('error', 'Akun ini belum terhubung dengan data karyawan.');
    }

    $karyawan_id = $user->karyawan_id;
    $tanggal = Carbon::now()->toDateString();
    $jam_masuk = Carbon::now()->toTimeString();

    // Cegah absen masuk ganda
    $sudahAbsen = Absensi::where('karyawan_id', $karyawan_id)
        ->where('tanggal', $tanggal)
        ->exists();

    if ($sudahAbsen) {
        return redirect()->back()->with('warning', 'Anda sudah absen hari ini.');
    }

    Absensi::create([
        'karyawan_id' => $karyawan_id,
        'tanggal' => $tanggal,
        'jam_masuk' => $jam_masuk,
        'status' => 'hadir',
    ]);

    return redirect()->back()->with('success', 'Absen masuk berhasil.');
}
   public function absenPulang()
{
    $user = Auth::user();

    if (!$user->karyawan_id) {
        return redirect()->back()->with('error', 'Akun ini belum terhubung dengan data karyawan.');
    }

    $karyawanId = $user->karyawan_id;

    $absensi = Absensi::where('karyawan_id', $karyawanId)
        ->where('tanggal', now()->toDateString())
        ->first();

    if (!$absensi || !$absensi->jam_masuk) {
        return redirect()->back()->with('error', 'Anda belum absen masuk.');
    }

    if ($absensi->jam_pulang) {
        return redirect()->back()->with('warning', 'Anda sudah absen pulang hari ini.');
    }

    $absensi->update(['jam_pulang' => now()->format('H:i')]);

    return redirect()->back()->with('success', 'Absen pulang berhasil.');
}


  

public function rekapBulanan(Request $request)
{
    $bulan = $request->input('bulan', now()->format('Y-m'));
    $karyawan_id = $request->input('karyawan_id');

    $query = Absensi::with('karyawan')
        ->whereMonth('tanggal', Carbon::parse($bulan)->month)
        ->whereYear('tanggal', Carbon::parse($bulan)->year);

    if ($karyawan_id) {
        $query->where('karyawan_id', $karyawan_id);
    }

    $rekap = $query
        ->select('karyawan_id', 
                 DB::raw('COUNT(*) as total_hari'), 
                 DB::raw('SUM(status = "hadir") as hadir'),
                 DB::raw('SUM(status = "izin") as izin'),
                 DB::raw('SUM(status = "sakit") as sakit'),
                 DB::raw('SUM(status = "cuti") as cuti'),
                 DB::raw('SUM(status = "alpa") as alpa'))
        ->groupBy('karyawan_id')
        ->get();

    $karyawans = \App\Models\Karyawan::all();

    return view('absensi.rekap-bulanan', compact('rekap', 'bulan', 'karyawans', 'karyawan_id'));
}


public function exportRekapBulananPdf(Request $request)
{
    $bulan = $request->input('bulan') ?? now()->format('Y-m');
    $karyawan_id = $request->input('karyawan_id');

    $tanggalAwal = Carbon::parse($bulan . '-01')->startOfMonth();
    $tanggalAkhir = Carbon::parse($bulan . '-01')->endOfMonth();

    $absensis = Absensi::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
        ->when($karyawan_id, function ($query) use ($karyawan_id) {
            $query->where('karyawan_id', $karyawan_id);
        })
        ->get();

    $rekap = $absensis->groupBy('karyawan_id')->map(function ($items, $karyawan_id) {
        return [
            'karyawan' => $items->first()->karyawan,
            'hadir' => $items->where('status', 'hadir')->count(),
            'izin' => $items->where('status', 'izin')->count(),
            'sakit' => $items->where('status', 'sakit')->count(),
            'cuti' => $items->where('status', 'cuti')->count(),
            'alpa' => $items->where('status', 'alpa')->count(),
            'total_hari' => $items->count(),
        ];
    });

    $pdf = Pdf::loadView('absensi.rekap_pdf', [
        'rekap' => $rekap,
        'bulan' => $bulan,
    ]);

    return $pdf->download('rekap-absensi-bulanan.pdf');
}


   public function formPengajuan()
{
    return view('absensi.form-pengajuan');
}

public function pengajuanIzinCuti(Request $request)
{
    $validated = $request->validate([
        'tanggal' => 'required|date',
        'status' => 'required|in:izin,sakit,cuti',
        'keterangan' => 'nullable|string|max:255',
    ]);

    $validated['karyawan_id'] = Auth::user()->karyawan->id;

    Absensi::create($validated);

    return redirect()->route('absensi.index')->with('success', 'Pengajuan berhasil dikirim.');
}
public function showQrPage()
{
    $user = Auth::user();
    $karyawan = $user->karyawan; // pastikan relasi karyawan tersedia

    // QR code bisa berisi ID karyawan, atau custom string
    $qrData = 'absensi-' . $karyawan->id; 

    return view('absensi.qr', compact('karyawan', 'qrData'));
}

}
