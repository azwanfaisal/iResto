<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporans';

    protected $fillable = [
        'judul',
        'deskripsi',
        'jenis_laporan',
        'periode_awal',
        'periode_akhir',
        'format',
        'file_path'
    ];
}
