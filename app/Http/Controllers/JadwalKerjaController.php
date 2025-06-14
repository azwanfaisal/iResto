<?php

namespace App\Http\Controllers;

use App\Models\JadwalKerja;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PergantianJadwal;
use Illuminate\Support\Facades\Auth;


class JadwalKerjaController extends Controller
{
   public function index(Request $request)
{
    $query = JadwalKerja::query();

    // Jika user bukan admin, filter berdasarkan karyawan_id
    if (Auth::user()->roles !== 'admin') {
        $karyawanId = Auth::user()->karyawan_id;
        $query->where('karyawan_id', $karyawanId);
    }

    // Filter berdasarkan tanggal
    if ($request->has('tanggal')) {
        $query->where('tanggal', $request->tanggal);
    }

    // Filter berdasarkan shift
    if ($request->has('shift') && $request->shift !== '') {
        $query->where('shift', $request->shift);
    }

    $jadwalKerja = $query->paginate(10);

    return view('jadwalkerja.index', compact('jadwalKerja'));
}

    public function create()
    {
        $karyawans = Karyawan::all();
        return view('jadwalkerja.create', compact('karyawans'));
    }

  public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date',
        'shift' => 'required|in:pagi,siang,malam'
    ]);

    $karyawanId = Auth::user()->karyawan_id;
    $karyawan = Karyawan::findOrFail($karyawanId);

    JadwalKerja::create([
        'karyawan_id' => $karyawanId,
        'tanggal' => $request->tanggal,
        'shift' => $request->shift,
        'posisi' => $karyawan->jabatan,
        'status' => 'terjadwal'
    ]);

    return redirect()->route('jadwalkerja.index')->with('success', 'Jadwal berhasil dibuat!');
}

    public function edit(JadwalKerja $jadwalkerja)
    {
        $karyawans = Karyawan::all();
        return view('jadwalkerja.edit', compact('jadwalkerja', 'karyawans'));
    }

    public function update(Request $request, JadwalKerja $jadwalkerja)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'shift' => 'required|in:pagi,siang,malam'
        ]);

        // Ambil data karyawan untuk mendapatkan posisi
        $karyawan = Karyawan::findOrFail($request->karyawan_id);

        $jadwalkerja->update([
            'karyawan_id' => $request->karyawan_id,
            'tanggal' => $request->tanggal,
            'shift' => $request->shift,
            'posisi' => $karyawan->jabatan // Update posisi dari data karyawan
        ]);

        return redirect()->route('jadwalkerja.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy(JadwalKerja $jadwalkerja)
    {
        $jadwalkerja->delete();
        return redirect()->route('jadwalkerja.index')->with('success', 'Jadwal berhasil dihapus!');
    }
    public function createWeekly()
    {
        // Ambil semua karyawan
        $karyawans = Karyawan::all();

        // Ambil tanggal minggu ini (Senin - Minggu)
        $startOfWeek = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $dates = collect();

        for ($i = 0; $i < 7; $i++) {
            $dates->push($startOfWeek->copy()->addDays($i));
        }

        return view('jadwalkerja.create-weekly', compact('karyawans', 'dates'));
    }

   public function storeWeekly(Request $request)
{
    $jadwalData = $request->input('jadwal');

    foreach ($jadwalData as $karyawan_id => $tanggalData) {
        foreach ($tanggalData as $tanggal => $data) {
            if (!empty($data['shift'])) {
                JadwalKerja::create([
                    'karyawan_id' => $karyawan_id,
                    'tanggal' => $tanggal,
                    'shift' => $data['shift'],
                    'posisi' => $data['posisi'] ?? 'default', // posisi berasal dari jabatan karyawan
                ]);
            }
        }
    }

    return redirect()->route('jadwalkerja.index')->with('success', 'Jadwal mingguan berhasil disimpan.');
}
public function ajukanPergantian($id)
{
    $jadwal = JadwalKerja::findOrFail($id);
    $karyawans = Karyawan::where('id', '!=', $jadwal->karyawan_id)->get();

    return view('jadwalkerja.ajukan', compact('jadwal', 'karyawans'));
}
public function simpanPergantian(Request $request, $jadwalId)
{
    $request->validate([
        'pengganti_id' => 'required|exists:karyawans,id',
        'alasan' => 'required|string|max:1000',
    ]);

    PergantianJadwal::create([
        'jadwalkerja_id' => $jadwalId,
        'pengganti_id' => $request->pengganti_id,
        'alasan' => $request->alasan,
        'status' => 'diajukan',
    ]);

    return redirect()->route('jadwalkerja.index')->with('success', 'Pengajuan pergantian jadwal berhasil dikirim.');
}
// Menampilkan semua pengajuan untuk admin
public function pengajuanIndex()
{
    $pengajuans = PergantianJadwal::with(['jadwalKerja.karyawan', 'pengganti'])->latest()->get();
    return view('admin.pengajuan.index', compact('pengajuans'));
}

// Menerima atau menolak pengajuan
public function ubahStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:diterima,ditolak',
    ]);

    $pengajuan = PergantianJadwal::findOrFail($id);
    $pengajuan->status = $request->status;
    $pengajuan->save();

    // Jika pengajuan diterima, update juga status pada tabel jadwal_kerjas
    if ($request->status === 'diterima') {
        $jadwal = JadwalKerja::find($pengajuan->jadwalkerja_id);
        if ($jadwal) {
            $jadwal->status = 'diganti';
            $jadwal->save();
        }
    }

    return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
}


}
