<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PenggajianController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $query = Penggajian::with('karyawan');

    // Jika bukan admin, hanya tampilkan data miliknya saja
    if ($user->roles !== 'admin') {
        $query->where('karyawan_id', $user->karyawan_id);
    }

    $penggajians = $query->latest()->paginate(10);

    return view('penggajians.index', compact('penggajians'));
}

    public function create()
    {
        $karyawans = Karyawan::with('absensis')->get()->map(function ($karyawan) {
            $jumlah_hadir = $karyawan->absensis->where('status', 'hadir')->count();

            $gaji_pokok_jabatan = [
                'manager' => 5000000,
                'chef' => 3500000,
                'kasir' => 3000000,
                'pelayan' => 2500000,
            ];

            return [
                'id' => $karyawan->id,
                'nama_lengkap' => $karyawan->nama_lengkap,
                'jabatan' => $karyawan->jabatan,
                'gaji_pokok' => $gaji_pokok_jabatan[$karyawan->jabatan] ?? 2000000,
                'tunjangan_makan' => 20000 * $jumlah_hadir,
                'tunjangan_transport' => 15000 * $jumlah_hadir,
                'jumlah_hadir' => $jumlah_hadir,
            ];
        });

        return view('penggajians.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'gaji_pokok' => 'required|numeric',
            'tunjangan_transport' => 'nullable|numeric',
            'tunjangan_makan' => 'nullable|numeric',
            'tunjangan_lembur' => 'nullable|numeric',
            'potongan' => 'nullable|numeric',
            'tanggal_gajian' => 'required|date',
            'status' => 'required|in:diproses,dibayar',
        ]);

        $validated['potongan'] = $validated['potongan'] ?? 0;
        $validated['tunjangan_lembur'] = $validated['tunjangan_lembur'] ?? 0;

        $validated['total_gaji'] =
            $validated['gaji_pokok'] +
            $validated['tunjangan_transport'] +
            $validated['tunjangan_makan'] +
            $validated['tunjangan_lembur'] -
            $validated['potongan'];

        Penggajian::create($validated);

        return redirect()->route('penggajians.index')->with('success', 'Data gaji berhasil disimpan.');
    }

   public function getGajiData($id)
{
    $karyawan = Karyawan::with('absensis')->findOrFail($id);
    $jumlah_hadir = $karyawan->absensis->where('status', 'hadir')->count();

    // Hitung jumlah keterlambatan (jam_masuk > 08:00:00 misalnya)
    $jumlah_terlambat = $karyawan->absensis->filter(function ($absen) {
        return $absen->status === 'hadir' && $absen->jam_masuk > '08:00:00';
    })->count();

    // Hitung gaji pokok berdasarkan jabatan
    $gaji_pokok_per_jabatan = [
        'manager' => 5000000,
        'chef' => 3500000,
        'kasir' => 3000000,
        'pelayan' => 2500000,
    ];

    $gaji_pokok = $gaji_pokok_per_jabatan[$karyawan->jabatan] ?? 2000000;
    $tunjangan_transport = 15000 * $jumlah_hadir;
    $tunjangan_makan = 20000 * $jumlah_hadir;
    $tunjangan_lembur = 0;
    $potongan_keterlambatan = 50000 * $jumlah_terlambat;

    return response()->json([
        'gaji_pokok' => $gaji_pokok,
        'tunjangan_transport' => $tunjangan_transport,
        'tunjangan_makan' => $tunjangan_makan,
        'tunjangan_lembur' => $tunjangan_lembur,
        'potongan' => $potongan_keterlambatan,
    ]);
}


    public function show(Penggajian $penggajians)
    {
        return view('penggajians.slip', compact('penggajians'));
    }

   

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan_transport' => 'required|numeric|min:0',
            'tunjangan_makan' => 'required|numeric|min:0',
            'tunjangan_lembur' => 'required|numeric|min:0',
            'potongan' => 'required|numeric|min:0',
            'tanggal_gajian' => 'required|date',
        ]);

        $validated['total_gaji'] =
            $validated['gaji_pokok'] +
            $validated['tunjangan_transport'] +
            $validated['tunjangan_makan'] +
            $validated['tunjangan_lembur'] -
            $validated['potongan'];

        Penggajian::findOrFail($id)->update($validated);

        return redirect()->route('penggajians.index')->with('success', 'Data penggajian berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $penggajian = Penggajian::findOrFail($id);
        $penggajian->delete();

        return redirect()->route('penggajians.index')->with('success', 'Data penggajian berhasil dihapus.');
    }
    public function slip($id)
{
    $penggajian = Penggajian::with('karyawan')->findOrFail($id);
    return view('penggajians.slip', compact('penggajian'));
}
public function slipPdf($id)
{
    $penggajian = Penggajian::with('karyawan')->findOrFail($id);

    $pdf = Pdf::loadView('penggajians.slip_pdf', compact('penggajian'));
    return $pdf->stream('slip-gaji-'.$penggajian->karyawan->nama_lengkap.'.pdf');
}
public function bayar($id)
{
    $gaji = Penggajian::findOrFail($id);
    $gaji->status = 'Dibayar';
    $gaji->tanggal_bayar = now();
    $gaji->save();

    return redirect()->back()->with('success', 'Gaji berhasil dibayarkan.');
}

}
