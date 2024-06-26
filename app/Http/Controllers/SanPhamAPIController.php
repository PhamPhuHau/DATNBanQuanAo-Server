<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SanPham;
use App\Models\Loai;
use App\Models\Mau;
use App\Models\Size;
use App\Models\ChatLieu;
use App\Models\KieuDo;

use App\Models\ChiTietSanPham;
use App\Models\SlideShow;


class SanPhamAPIController extends Controller
{
    public function DanhSachSanPham(){
        $sanPham = SanPham::orderBy('id', 'desc')->get();

        foreach($sanPham as $item)
        {
            $item->hinh_anh;

        }
        $slideShow = SlideShow::all();
        return response()->json([
            'success' => true,
            'data' => $sanPham,
            'dataSlideShow' => $slideShow
        ]);
    }

    public function ChiTietSanPham($id){
        $sanPham = SanPham::where('id',$id)->first();
        $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$id)->get();

        $sanPham->nha_cung_cap;
        $sanPham ->hinh_anh;
        foreach ($chiTietSanPham as $ctsp) {

                        // Nếu có, in ra thông tin
            $ctsp->size;
            $ctsp->loai;
            $ctsp->mau;
            $ctsp->chat_lieu;
            $ctsp->kieu_do;

        }


        return response()->json([
            'success' => true,
            'data' => $sanPham,
            'data2' => $chiTietSanPham,
        ]);

    }

    public function TimKiemGiaTang($ten)
    {
        $sanPham = SanPham::where('ten', 'like', '%' . $ten . '%')->orderBy('gia_ban', 'asc')->get();
        foreach($sanPham as $item)
        {
            $item->hinh_anh;
            $item->loai;
        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }

    public function TimKiemGiaGiam($ten)
    {
        $sanPham = SanPham::where('ten', 'like', '%' . $ten . '%')->orderBy('gia_ban', 'desc')->get();
        foreach($sanPham as $item)
        {
            $item->hinh_anh;
            $item->loai;
        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }


    public function TimKiem($ten, request $request)
    {
        if(isset($request->giaTu) && $request->giaDen)
        {
            $sanPham= SanPham::where('ten', 'like', '%' . $ten . '%')->whereBetween('gia_ban', [$request->giaTu, $request->giaDen])->orderBy('id', 'desc')->get();
            foreach($sanPham as $item)
            {
                $item->hinh_anh;
            }
        }
        else{
            $sanPham = SanPham::where('ten','like','%'.$ten.'%')->orderBy('id', 'desc')->get();
            foreach($sanPham as $item)
            {
                $item->hinh_anh;
            }
        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }

    public function LocLoaiSanPham($idLoai, request $request)
    {
        if(isset($request->giaTu) && $request->giaDen)
        {
            $sanPham = SanPham::where('loai_id',$idLoai)->whereBetween('gia_ban', [$request->giaTu, $request->giaDen])->orderBy('id', 'desc')->get();
        }
        else
        {
            $sanPham = SanPham::where('loai_id',$idLoai)->get();
        }


        foreach($sanPham as $item)
        {
            $item->hinh_anh;
            $item->loai;
        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }

    public function GiaTang($id)
    {
        $sanPham = SanPham::orderBy('gia_ban', 'asc')->where('loai_id',$id)->get();
        foreach($sanPham as $item)
        {
            $item->hinh_anh;
            $item->loai;
        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }

    public function GiaGiam($id)
    {
        $sanPham = SanPham::orderBy('gia_ban', 'desc')->where('loai_id',$id)->get();
        foreach($sanPham as $item)
        {
            $item->hinh_anh;
            $item->loai;
        }
        return response()->json([
            'success' => true,
            'data' => $sanPham
        ]);
    }

//     public function KiemTraSoLuong(Request $request)
//     {
//         //tìm màu id
//         $mau = Mau::where('ten',$request->mau)->first();
//         //tìm size id
//         $size = Size::where('ten',$request->size)->first();
//         //tìm sản phẩm id
//         $sanPham = SanPham::where('ten',$request->sanPham)->first();
//         //từ các cái tìm trên lấy chi tiết sản phẩm
//         if($mau && $size && ($sanPham || $request->sanPhamID)){
//             if($sanPham)
//             {
//                 $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$sanPham->id)
//                 ->where('mau_id',$mau->id)->where('size_id',$size->id)->first();
//             }
//             else
//             {
//                 $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$request->sanPhamID)
//                 ->where('mau_id',$mau->id)->where('size_id',$size->id)->first();
//             }


//             if($chiTietSanPham->so_luong)
//             {
//                 if($request->soLuong <= $chiTietSanPham->so_luong)
//                 {
//                     return response()->json([
//                         'success' => true,
//                         'trangThai' => 1,
//                     ]);
//                 }
// //'Đã thêm thành công'
//                 return response()->json([
//                     'success' => true,
//                     'trangThai' => 0,
//                 ]);
//             }
//         }
//         return response()->json([
//             'success' => true,
//             'trangThai' => 0,
//         ]);
//     }
public function KiemTraSoLuong(Request $request)
{
    // Tìm màu id
    $mau = Mau::where('ten', $request->mau)->first();
    // Tìm size id
    $size = Size::where('ten', $request->size)->first();
    // Tìm sản phẩm id
    $sanPham = SanPham::where('ten', $request->sanPham)->first();

    // Từ các thông tin tìm trên, lấy chi tiết sản phẩm
    if ($mau && $size && ($sanPham || $request->sanPhamID)) {
        if ($sanPham) {
            $chiTietSanPham = ChiTietSanPham::where('san_pham_id', $sanPham->id)
                ->where('mau_id', $mau->id)->where('size_id', $size->id)->first();
        } else {
            $chiTietSanPham = ChiTietSanPham::where('san_pham_id', $request->sanPhamID)
                ->where('mau_id', $mau->id)->where('size_id', $size->id)->first();
        }

        // Kiểm tra số lượng có khả dụng
        if ($chiTietSanPham && $chiTietSanPham->so_luong > 0 && $request->soLuong <= $chiTietSanPham->so_luong) {
            return response()->json([
                'success' => true,
                'trangThai' => 1, // Trạng thái cho phép thêm vào giỏ hàng
            ]);
        }
    }

    // Trả về trạng thái không thể thêm vào giỏ hàng
    return response()->json([
        'success' => true,
        'trangThai' => 0,
    ]);
}

}
