<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PergantianJadwal extends Model
{
    protected $fillable = [
    'jadwalkerja_id',
    'pengganti_id',
    'status',
    'alasan',
];
public function jadwalKerja()
{
    return $this->belongsTo(JadwalKerja::class, 'jadwalkerja_id');
}

public function pengganti()
{
    return $this->belongsTo(Karyawan::class, 'pengganti_id');
}

}
