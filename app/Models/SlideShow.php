<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideShow extends Model
{
    use HasFactory;
    protected $appends = ['image_path'];

    protected $table = "slideshow";
    public function getImagePathAttribute()
    {
        return env('APP_URL') . "/{$this->image}";
    }
}
