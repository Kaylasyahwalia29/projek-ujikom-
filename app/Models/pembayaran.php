<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class pembayaran extends Model
{
    use HasFactory;

    public $fillable = ['id', 'id_user', 'alamat', 'id_method'];
    public $visible = ['alamat'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function method()
    {
        return $this->belongsTo(Method::class, 'id_method');
    }

}
