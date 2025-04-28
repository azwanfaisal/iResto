<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JadwalKerja;
use App\Models\Karyawan;

class JadwalKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalKerja = JadwalKerja::with('karyawan')->paginate(10);
        return view('jadwalkerja.index', compact('jadwalKerja'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::all();
        return view('jadwalkerja.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
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
            return back()->withInput()->with('error', 'Gagal menambahkan jadwal kerja: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $jadwal = JadwalKerja::findOrFail($id);
        $karyawans = Karyawan::all();
        return view('jadwalkerja.edit', compact('jadwal', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'shift' => 'required|in:pagi,siang,malam',
            'posisi' => 'required|string|max:100',
            'status' => 'required|in:terjadwal,diganti,dikonfirmasi',
        ]);

        try {
            $jadwal = JadwalKerja::findOrFail($id);
            $jadwal->update($request->all());
            return redirect()->route('jadwalkerja.index')->with('success', 'Jadwal kerja berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui jadwal kerja: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $jadwal = JadwalKerja::findOrFail($id);
            $jadwal->delete();
            return redirect()->route('jadwalkerja.index')->with('success', 'Jadwal kerja berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus jadwal kerja: ' . $e->getMessage());
        }
    }
}