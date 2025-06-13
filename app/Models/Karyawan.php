<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Absensi;



class Karyawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lengkap',
        'alamat',
        'nomor_telepon',
        'email',
        'password',
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
    
public function user()
{
    return $this->hasOne(User::class);
}
public function absensis()
{
    return $this->hasMany(Absensi::class, 'karyawan_id');
}





}

