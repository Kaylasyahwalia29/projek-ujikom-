<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;


class produk extends Model
{
use HasFactory;
    protected $fillable = [
        'id',
        'name_produk',
        'kategori_produk',
        'desc_produk',
        'harga_produk',
        'stok_produk',
        'image_produk',
    ];
    public $timestamps = true;

    public function deleteImage()
    {
        if ($this->image_produk && file_exists(public_path('images/produk/' . $this->image_produk))) {
            return unlink(public_path('images/produk/' . $this->image_produk));
        }
    }

    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'id_kategori');

    }

    public function produk()
    {
        return $this->hasMany(produk::class, 'id_produk');
    }
}
