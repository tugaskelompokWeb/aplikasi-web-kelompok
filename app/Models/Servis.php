<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servis extends Model
{
    use HasUuids;

    protected $table = 'servis';

    protected $fillable = [
        'tgl_datang',
        'tgl_keluar',
        'total_biaya',
        'keluhan_awal',
        'status_servis',
        'kendaraan_id',
        'mekanik_id'
    ];

    public function mekanik() {
        return $this->belongsTo(Mekanik::class);
    }

    public function kendaraan() {
        return $this->belongsTo(Kendaraan::class);
    }
}