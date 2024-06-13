<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loai;
class LoaiAPIController extends Controller
{
    public function DanhSachLoai()
    {
        $loai = loai::all();
        return response()->json([
            'success' => true,
            'data' => $loai
        ]);
    }
}
