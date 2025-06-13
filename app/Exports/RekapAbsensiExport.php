<?php

namespace App\Exports;

use App\Models\Karyawan;
use App\Models\Absensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapAbsensiExport implements FromView
{
    protected $bulan;
    protected $karyawan_id;

    public function __construct($bulan, $karyawan_id)
    {
        $this->bulan = $bulan;
        $this->karyawan_id = $karyawan_id;
    }

    public function view(): View
    {
        $tanggalAwal = $this->bulan . '-01';
        $tanggalAkhir = date('Y-m-t', strtotime($tanggalAwal));

        $query = Karyawan::with(['absensis' => function ($q) use ($tanggalAwal, $tanggalAkhir) {
            $q->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        }]);

        if ($this->karyawan_id) {
            $query->where('id', $this->karyawan_id);
        }

        $karyawans = $query->get();

        $rekap = $karyawans->map(function ($karyawan) use ($tanggalAwal, $tanggalAkhir) {
            $data = [
                'karyawan' => $karyawan,
                'hadir' => $karyawan->absensis->where('status', 'hadir')->count(),
                'izin' => $karyawan->absensis->where('status', 'izin')->count(),
                'sakit' => $karyawan->absensis->where('status', 'sakit')->count(),
                'cuti' => $karyawan->absensis->where('status', 'cuti')->count(),
                'alpa' => $karyawan->absensis->where('status', 'alpa')->count(),
                'total_hari' => $karyawan->absensis->count(),
            ];
            return (object)$data;
        });

        return view('exports.rekap_absensi', [
            'rekap' => $rekap,
            'bulan' => $this->bulan
        ]);
    }
}

