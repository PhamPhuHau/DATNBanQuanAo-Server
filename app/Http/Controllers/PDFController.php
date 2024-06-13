<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChiTietHoaDon;
use App\Models\KhachHang;
use App\Models\HoaDon;

use PDF;
class PDFController extends Controller
{
    public function exportPDF($id)
    {
        // try{
        // $chiTietHoaDon=ChiTietHoaDon::all();
        // $pdf = PDF::loadView('ADMIN/hoa-don-PDF', compact('chiTietHoaDon'));//my_view thì là file sẽ xuất cái file dpf
        // return $pdf->stream('DanhMucSanPham.pdf');//nếu muốn tải trực tiếp thì đổi stream thành download -- DanhMucSanPham.pdf chỉ là cái tên muốn đặt sao cũng được
        // }catch (\Exception $e) {
        //     // Xử lý lỗi
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }
        $hoaDon = HoaDon::where('id',$id)->first();
        
            $hoaDon->khach_hang;
        $chiTietHoaDon = ChiTietHoaDon::where('hoa_don_id',$id)->get();
        foreach($chiTietHoaDon as $hd)
        {
            $hd->chi_tiet_san_pham->san_pham;
            
        }
           
            $pdf = PDF::loadView('ADMIN/pdf', compact('hoaDon','chiTietHoaDon'));//my_view thì là file sẽ xuất cái file dpf
            return $pdf->stream('DanhMucSanPham.pdf');//nếu muốn tải trực tiếp thì đổi stream thành download -- DanhMucSanPham.pdf chỉ là cái tên muốn đặt sao cũng được
            
    }
}
