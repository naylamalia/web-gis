<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaKeluargasTable extends Migration
{
    public function up(): void
    {
        Schema::create('anggota_keluargas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keluarga_id')->constrained('keluargas')->onDelete('cascade');
            $table->string('nik')->unique();
            $table->string('nama');
            $table->integer('usia');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('hubungan_dengan_kepala'); // contoh: anak, istri, suami
            $table->string('pekerjaan')->nullable();

            // Tambahan kolom
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('pendidikan_terakhir', ['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'Diploma', 'S1', 'S2', 'S3'])->nullable();
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'])->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'])->nullable();
            $table->enum('kewarganegaraan', ['Indonesia', 'Asing'])->default('Indonesia');
            $table->decimal('penghasilan', 10, 2)->nullable();
            $table->boolean('bpjs')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota_keluargas');
    }
}
