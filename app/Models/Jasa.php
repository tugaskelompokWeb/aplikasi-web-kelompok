<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasUuids;
    protected $table = 'jasa';

    protected $fillable = [
        'nama_jasa',
        'biaya'
    ];
}
