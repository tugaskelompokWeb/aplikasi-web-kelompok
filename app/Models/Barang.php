<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'kode_barang',
        'nama',
        'kategori',
        'satuan',
        'stok',
        'harga'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
