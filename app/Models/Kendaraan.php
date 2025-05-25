<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasUuids;
    protected $table = 'kendaraans';

    protected $fillable = [
        'no_plat', 'tipe', 'tahun', 'id_pelanggan'
    ];

    public function pelanggan() {
        return $this->belongsTo(pelanngan::class, 'id_pelanggan', 'id');
    }
}
