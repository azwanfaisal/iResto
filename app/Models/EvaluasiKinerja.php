<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiKinerja extends Model
{
    use HasFactory;

    protected $table = 'evaluasi_kinerjas';

    protected $fillable = [
        'karyawan_id',
        'keramahan',
        'kecepatan_layanan',
        'kepatuhan_sop',
        'feedback',
        'periode_evaluasi',
    ];

    // Relasi ke tabel karyawan (jika ada)
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}