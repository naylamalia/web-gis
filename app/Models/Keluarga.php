<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Keluarga extends Model
{
    use HasFactory;


    protected $fillable = [
        'nama_kepala_keluarga',
        'alamat',
        'latitude',
        'longitude',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'kategori_kemiskinan',
        'bantuan',
    ];


    // Relasi: satu keluarga memiliki banyak anggota




    public function anggotaKeluarga()
    {
        return $this->hasMany(\App\Models\AnggotaKeluarga::class, 'keluarga_id');
    }
}

