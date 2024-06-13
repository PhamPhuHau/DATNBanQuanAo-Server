<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhapHang extends Model
{
    use HasFactory;
    protected $table = 'nhap_hang';
    public function nha_cung_cap()
    {
        return $this->belongsTo(NhaCungCap::class);
    }
}
