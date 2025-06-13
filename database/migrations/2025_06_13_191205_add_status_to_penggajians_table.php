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
    Schema::table('penggajians', function (Blueprint $table) {
        $table->enum('status', ['belum dibayar', 'dibayar'])->default('belum dibayar')->after('tanggal_gajian');
    });
}

public function down(): void
{
    Schema::table('penggajians', function (Blueprint $table) {
        $table->dropColumn('status');
    });
}

};
