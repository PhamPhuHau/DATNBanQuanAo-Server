<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChiTietLoai;
class ChiTietLoaiAPIController extends Controller
{
    public function DanhSachChiTietLoai()
    {
        $chi_tiet_loai = ChiTietLoai::all();
        return response()->json([
            'success' => true,
            'data' => $chi_tiet_loai
        ]);
    }
}
