<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('laporans', function (Blueprint $table) {
        $table->id();
        $table->date('periode_awal');
        $table->date('periode_akhir');
        $table->integer('total_karyawan')->default(0);
        $table->integer('total_absensi')->default(0);
        $table->bigInteger('total_penggajian')->default(0);
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
