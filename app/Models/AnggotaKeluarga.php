<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKeluarga extends Model
{
    use HasFactory;

    protected $fillable = [
        'keluarga_id',
        'nik',
        'nama',
        'usia',
        'jenis_kelamin',
        'hubungan_dengan_kepala',
        'pekerjaan',
        'tempat_lahir',
        'tanggal_lahir',
        'pendidikan_terakhir',
        'status_perkawinan',
        'agama',
        'kewarganegaraan',
        'penghasilan',
        'bpjs',
    ];

    protected $casts = [
        'bpjs' => 'boolean',
        'penghasilan' => 'decimal:2',
        'tanggal_lahir' => 'date',
    ];

    // Relasi: anggota milik satu keluarga
    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'keluarga_id');
    }
}