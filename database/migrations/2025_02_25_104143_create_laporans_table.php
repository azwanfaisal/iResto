<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->enum('jenis_laporan', ['kehadiran', 'penggajian', 'kinerja']);
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->string('format', 10)->default('PDF'); // Bisa PDF, Excel, CSV
            $table->string('file_path')->nullable(); // Path penyimpanan file laporan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
