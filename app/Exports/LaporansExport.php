<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporansExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Laporan::select('periode_awal', 'periode_akhir', 'total_karyawan', 'total_absensi', 'total_penggajian')->get();
    }

    public function headings(): array
    {
        return ['Periode Awal', 'Periode Akhir', 'Total Karyawan', 'Total Absensi', 'Total Penggajian'];
    }
}
