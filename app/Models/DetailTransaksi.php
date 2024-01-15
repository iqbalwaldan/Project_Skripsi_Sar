<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }

    public function toping()
    {
        return $this->belongsTo(Toping::class, 'toping_id');
    }
}
