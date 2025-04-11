<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class informasi extends Model
{
    use HasFactory;

    public function deleteImage()
    {
        if ($this->image_informasi && file_exists(public_path('images/informasi/' . $this->image_informasi))) {
            return unlink(public_path('images/informasi/' . $this->image_informasi));
        }
    }
}
