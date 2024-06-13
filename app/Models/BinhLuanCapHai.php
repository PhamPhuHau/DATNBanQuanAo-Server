<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuanCapHai extends Model
{
    protected $table='binh_luan_cap_hai';
    public function khach_hang() {
        return $this->belongsTo(KhachHang::class);
    }

    public function san_pham() {
        return $this->belongsTo(SanPham::class);
    }
}
