<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\SanPham;
use App\Models\ChiTietSanPham;

class HoaDonController extends Controller
{
    public function View()
    {
        $hoaDon = HoaDon::orderBy('id', 'desc')->paginate(10);
        foreach($hoaDon as $hd)
        {
            $hd->khach_hang;
        }
     
        return view('HOADON/danh-sach',compact('hoaDon'));
    }

    public function HienChiTiet($id)
    {
        $chiTietHoaDon = ChiTietHoaDon::where('hoa_don_id',$id)->paginate(9);
        foreach($chiTietHoaDon as $cthd)
        {
            $cthd->chi_tiet_san_pham;
        }
     
        return view('HOADON/danh-sach-chi-tiet',compact('chiTietHoaDon'));
    }

    public function Huy($id)
    {
        $hoaDon = HoaDon::where('id',$id)->first();
        $hoaDon->trang_thai = 0;
        $hoaDon->trang_thai_thanh_toan = 0;
        $hoaDon->save();

        $chiTietHoaDon = ChiTietHoaDon::where('hoa_don_id',$id)->get();
        foreach($chiTietHoaDon as $cthd)
        {
            $cthd->chi_tiet_san_pham->so_luong += $cthd->so_luong;
            $cthd->chi_tiet_san_pham->save();

            $sanPham = SanPham::where('id',$cthd->chi_tiet_san_pham->san_pham_id)->first();
            $sanPham->so_luong += $cthd->so_luong;
            $sanPham->save();
        }

        return redirect()->route("hoa-don.danh-sach");
    }

    public function XacNhan($id)
    {
        $hoaDon = HoaDon::where('id',$id)->first();
        $hoaDon->trang_thai = 2;
        $hoaDon->save();
        return redirect()->route("hoa-don.danh-sach");
    }

    public function VanChuyen($id)
    {
        $hoaDon = HoaDon::where('id',$id)->first();
        $hoaDon->trang_thai = 3;
        $hoaDon->save();
        return redirect()->route("hoa-don.danh-sach");
    }

    public function ThanhCong($id)
    {
        $hoaDon = HoaDon::where('id',$id)->first();
        $hoaDon->trang_thai = 4;
        $hoaDon->trang_thai_thanh_toan =1;
        $hoaDon->save();
        return redirect()->route("hoa-don.danh-sach");
    }


    public function Loc($id)
    {
        $hoaDon = HoaDon::where('trang_thai',$id)->paginate(10);
        foreach($hoaDon as $hd)
        {
            $hd->khach_hang;
        }
     
        return view('HOADON/danh-sach',compact('hoaDon'));
    }

    public function LocThanhToan($id)
    {
        $hoaDon = HoaDon::where('trang_thai_thanh_toan',$id)->where('phuong_thuc_thanh_toan','Thanh toán qua Ngân hàng NCB')->paginate(10);
        foreach($hoaDon as $hd)
        {
            $hd->khach_hang;
        }
     
        return view('HOADON/danh-sach',compact('hoaDon'));
    }
}
