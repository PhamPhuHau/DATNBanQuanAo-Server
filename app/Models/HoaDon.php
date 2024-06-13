<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
    
class HoaDon extends Model
{
    use HasFactory;
    protected $appends = ['order_date'];
    protected $table = "hoa_don";

    public function khach_hang() {
        return $this->belongsTo(KhachHang::class);
    }
    public function getOrderDateAttribute()
    {
        $timestamp = $this->attributes['updated_at'] ?? $this->attributes['created_at'];

        return Carbon::parse($timestamp)
            ->setTimezone('Asia/Ho_Chi_Minh')
            ->format('d/m/Y H:i');
    }   
}
