<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BantuanKk extends Model
{
    use HasFactory;

    protected $table = 'bantuan_kk';

    protected $fillable = [
        'keluarga_id', 'tahun_anggaran', 'status', 'nominal', 'tanggal_cair'
    ];

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class, 'keluarga_id');
    }
}
