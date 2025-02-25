<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

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
        'tanggal_keluar'
    ];
}
