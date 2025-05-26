<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Mekanik extends Model
{
    use HasUuids;
    protected $table = 'mekanik';

    protected $fillable = [
        'nama', 'telepon', 'keahlian', 'status'
    ];
}
