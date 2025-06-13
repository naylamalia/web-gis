<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPerubahanStatus extends Model
{
    use HasFactory;

    protected $table = 'log_perubahan_status';

    protected $fillable = [
        'keluarga_id',
        'status_lama',
        'status_baru',
        'alasan_perubahan',
        'tanggal_perubahan',
        'user_pengubah'
    ];

    protected $casts = [
        'tanggal_perubahan' => 'date'
    ];

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class);
    }
}
