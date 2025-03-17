<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawans = Karyawan::when(request()->search, function ($query) {
            $query->where('nama_lengkap', 'like', '%' . request()->search . '%');
        })->paginate(10);

        return view('karyawan.index', compact('karyawans'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
            'email' => 'required|email|unique:karyawans,email',
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|max:2048',
            'jabatan' => 'required|string',
            'status_kepegawaian' => 'required|string',
            'tanggal_masuk' => 'required|date', // Tambahkan ini
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('karyawan', 'public');
        }
        

        Karyawan::create($data);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required',
            'nomor_telepon' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:karyawans,email,' . $karyawan->id,
            'tanggal_lahir' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jabatan' => 'required|in:kasir,pelayan,chef,manager,lainnya',
            'status_kepegawaian' => 'required|in:aktif,tidak aktif',
            'tanggal_masuk' => 'required|date',
            'tanggal_keluar' => 'nullable|date',
        ]);

        $karyawan->update($request->all());

        return redirect()->route('karyawans.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return redirect()->route('karyawans.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
