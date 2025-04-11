<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjangs';

    protected $fillable = [
        'produk_id',
        'jumlah',
        'total_harga',
        'image',
    ];

    // protected $visible = [
    //     'produk_id',
    //     'jumlah',
    //     'total',
    //     'image',
    // ];

    public $timestamps = true;

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
    
//     public function produk()
// {
//     return $this->belongsTo(Produk::class);
// }

    public function keranjang()
    {
        return $this->hasMany(keranjang::class, 'id_keranjang');
    }
}
