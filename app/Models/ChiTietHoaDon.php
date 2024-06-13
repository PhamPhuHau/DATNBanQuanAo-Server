<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    use HasFactory;
    protected $table = "chi_tiet_hoa_don";

    public function chi_tiet_san_pham()
    {
        return $this->belongsTo(ChiTietSanPham::class);
    }
}
