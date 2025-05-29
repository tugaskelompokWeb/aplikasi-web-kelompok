<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Garansi extends Model
{
    use HasFactory;

    protected $table = 'garansi' ;

    protected $fillable = [
        'pelanggan_id',
        'kendaraan_id',
        'user_id',
        'Keluhan',
        'tanggal_garansi',
        'batas_akhir',
        'status'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
}


