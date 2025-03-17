<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;

    protected $table = 'penggajians'; // Nama tabel

    protected $fillable = [
        'karyawan_id', 
        'gaji_pokok', 
        'tunjangan_transport', 
        'tunjangan_makan', 
        'tunjangan_lembur', 
        'potongan', 
        'total_gaji', 
        'tanggal_gajian'
    ];

    // Relasi dengan tabel Karyawan
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    // Mengambil nama jabatan dari tabel Karyawan
    public function getJabatanAttribute()
    {
        return $this->karyawan->jabatan ?? 'Tidak Ada Jabatan';
    }
}
