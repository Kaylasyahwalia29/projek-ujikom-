<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;
    public $fillable = ['alamat'];
    public $visible = ['alamat'];
    public $timestamps = true;

    public function keranjang()
    {
        return $this->belongsTo(keranjang::class, 'id_keranjaang');
    }
    
}
