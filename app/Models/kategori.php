<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'image_kategori',
        'name_kategori',
    ];

    public $timestamps = true;

    public function deleteImage()
    {
        if ($this->image_kategori && file_exists(public_path('images/kategori/' . $this->image_kategori))) {
            return unlink(public_path('images/kategori/' . $this->image_kategori));
        }
    }

    public function kategori()
    {
        return $this->hasMany(kategori::class, 'id_kategori');
    }
    public function produk()
{
    return $this->hasMany(Produk::class);
}
}
