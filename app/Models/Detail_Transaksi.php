<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Transaksi extends Model
{
    use HasFactory;
    public $fillable = ['id', 'id_transaksi', 'id_produk'];
    public $timestamps = true;

    public function transaksi()
    {
    return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id');
}


    // Relasi ke Barang (One-to-Many dengan barang)
    public function produk()
{
    return $this->belongsTo(Produk::class, 'id_produk', 'id');
}
}
