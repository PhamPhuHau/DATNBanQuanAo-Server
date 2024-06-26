<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhapHang extends Model
{
    use HasFactory;
    protected $table = 'nhap_hang';
    public function chi_tiet_nhap_hang()
    {
        return $this->hasMany(ChiTietNhapHang::class, 'nhap_hang_id');
    }
}
