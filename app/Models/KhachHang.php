<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class KhachHang extends Authenticatable implements JWTSubject
{
    use SoftDeletes;
    use HasFactory;
    protected $appends = ['image_path'];

    protected $table = "khach_hang";

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getImagePathAttribute()
    {
        return env('APP_URL') . "/avatar/{$this->image}";
    }
}
