<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'alamat',
        'nomor_telepon',
        'email',
        'tanggal_lahir',
        'foto',
        'jabatan',
        'status_kepegawaian',
        'tanggal_masuk',
    ];
     // Relasi ke jadwal kerja
    public function jadwalKerjas()
    {
        return $this->hasMany(JadwalKerja::class);
    }
}

