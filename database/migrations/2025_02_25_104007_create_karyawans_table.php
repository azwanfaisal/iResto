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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 255);
            $table->text('alamat');
            $table->string('nomor_telepon', 20);
            $table->string('email', 255)->unique();
            $table->date('tanggal_lahir');
            $table->string('foto')->nullable();
            $table->enum('jabatan', ['kasir', 'pelayan', 'chef', 'manager', 'lainnya']);
            $table->enum('status_kepegawaian', ['aktif', 'tidak aktif'])->default('aktif');
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
