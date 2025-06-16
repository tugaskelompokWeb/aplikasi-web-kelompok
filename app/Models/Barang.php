<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasUuids;
    protected $table = 'barang';
    protected $fillable = [
        'kode_barang',
        'nama',
        'kategori',
        'satuan',
        'stok',
        'harga'
    ];


}
