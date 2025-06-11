<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
        $request->validate([
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required|email|unique:karyawans',
            'tanggal_lahir' => 'required|date',
            'jabatan' => 'required',
            'status_kepegawaian' => 'required',
            'tanggal_masuk' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

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
            'nama_lengkap' => 'required',
            'alamat' => 'required',
            'nomor_telepon' => 'required',
            'email' => 'required|email|unique:karyawans,email,' . $karyawan->id,
            'tanggal_lahir' => 'required|date',
            'jabatan' => 'required',
            'status_kepegawaian' => 'required',
            'tanggal_masuk' => 'required|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($karyawan->foto) {
                Storage::disk('public')->delete($karyawan->foto);
            }
            $data['foto'] = $request->file('foto')->store('karyawan', 'public');
        }

        $karyawan->update($data);

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil diperbarui');
    }
   public function show($id)
{
    $karyawan = Karyawan::findOrFail($id);

    return view('karyawan.show', compact('karyawan'));
}





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        // Hapus foto jika ada
        if ($karyawan->foto) {
            Storage::disk('public')->delete($karyawan->foto);
        }

        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Karyawan berhasil dihapus');
    }
}
