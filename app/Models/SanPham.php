<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SanPham extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'san_pham';

    public function hinh_anh(){
        return $this->hasMany(HinhAnh::class);
    }

    public function nha_cung_cap()
    {
        return $this->belongsTo(NhaCungCap::class);
    }

    public function loai()
    {
        return $this->belongsTo(Loai::class);
    }
    public function chi_tiet_loai()
    {
        return $this->belongsTo(ChiTietLoai::class);
    }

    public function chi_tiet_san_pham()
    {
        return $this->hasMany(ChiTietSanPham::class);
    }
}
