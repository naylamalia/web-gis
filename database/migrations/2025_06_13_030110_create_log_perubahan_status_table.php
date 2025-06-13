<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('log_perubahan_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluarga_id')->constrained('keluargas')->onDelete('cascade');
            $table->enum('status_lama', ['aktif', 'pindah', 'tidak_miskin', 'meninggal', 'tidak_aktif'])->nullable();
            $table->enum('status_baru', ['aktif', 'pindah', 'tidak_miskin', 'meninggal', 'tidak_aktif']);
            $table->text('alasan_perubahan');
            $table->date('tanggal_perubahan');
            $table->string('user_pengubah');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('log_perubahan_status');
    }
};
