<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasUuids;
    protected $table = 'pelanggan';

    protected $fillable = [
        'nama', 'alamat', 'telepon'
    ];
}
