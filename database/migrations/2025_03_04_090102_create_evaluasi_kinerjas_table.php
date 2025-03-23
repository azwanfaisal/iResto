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
        Schema::create('evaluasi_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id'); // ID karyawan yang dievaluasi
            $table->integer('keramahan')->default(1); // Skor keramahan (1-5)
            $table->integer('kecepatan_layanan')->default(1); // Skor kecepatan layanan (1-5)
            $table->integer('kepatuhan_sop')->default(1); // Skor kepatuhan SOP (1-5)
            $table->text('feedback')->nullable(); // Feedback untuk karyawan
            $table->date('periode_evaluasi'); // Periode evaluasi (bulan/tahun)
            $table->timestamps();

            // Foreign key ke tabel karyawan
            $table->foreign('karyawan_id')->references('id')->on('karyawans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasi_kinerjas');
    }
};