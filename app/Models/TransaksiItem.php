<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TransaksiItem extends Model
{
    use HasUuids;

    protected $table = 'transaksi_items';
    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'jumlah',
        'harga_satuan'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
