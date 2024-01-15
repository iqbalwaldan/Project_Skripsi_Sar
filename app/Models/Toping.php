<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toping extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'toping_id');
    }

    public function keranjangs()
    {
        return $this->hasMany(Keranjang::class, 'toping_id');
    }
}
