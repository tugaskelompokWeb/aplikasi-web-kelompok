<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasUuids;
    protected $table = 'pelanggan';

    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
        'email',
        'jenis_kelamin',
        'tanggal_lahir'
    ];

    public function garansi()
    {
        return $this->hasMany(Garansi::class, 'pelanggan_id');
    }

    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class, 'pelanggan_id');
    }
}
