<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bantuan_kk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluarga_id')->constrained('keluargas')->onDelete('cascade');
            $table->year('tahun_anggaran');
            $table->enum('status', ['aktif', 'non-aktif'])->default('aktif');
            $table->decimal('nominal', 10, 2)->nullable();
            $table->timestamps();

            // Agar satu KK tidak punya bantuan ganda di tahun yang sama
            $table->unique(['keluarga_id', 'tahun_anggaran']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('bantuan_kk');
    }
};
