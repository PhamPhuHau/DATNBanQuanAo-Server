<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;
use App\Models\QuanLy;
use Illuminate\Support\Facades\Hash;


class TaiKhoanController extends Controller
{
    public function View()
    {
        $khachHang = KhachHang::paginate(9);
        $quanLy = QuanLy::paginate(9);

        return view('TAIKHOAN/danh-sach',compact('khachHang','quanLy'));
    }
    public function HienKhoa()
    {
    $khachHang = KhachHang::onlyTrashed()->paginate(9);
       return view('TAIKHOAN/danh-sach-khoa',compact('khachHang'));
    }
    public function Khoa($id)
    {
         $khachHang = KhachHang::where('id',$id);
         $khachHang->delete();
         return redirect()->route('tai-khoan.danh-sach');
    }

    public function MoKhoa($id)
    {
         $khachHang = KhachHang::where('id',$id);
         $khachHang->restore();
         return redirect()->route('tai-khoan.danh-sach');
    }

    public function Them()
    {
        return view('TAIKHOAN/them');
    }

    public function XLThem(request $request)
    {

        $quanLy = new QuanLy();
        $quanLy->ten_dang_nhap = $request->ten;
        $quanLy->password=Hash::make($request->password);
        $quanLy->save();
        return redirect()->route('tai-khoan.danh-sach');
    }

    public function CapNhat($id)
    {
        $quanLy = QuanLy::where('id',$id)->first();
        return view('TAIKHOAN/cap-nhat',compact('quanLy'));
    }

    public function XLCapNhat($id, request $request)
    {
        $quanLy = QuanLy::where('id',$id)->first();
        $quanLy->password=Hash::make($request->password);
        $quanLy->save();
        return redirect()->route('tai-khoan.danh-sach')->with('thong_bao','Sửa mật khẩu thành công');
    }


    public function Xoa($id)
    {
        $totalAccounts = QuanLy::count();

        // có 1 taì khoản admin thì ko xóa dc
        if ($totalAccounts <= 1) {
            return redirect()->route('tai-khoan.danh-sach')->with('thong_bao', 'Không thể xoá tài khoản duy nhất.');
        }

        $quanLy = QuanLy::where('id',$id)->first();
        $quanLy->delete();
        return redirect()->route('tai-khoan.danh-sach')->with('thong_bao','Đã xoá');
    }

}
