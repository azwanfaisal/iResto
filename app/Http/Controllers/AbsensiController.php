<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $absensis = Absensi::with('user')->latest()->paginate(10);
        return view('absensi.index', compact('absensis'));
    }

    public function checkin()
    {
        // Cek apakah user sudah absen masuk hari ini
        $existingAbsensi = Absensi::where('user_id', Auth::id())
            ->where('date', now()->toDateString())
            ->first();

        if ($existingAbsensi) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absen masuk hari ini!');
        }

        // Simpan data absen masuk
        Absensi::create([
            'user_id' => Auth::id(),
            'date' => now()->toDateString(),
            'check_in' => now()->toTimeString(),
            'status' => now()->hour > 9 ? 'late' : 'ontime'
        ]);

        return redirect()->back()->with('success', 'Absen masuk berhasil!');
    }

    public function checkout()
    {
        $attendance = Absensi::where('user_id', Auth::id())
            ->where('date', now()->toDateString())
            ->first();
        
        if ($attendance) {
            if ($attendance->check_out) {
                return redirect()->back()->with('error', 'Anda sudah melakukan absen keluar!');
            }

            $attendance->update(['check_out' => now()->toTimeString()]);
            return redirect()->back()->with('success', 'Absen keluar berhasil!');
        }

        return redirect()->back()->with('error', 'Anda belum absen masuk!');
    }
}
