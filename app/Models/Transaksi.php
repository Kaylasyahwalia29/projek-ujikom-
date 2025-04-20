<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_pengguna','jumlah_produk', 'nama_produk', 'total_harga', 'tanggal_transaksi', 'id_user', 'id_pembayaran', 'status'
    ];

    public $timestamps = true;

    public function detailTransaksi()
    {
        return $this->hasMany(Detail_Transaksi::class, 'id_transaksi');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }
}
