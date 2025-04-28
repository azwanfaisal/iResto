<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    public function index()
    {
        $penggajians = Penggajian::with('karyawan')->paginate(10);
        return view('penggajians.index', compact('penggajians'));
    }

    public function create()
    {
        $karyawans = Karyawan::all();
        return view('penggajians.create', compact('karyawans'));
    }

    public function store(Request $request)
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

        try {
            $penggajian = new Penggajian($validated);
            $penggajian->save();
            
            return redirect()->route('penggajians.index')
                ->with('success', 'Data penggajian berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $penggajian = Penggajian::findOrFail($id);
        $karyawans = Karyawan::all();
        return view('penggajians.edit', compact('penggajian', 'karyawans'));
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

        try {
            $penggajian = Penggajian::findOrFail($id);
            $penggajian->update($validated);
            
            return redirect()->route('penggajians.index')
                ->with('success', 'Data penggajian berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $penggajian = Penggajian::findOrFail($id);
            $penggajian->delete();
            
            return redirect()->route('penggajians.index')
                ->with('success', 'Data penggajian berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}