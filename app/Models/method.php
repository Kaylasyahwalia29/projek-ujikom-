<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class method extends Model
{
    use HasFactory;
    public $fillable = ['name_method'];
    public $visible = ['name_method'];
    public $timestamps = true;

    public function pembayaran()
    {
        return $this->hasMany(pembayaran::class);
    }
}
