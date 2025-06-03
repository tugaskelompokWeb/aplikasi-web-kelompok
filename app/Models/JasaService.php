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
        'nama_jasa',
        'biaya'
    ];

    public function servis()
    {
        return $this->belongsTo(Servis::class, 'servis_id');
    }
}
