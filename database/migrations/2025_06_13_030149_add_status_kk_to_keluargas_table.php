<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('keluargas', function (Blueprint $table) {
            $table->enum('status_kk', ['aktif', 'pindah', 'tidak_miskin', 'meninggal', 'tidak_aktif'])->default('aktif');
        });
    }

    public function down()
    {
        Schema::table('keluargas', function (Blueprint $table) {
            $table->dropColumn('status_kk');
        });
    }
};
