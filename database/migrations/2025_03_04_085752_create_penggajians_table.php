<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penggajians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id'); // Changed to unsignedBigInteger
            $table->decimal('gaji_pokok', 15, 2);
            $table->decimal('tunjangan_transport', 15, 2)->default(0);
            $table->decimal('tunjangan_makan', 15, 2)->default(0);
            $table->decimal('tunjangan_lembur', 15, 2)->default(0);
            $table->decimal('potongan', 15, 2)->default(0);
            $table->decimal('total_gaji', 15, 2);
            $table->date('tanggal_gajian');
            $table->timestamps();

            // Foreign key constraint added separately
            $table->foreign('karyawan_id')
                  ->references('id')
                  ->on('karyawans')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('penggajians', function (Blueprint $table) {
            $table->dropForeign(['karyawan_id']);
        });
        Schema::dropIfExists('penggajians');
    }
};