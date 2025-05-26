<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Garansi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_Garansi';
    protected $table = 'garansi' ;

    protected $fillable = [
        'id_Pelanggan',
        'id_Kendaraan',
        'user_id',
        'Keluhan',
        'tanggal_garansi',
        'batas_akhir',
        'status'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_Pelanggan');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_Kendaraan');
    }

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }
}


