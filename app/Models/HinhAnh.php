<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HinhAnh extends Model
{
    use HasFactory;
    protected $appends = ['image_path'];

    protected $table = "hinh_anh";
    public function getImagePathAttribute()
    {
        return env('APP_URL') . "/{$this->image}";
    }
}
