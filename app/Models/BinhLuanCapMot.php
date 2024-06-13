<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BinhLuanCapMot extends Model
{
    use HasFactory;
    protected $table='binh_luan_cap_mot';
    public function khach_hang() {
        return $this->belongsTo(KhachHang::class);
    }
    public function binh_luan_cap_hai() {
        
        return $this->hasMany(BinhLuanCapHai::class);
        
    }

    public function san_pham() {
        return $this->belongsTo(SanPham::class);
    }
}
