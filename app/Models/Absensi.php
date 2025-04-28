<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';
    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'status',
        'keterangan'
    ];

    protected $dates = ['tanggal'];
    protected $casts = [
        'tanggal' => 'date',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }

    // Accessor for formatted jam_masuk
    public function getJamMasukFormattedAttribute()
    {
        return $this->jam_masuk ? \Carbon\Carbon::parse($this->jam_masuk)->format('H:i') : '-';
    }

    // Accessor for formatted jam_pulang
    public function getJamPulangFormattedAttribute()
    {
        return $this->jam_pulang ? \Carbon\Carbon::parse($this->jam_pulang)->format('H:i') : '-';
    }
}