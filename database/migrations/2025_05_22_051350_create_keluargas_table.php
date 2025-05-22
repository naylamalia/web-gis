<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluargasTable extends Migration
{
    public function up(): void
    {
        Schema::create('keluargas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kepala_keluarga');
            $table->text('alamat');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('rt', 5);
            $table->string('rw', 5);
            $table->string('desa');
            $table->string('kecamatan');
            $table->enum('kategori_kemiskinan', ['rentan miskin', 'miskin', 'menuju kelas menengah', 'kelas menengah', 'kelas atas']);
            $table->string('bantuan')->nullable(); // bantuan yang diterima
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keluargas');
    }
}
