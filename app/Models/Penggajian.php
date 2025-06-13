<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;

    protected $table = 'penggajians';

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

    protected $casts = [
        'tanggal_gajian' => 'date',
        'gaji_pokok' => 'decimal:2',
        'tunjangan_transport' => 'decimal:2',
        'tunjangan_makan' => 'decimal:2',
        'tunjangan_lembur' => 'decimal:2',
        'potongan' => 'decimal:2',
        'total_gaji' => 'decimal:2',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }


    protected static function booted()
    {
        static::creating(function ($model) {
            $model->calculateTotal();
        });

        static::updating(function ($model) {
            $model->calculateTotal();
        });
    }

    public function calculateTotal()
    {
        $this->total_gaji = $this->gaji_pokok
            + $this->tunjangan_transport
            + $this->tunjangan_makan
            + $this->tunjangan_lembur
            - $this->potongan;
    }
}
