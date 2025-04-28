<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::latest()->paginate(10);
        return view('laporans.index', compact('laporans'));
    }

    public function create()
    {
        return view('laporans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis_laporan' => 'required|in:kehadiran,penggajian,kinerja',
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date|after_or_equal:periode_awal',
            'format' => 'required|in:PDF,Excel,CSV',
            'file' => 'nullable|file|mimes:pdf,xlsx,csv|max:2048',
        ]);

        try {
            if ($request->hasFile('file')) {
                $validated['file_path'] = $request->file('file')->store('laporan_files');
            }

            Laporan::create($validated);

            return redirect()->route('laporans.index')
                ->with('success', 'Laporan berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal menambahkan laporan: ' . $e->getMessage());
        }
    }

    public function edit(Laporan $laporan)
    {
        return view('laporans.edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'jenis_laporan' => 'required|in:kehadiran,penggajian,kinerja',
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date|after_or_equal:periode_awal',
            'format' => 'required|in:PDF,Excel,CSV',
            'file' => 'nullable|file|mimes:pdf,xlsx,csv|max:2048',
        ]);

        try {
            if ($request->hasFile('file')) {
                // Delete old file if exists
                if ($laporan->file_path) {
                    Storage::delete($laporan->file_path);
                }
                $validated['file_path'] = $request->file('file')->store('laporan_files');
            }

            $laporan->update($validated);

            return redirect()->route('laporans.index')
                ->with('success', 'Laporan berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal memperbarui laporan: ' . $e->getMessage());
        }
    }

    public function destroy(Laporan $laporan)
    {
        try {
            // Delete file if exists
            if ($laporan->file_path) {
                Storage::delete($laporan->file_path);
            }

            $laporan->delete();

            return redirect()->route('laporans.index')
                ->with('success', 'Laporan berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus laporan: ' . $e->getMessage());
        }
    }

    public function download(Laporan $laporan)
    {
        if (!$laporan->file_path || !Storage::exists($laporan->file_path)) {
            abort(404);
        }

        return Storage::download($laporan->file_path);
    }
}