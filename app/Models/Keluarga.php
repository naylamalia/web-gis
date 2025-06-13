<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Keluarga extends Model
{
    use HasFactory;


    protected $fillable = [
        'nomor_kk', 
        'nik_kepala_keluarga',
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
        'status_kk'
    ];


    // Relasi: satu keluarga memiliki banyak anggota




    public function anggotaKeluarga()
    {
        return $this->hasMany(\App\Models\AnggotaKeluarga::class, 'keluarga_id');
    }

    public function bantuanKk()
    {
        return $this->hasMany(\App\Models\BantuanKk::class, 'keluarga_id');
    }
    public function logPerubahanStatus()
    {
        return $this->hasMany(LogPerubahanStatus::class, 'keluarga_id');
    }

    // Accessor untuk status badge
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'aktif' => 'bg-success',
            'pindah' => 'bg-warning',
            'tidak_miskin' => 'bg-info',
            'meninggal' => 'bg-dark',
            'tidak_aktif' => 'bg-danger'
        ];

        return $badges[$this->status_kk] ?? 'bg-secondary';
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'aktif' => 'Aktif',
            'pindah' => 'Pindah Alamat',
            'tidak_miskin' => 'Tidak Miskin Lagi',
            'meninggal' => 'Kepala Keluarga Meninggal',
            'tidak_aktif' => 'Tidak Aktif'
        ];

        return $labels[$this->status_kk] ?? 'Unknown';
    }
}

