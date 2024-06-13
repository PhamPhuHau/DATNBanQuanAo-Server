<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DanhGia;
use App\Models\SanPham;
use Illuminate\Support\Facades\Validator;
class DanhGiaAPIController extends Controller
{
    public function ThemDanhGia(Request $request)
    {
        $validation = validator::make(request(['NhanXet','KhachHang','SoSao', 'san_pham']),[
            'KhachHang'=>'required',
            'SoSao'=>'required',
            'san_pham'=>'required',
        ],[
            'KhachHang.required'=>'vui lòng đăng nhập',
            'san_pham.required'=>'hãy chọn sản phẩm',
            'SoSao.required'=>'hãy chọn số sao cho sản phẩm',
        ]);

        if($validation->fails())
        {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $danhGia = DanhGia::where('san_pham_id',$request->san_pham)->where('khach_hang_id', $request->KhachHang)->first();
        if(empty($danhGia))
        {
            $danhGia = new DanhGia();
            $danhGia->khach_hang_id = $request->KhachHang;
            $danhGia->san_pham_id = $request->san_pham;
            $danhGia->so_sao = $request->SoSao;
            $danhGia->nhan_xet = $request->NhanXet;
            $danhGia->save();
        }
        else
        {
            $danhGia->so_sao = $request->SoSao;
            $danhGia->nhan_xet = $request->NhanXet;
            $danhGia->save();
        }

        $danhGia = DanhGia::where('san_pham_id',$request->san_pham)->get();
        $sanPham= SanPham::where('id', $request->san_pham)->first();
        $tongSao = 0;
        foreach ($danhGia as $DanhGia)
        {
            $tongSao += $DanhGia->so_sao;
            
        }
        
        $sanPham->so_sao = (double)$tongSao / (double)$danhGia->count();
        $sanPham->save();
        
        return response()->json([
            'message' => 'thanh cong'
        ]);
    }

    public function LayDanhGia($id)
    {
        $danhGia = DanhGia::where('san_pham_id',$id)->get();
        foreach($danhGia as $DanhSachDanhGia)
        {
            $DanhSachDanhGia->khach_hang;
        }
        return response()->json([
            'message' => 'thanh cong',
            'data' => $danhGia
        ]);
    }
}
