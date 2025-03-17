<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data laporan dengan pagination
        $laporans = Laporan::latest()->paginate(10);

        // Tampilkan view index dengan data laporan
        return view('laporans.index', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan form untuk membuat laporan baru
        return view('laporans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis_laporan' => 'required|in:kehadiran,penggajian,kinerja',
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date|after_or_equal:periode_awal',
            'format' => 'required|in:PDF,Excel,CSV',
            'file_path' => 'nullable|string',
        ]);

        // Simpan data laporan ke database
        Laporan::create($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('laporans.index')
                         ->with('success', 'Laporan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        // Tampilkan detail laporan
        return view('laporans.show', compact('laporans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        // Tampilkan form untuk mengedit laporan
        return view('laporans.edit', compact('laporans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis_laporan' => 'required|in:kehadiran,penggajian,kinerja',
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date|after_or_equal:periode_awal',
            'format' => 'required|in:PDF,Excel,CSV',
            'file_path' => 'nullable|string',
        ]);

        // Update data laporan
        $laporan->update($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('laporans.index')
                         ->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        // Hapus data laporan
        $laporan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('laporans.index')
                         ->with('success', 'Laporan berhasil dihapus.');
    }
}