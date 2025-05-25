<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Garansi extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Garansi';

    protected $fillable = [
        'ID_Pelanggan',
        'ID_Kendaraan',
        'ID_Staff',
        'Keluhan'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'ID_Pelanggan');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'ID_Kendaraan');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'ID_Staff');
    }
}


