<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalKerja;
use App\Models\Karyawan;

class JadwalKerjaController extends Controller
{
    /**
     * Tampilkan daftar jadwal kerja.
     */
    public function index()
    {
        $jadwalKerja = JadwalKerja::with('karyawan')->paginate(10);
        return view('jadwalkerja.index', compact('jadwalKerja')); // ✅ Perbaiki variabel
    }

    /**
     * Tampilkan form tambah jadwal kerja.
     */
    public function create()
    {
        $karyawans = Karyawan::all();
        return view('jadwalkerja.create', compact('karyawans'));
    }

    /**
     * Simpan data jadwal kerja baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'shift' => 'required|in:pagi,siang,malam',
            'posisi' => 'required|string|max:100',
            'status' => 'required|in:terjadwal,diganti,dikonfirmasi',
        ]);
    
        try {
            JadwalKerja::create($request->all());
    
            return redirect()->route('jadwalkerja.index')->with('success', 'Jadwal kerja berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan jadwal kerja: ' . $e->getMessage());
        }
    }
    


    /**
     * Tampilkan form edit jadwal kerja.
     */
    public function edit(JadwalKerja $jadwalKerja)
    {
        $karyawans = Karyawan::all();
        return view('jadwalkerja.edit', compact('jadwalKerja', 'karyawans'));
    }

    /**
     * Update data jadwal kerja.
     */
    public function update(Request $request, JadwalKerja $jadwalKerja)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'shift' => 'required|in:pagi,siang,malam',
            'posisi' => 'required|string|max:100',
            'status' => 'required|in:terjadwal,diganti,dikonfirmasi',
        ]);

        try {
            $jadwalKerja->update($request->all());
            return redirect()->route('jadwalkerja.index')->with('success', 'Jadwal kerja berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui jadwal kerja: ' . $e->getMessage());
        }
    }

    /**
     * Hapus jadwal kerja.
     */
    public function destroy($id)
{
    $jadwalKerja = JadwalKerja::find($id);
    
    if (!$jadwalKerja) {
        return redirect()->route('jadwalkerja.index')->with('error', 'Data tidak ditemukan.');
    }

    try {
        $jadwalKerja->delete();
        return redirect()->route('jadwalkerja.index')->with('success', 'Jadwal kerja berhasil dihapus.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Gagal menghapus jadwal kerja: ' . $e->getMessage());
    }
}

    
}
