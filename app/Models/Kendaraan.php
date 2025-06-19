<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasUuids;
    protected $table = 'kendaraan';

    protected $fillable = [
        'no_plat',
        'merek',
        'tipe',
        'warna',
        'tahun',
        'pelanggan_id'
    ];

    public function pelanggan() {
        return $this->belongsTo(pelanggan::class, 'pelanggan_id');
    }
}
        