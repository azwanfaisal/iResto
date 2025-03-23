<?php

namespace App\Http\Controllers;

use App\Models\EvaluasiKinerja;
use Illuminate\Http\Request;

class EvaluasiKinerjaController extends Controller
{
    /**
     * Menampilkan daftar evaluasi kinerja.
     */
    public function index()
    {
        $evaluasiKinerjas = EvaluasiKinerja::with('karyawan')->paginate(10);
        return view('evaluasi_kinerja.index', compact('evaluasiKinerjas'));
    }

    /**
     * Menampilkan form untuk membuat evaluasi kinerja baru.
     */
    public function create()
    {
        return view('evaluasi_kinerja.create');
    }

    /**
     * Menyimpan evaluasi kinerja baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawans,id',
            'keramahan' => 'required|integer|min:1|max:5',
            'kecepatan_layanan' => 'required|integer|min:1|max:5',
            'kepatuhan_sop' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string',
            'periode_evaluasi' => 'required|date',
        ]);

        EvaluasiKinerja::create($request->all());

        return redirect()->route('evaluasi_kinerja.index')
            ->with('success', 'Evaluasi Kinerja berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail evaluasi kinerja.
     */
    public function show(EvaluasiKinerja $evaluasiKinerja)
    {
        return view('evaluasi_kinerja.show', compact('evaluasiKinerja'));
    }

    /**
     * Menampilkan form untuk mengedit evaluasi kinerja.
     */
    public function edit(EvaluasiKinerja $evaluasiKinerja)
    {
        return view('evaluasi_kinerja.edit', compact('evaluasiKinerja'));
    }

    /**
     * Mengupdate evaluasi kinerja di database.
     */
    public function update(Request $request, EvaluasiKinerja $evaluasiKinerja)
    {
        $request->validate([
            'keramahan' => 'required|integer|min:1|max:5',
            'kecepatan_layanan' => 'required|integer|min:1|max:5',
            'kepatuhan_sop' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string',
            'periode_evaluasi' => 'required|date',
        ]);

        $evaluasiKinerja->update($request->all());

        return redirect()->route('evaluasi_kinerja.index')
            ->with('success', 'Evaluasi Kinerja berhasil diperbarui.');
    }

    /**
     * Menghapus evaluasi kinerja dari database.
     */
    public function destroy(EvaluasiKinerja $evaluasiKinerja)
    {
        $evaluasiKinerja->delete();

        return redirect()->route('evaluasi_kinerja.index')
            ->with('success', 'Evaluasi Kinerja berhasil dihapus.');
    }
}