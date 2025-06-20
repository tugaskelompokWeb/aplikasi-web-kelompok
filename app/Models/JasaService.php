<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class JasaService extends Model
{
    use HasUuids;
    protected $table = 'detail_servis';
    protected $fillable = [
        'servis_id',
        'jasa_id'
    ];

    public function jasa() {
    return $this->belongsTo(Jasa::class, 'jasa_id');
}
}
