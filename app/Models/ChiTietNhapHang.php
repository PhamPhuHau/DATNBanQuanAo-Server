<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietNhapHang extends Model
{
    use HasFactory;
    protected $table = 'chi_tiet_nhap_hang';

    public function nhap_hang() {
        return $this->belongsTo(NhapHang::class);
    }

    public function san_pham()
    {
        return $this->belongsTo(SanPham::class);
    }
}
