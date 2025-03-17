<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data penggajian dengan relasi karyawan dan pagination
        $penggajians = Penggajian::with('karyawan')->latest()->paginate(10);

        // Tampilkan view index dengan data penggajian
        return view('penggajians.index', compact('penggajians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data karyawan untuk dropdown
        $karyawans = Karyawan::all();

        // Tampilkan form untuk membuat penggajian baru
        return view('penggajians.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan_transport' => 'nullable|numeric|min:0',
            'tunjangan_makan' => 'nullable|numeric|min:0',
            'tunjangan_lembur' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
            'tanggal_gajian' => 'required|date',
        ]);

        // Hitung total gaji
        $total_gaji = $request->gaji_pokok + $request->tunjangan_transport + $request->tunjangan_makan + $request->tunjangan_lembur - $request->potongan;

        // Simpan data penggajian ke database
        Penggajian::create([
            'karyawan_id' => $request->karyawan_id,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan_transport' => $request->tunjangan_transport,
            'tunjangan_makan' => $request->tunjangan_makan,
            'tunjangan_lembur' => $request->tunjangan_lembur,
            'potongan' => $request->potongan,
            'total_gaji' => $total_gaji,
            'tanggal_gajian' => $request->tanggal_gajian,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('penggajians.index')
                         ->with('success', 'Penggajian berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penggajian $penggajian)
    {
        // Tampilkan detail penggajian
        return view('penggajians.show', compact('penggajian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penggajian $penggajian)
    {
        // Ambil data karyawan untuk dropdown
        $karyawans = Karyawan::all();

        // Tampilkan form untuk mengedit penggajian
        return view('penggajians.edit', compact('penggajian', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penggajian $penggajian)
    {
        // Validasi input
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan_transport' => 'nullable|numeric|min:0',
            'tunjangan_makan' => 'nullable|numeric|min:0',
            'tunjangan_lembur' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
            'tanggal_gajian' => 'required|date',
        ]);

        // Hitung total gaji
        $total_gaji = $request->gaji_pokok + $request->tunjangan_transport + $request->tunjangan_makan + $request->tunjangan_lembur - $request->potongan;

        // Update data penggajian
        $penggajian->update([
            'karyawan_id' => $request->karyawan_id,
            'gaji_pokok' => $request->gaji_pokok,
            'tunjangan_transport' => $request->tunjangan_transport,
            'tunjangan_makan' => $request->tunjangan_makan,
            'tunjangan_lembur' => $request->tunjangan_lembur,
            'potongan' => $request->potongan,
            'total_gaji' => $total_gaji,
            'tanggal_gajian' => $request->tanggal_gajian,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('penggajians.index')
                         ->with('success', 'Penggajian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penggajian $penggajian)
    {
        // Hapus data penggajian
        $penggajian->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('penggajians.index')
                         ->with('success', 'Penggajian berhasil dihapus.');
    }
}