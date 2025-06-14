<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans'; // pastikan sesuai dengan nama tabel

    protected $fillable = [
        'periode_awal',
        'periode_akhir',
        'total_karyawan',
        'total_absensi',
        'total_penggajian',
    ];

    protected $casts = [
        'periode_awal' => 'date',
        'periode_akhir' => 'date',
    ];
}
