<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected $casts = [
        'periode_awal' => 'date',
        'periode_akhir' => 'date',
    ];

    // Jenis Laporan Options
    const JENIS_KEHADIRAN = 'kehadiran';
    const JENIS_PENGGAJIAN = 'penggajian';
    const JENIS_KINERJA = 'kinerja';

    // Format Options
    const FORMAT_PDF = 'PDF';
    const FORMAT_EXCEL = 'Excel';
    const FORMAT_CSV = 'CSV';

    public static function jenisOptions()
    {
        return [
            self::JENIS_KEHADIRAN => 'Kehadiran',
            self::JENIS_PENGGAJIAN => 'Penggajian',
            self::JENIS_KINERJA => 'Kinerja',
        ];
    }

    public static function formatOptions()
    {
        return [
            self::FORMAT_PDF => 'PDF',
            self::FORMAT_EXCEL => 'Excel',
            self::FORMAT_CSV => 'CSV',
        ];
    }

    public function getJenisDisplayAttribute()
    {
        return self::jenisOptions()[$this->jenis_laporan] ?? $this->jenis_laporan;
    }

    public function getFormatDisplayAttribute()
    {
        return self::formatOptions()[$this->format] ?? $this->format;
    }
}