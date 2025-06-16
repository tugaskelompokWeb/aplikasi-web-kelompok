<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasUuids;
    protected $table = 'transaksi';

    protected $fillable = [
        'no_transaksi',
        'servis_id',
        'user_id',
        'metode_pembayaran',
        'tanggal',
        'pajak',
        'diskon',
        'total_harga'
    ];

    public function servis()
    {
        return $this->belongsTo(Servis::class, 'servis_id');
    }
    public function items()
    {
        return $this->hasMany(TransaksiItem::class, 'transaksi_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
