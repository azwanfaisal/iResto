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
    Schema::table('penggajians', function (Blueprint $table) {
        $table->dateTime('tanggal_bayar')->nullable()->after('status');
    });
}

public function down()
{
    Schema::table('penggajians', function (Blueprint $table) {
        $table->dropColumn('tanggal_bayar');
    });
}

};
