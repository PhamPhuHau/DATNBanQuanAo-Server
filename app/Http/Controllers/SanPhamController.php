<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\NhaCungCap;
use App\models\Loai;
use App\models\Mau;
use App\models\Size;
use App\models\NhapHang;
use App\models\ChiTietNhapHang;
use App\models\SanPham;
use App\models\ChiTietSanPham;
use App\models\HinhAnh;
use Illuminate\Support\Facades\Storage;

class SanPhamController extends Controller
{
    public function view()
    {
        // $san_Pham = SanPham::all();
        $sanPham = SanPham::orderBy('id', 'desc')->with('loai')->with('nha_cung_cap')->paginate(10);

        return view('SANPHAM/danh-sach',compact('sanPham'));
    }

    public function lsNhapHang()
    {
        $nhap_Hang = NhapHang::orderBy('id', 'desc')->paginate(10);
        return view('NHAPHANG/lich-su-nhap-hang',compact('nhap_Hang'));
    }

    public function lsChiTietNhapHang($id)
    {
        $ChiTietNhapHang = ChiTietNhapHang::where('nhap_hang_id',$id)->get();

        return view('NHAPHANG/lich-su-chi-tiet-nhap-hang',compact('ChiTietNhapHang'));
    }

    public function Delete($id)
    {
        $san_Pham=SanPham::find($id);
        if(empty($san_Pham))
        {
            return redirect()->route("san-pham.danh-sach");
        }
        $san_Pham->delete();
        return redirect()->route("san-pham.danh-sach");
    }


    public function themSoLuong()
    {
        $danhSachSanPham = SanPham::all();
        return view('NHAPHANG/nhap-hang-so-luong',compact('danhSachSanPham'));
    }
    public function layThongTinloai(Request $request)
    {
        $sanPham = SanPham::where('id',$request->id)->get();


        foreach ($sanPham as $ctsp) {
    // Kiểm tra xem có thông tin về size không

                // Nếu có, in ra thông tin

                $loai[]=$ctsp->loai;


        }

        return response()->json([
            'success' => true,

            'data' => $sanPham,
            'message' => 'sửa thành công'
        ]);
    }


    public function layThongTinMau(Request $request)
    {
        $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$request->sanPham)->get();
        $size=[];
        $loai=[];
        $mau=[];

        foreach ($chiTietSanPham as $ctsp) {
    // Kiểm tra xem có thông tin về size không
            if ($ctsp->size) {
                // Nếu có, in ra thông tin
                $size[]=$ctsp->size;
                $loai[]=$ctsp->loai;
                $mau[]=$ctsp->mau;
            } else {
                // Nếu không, thông báo lỗi
                dd("Không có thông tin về size");
            }
        }

        return response()->json([
            'success' => true,
            'data' => $chiTietSanPham,
            'message' => 'sửa thành công'
        ]);
    }


    public function layThongTinSize(Request $request)
    {

        $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$request->sanPham)->where('mau_id',$request->mau)->get();
        $size=[];
        $loai=[];
        $mau=[];

        foreach ($chiTietSanPham as $ctsp) {
    // Kiểm tra xem có thông tin về size không
            if ($ctsp->size) {
                // Nếu có, in ra thông tin
                $size[]=$ctsp->size;
                $loai[]=$ctsp->loai;
                $mau[]=$ctsp->mau;
            } else {
                // Nếu không, thông báo lỗi
                dd("Không có thông tin về size");
            }
        }

        return response()->json([
            'success' => true,

            'data' => $chiTietSanPham,
            'message' => 'sửa thành công'
        ]);
    }
    public function layThongTinTen(Request $request)
    {
        $sanPham = SanPham::where('ma',$request->ma)->get();

        return response()->json([
            'success' => true,

            'data' => $sanPham,
            'message' => 'sửa thành công'
        ]);
    }



    public function xuLyThemSoLuong(Request $request)
    {
        $request->validate([
            "san_Pham" => 'required',
            "so_Luong" => 'required',
            "loai" => 'required',
            "mau" => 'required',
            "size" => 'required',
        ], [
            "so_Luong.required" => 'Số lượng không được để trống',
            "san_Pham.required" => 'sản phẩm không được để trống',
            "loai.required" => 'Loại không được để trống',
            "mau.required" => 'Màu không được để trống',
            "size.required" => 'Size không được để trống',
        ]);

        $nhapHang = ChiTietNhapHang::where('san_pham_id',$request->san_Pham)->first();//được dùng để lưu nhà cúng cấp id
        $nhaCungCap = $nhapHang->nhap_hang->nha_cung_cap_id; //được dùg để luu nhà cung cấp id
        $sanPham = SanPham::where('id',$request->san_Pham)->first();//tim san pham
        $sanPham->so_luong += (int)$request->so_Luong;// cap nhat lai so luong san pham


        $nhapHang = new NhapHang(); // tao mới hoá đơn nhập hàng
        $nhapHang->tong_tien = 0; //cho tong_tien bằng 0 để lưu trước
        $nhapHang->nha_cung_cap_id = (int)$nhaCungCap; //lưu nhà cung cấp

        $nhapHang->save();

        $chiTietNhapHang = new ChiTietNhapHang();//tạo mới chi tiết hoá đơn nhập
        $chiTietNhapHang->nhap_hang_id = $nhapHang->id;
        $chiTietNhapHang->san_pham_id = $request->san_Pham;
        $chiTietNhapHang->so_luong = (int)$request->so_Luong;

        if($request->gia_Nhap==null)//nếu người dùng không nhập giá nhập thì giá nhập sẽ lấy của sản phẩm đã lưu
        {
            $chiTietNhapHang->gia_nhap = $sanPham->gia_nhap;
            $chiTietNhapHang->thanh_tien = (int)$request->so_Luong * $sanPham->gia_nhap;//lưu thành tiền
            $nhapHang->tong_tien += (int)$request->so_Luong * $sanPham->gia_nhap;
        }
        else//nếu người dùng đã nhập giá nhập thì sẽ update lại giá của sản phẩm và lưu giá nhập mới vào hoá đơn nhập
        {
             $chiTietNhapHang->gia_nhap = $request->gia_Nhap;
             $sanPham->gia_nhap = $request->gia_Nhap;
             $chiTietNhapHang->thanh_tien = (int)$request->so_Luong * $request->gia_Nhap;
             $nhapHang->tong_tien += (int)$request->so_Luong * $request->gia_Nhap;
        }
        if($request->gia_Ban==null)//nếu người dùng không nhập giá bán thì giá nhập sẽ lấy của sản phẩm đã lưu
        {
            $chiTietNhapHang->gia_ban = $sanPham->gia_ban;


        }
        else //nếu người dùng đã nhập giá nhập thì sẽ update lại giá của sản phẩm và lưu giá nhập mới vào hoá đơn nhập
        {
            $chiTietNhapHang->gia_ban = $request->gia_Ban;
            $sanPham->gia_ban = $request->gia_Ban;
        }
        if($request->thong_Tin)//kiểm tra thông tin có tồn tại chưa nếu có thì update lại thông tin vô sản phẩm
        {
            $sanPham->thong_tin = $request->thong_Tin;
        }

        $chiTietSanPham = ChiTietSanPham::where('san_pham_id', $request->san_Pham)->where('size_id',$request->size)->where('mau_id',$request->mau)->first();
        $chiTietSanPham->so_luong +=  (int)$request->so_Luong;
        $chiTietNhapHang->save();
        $chiTietSanPham->save();
        $nhapHang->save();
        $sanPham->save();
        return redirect()->route('san-pham.danh-sach');

    }
//     public function xuLyThemSoLuong(Request $request)
// {
//     $request->validate([
//         "san_Pham" => 'required',
//         "so_Luong" => 'required',
//         "loai" => 'required',
//         "mau" => 'required',
//         "size" => 'required',
//         // "ma" => 'required', // Thêm mã sản phẩm vào yêu cầu kiểm tra
//     ], [
//         "so_Luong.required" => 'Số lượng không được để trống',
//         "san_Pham.required" => 'Sản phẩm không được để trống',
//         "loai.required" => 'Loại không được để trống',
//         "mau.required" => 'Màu không được để trống',
//         "size.required" => 'Size không được để trống',
//         // "ma.required" => 'Mã sản phẩm không được để trống', // Thông báo khi mã sản phẩm bị bỏ trống
//     ]);

//     $nhapHang = ChiTietNhapHang::where('san_pham_id', $request->san_Pham)->first();
//     $nhaCungCap = $nhapHang->nhap_hang->nha_cung_cap_id;

//     $sanPham = SanPham::where('id', $request->san_Pham)->first();
//     $sanPham->so_luong += (int)$request->so_Luong;

//     $nhapHang = new NhapHang();
//     $nhapHang->tong_tien = 0;
//     $nhapHang->nha_cung_cap_id = (int)$nhaCungCap;
//     $nhapHang->save();

//     $chiTietNhapHang = new ChiTietNhapHang();
//     $chiTietNhapHang->nhap_hang_id = $nhapHang->id;
//     $chiTietNhapHang->san_pham_id = $request->san_Pham;
//     $chiTietNhapHang->so_luong = (int)$request->so_Luong;

//     if ($request->gia_Nhap == null) {
//         $chiTietNhapHang->gia_nhap = 0;
//     } else {
//         $chiTietNhapHang->gia_nhap = (double)$request->gia_Nhap;
//     }

//     if ($request->gia_Ban == null) {
//         $chiTietNhapHang->gia_ban = 0;
//     } else {
//         $chiTietNhapHang->gia_ban = (double)$request->gia_Ban;
//     }

//     $thanhTien = (int)$request->so_Luong * (double)$request->gia_Nhap;
//     $chiTietNhapHang->thanh_tien = $thanhTien;
//     $chiTietNhapHang->save();

//     $nhapHang->tong_tien = $thanhTien;
//     $nhapHang->save();

//     $sanPham->save();

//     $chiTietSanPham = ChiTietSanPham::where('san_pham_id', $request->san_Pham)->where('mau_id', $request->mau)->where('size_id', $request->size)->first();

//     if (empty($chiTietSanPham)) {
//         $chiTietSanPham = new ChiTietSanPham();
//         $chiTietSanPham->san_pham_id = $request->san_Pham;
//         $chiTietSanPham->mau_id = $request->mau;
//         $chiTietSanPham->size_id = $request->size;
//         $chiTietSanPham->so_luong = (int)$request->so_Luong;
//         $chiTietSanPham->save();
//     } else {
//         $chiTietSanPham->so_luong += (int)$request->so_Luong;
//         $chiTietSanPham->save();
//     }

//     return redirect()->route('san-pham.danh-sach');
// }


    public function themMoi()
    {
        $nha_Cung_Cap = NhaCungCap::all();
        $loai = Loai::all();
        $mau = Mau::all();
        $size = Size::all();
        return view('NHAPHANG/danh-sach',compact('nha_Cung_Cap','loai','mau','size'));
    }


//     public function xuLyThemMoi(Request $request)
// {
//     $request->validate([
//         'ma.0' => 'required',
//         'ten.0' => 'required',

//         'nha_cung_cap' => 'required',
//     ], [
//         'ma.0.required' => 'Mã sản phẩm không được để trống',
//         'ten.0.required' => 'Tên sản phẩm không được để trống',

//         'nha_cung_cap.required' => 'Nhà cung cấp không được để trống',
//     ]);

//     $NhapHang = new NhapHang();
//     $NhapHang->tong_tien = 0;
//     $NhapHang->nha_cung_cap_id = (int)$request->nha_cung_cap;
//     $NhapHang->save();

//     $tong_Tien = 0;

//     for ($i = 0; $i < count($request->ten); $i++) {
//         // Kiểm tra xem sản phẩm đã tồn tại trong cơ sở dữ liệu hay chưa
//         $san_Pham = SanPham::where('ma', $request->ma[$i])->first();

//         if (empty($san_Pham)) {
//             // Tạo mới sản phẩm và chi tiết sản phẩm
//             $san_Pham = new SanPham();
//             $san_Pham->ten = $request->ten[$i];
//             $san_Pham->ma = $request->ma[$i];
//             $san_Pham->gia_nhap = (double)$request->gia_Nhap[$i];
//             $san_Pham->gia_ban = (double)$request->gia_Ban[$i];
//             $san_Pham->so_luong = (int)$request->so_Luong[$i];
//             $san_Pham->thong_tin = $request->Thong_Tin[$i];
//             $san_Pham->loai_id = (int)$request->loai[$i];
//             $san_Pham->nha_cung_cap_id = (int)$request->nha_cung_cap;
//             $san_Pham->save();

//             $chi_Tiet_San_Pham = new ChiTietSanPham();
//             $chi_Tiet_San_Pham->san_pham_id = (int)$san_Pham->id;
//             $chi_Tiet_San_Pham->mau_id = (int)$request->mau[$i];
//             $chi_Tiet_San_Pham->size_id = (int)$request->size[$i];
//             $chi_Tiet_San_Pham->so_luong = (int)$request->so_Luong[$i];
//             $chi_Tiet_San_Pham->save();
//         } else {
//             return redirect()->route('san-pham.nhap-hang')->with('thong_bao', 'Mã sản phẩm đã tồn tại');
//         }

//         $thanh_Tien = (double)$request->so_Luong[$i] * (double)$request->gia_Nhap[$i];
//         $tong_Tien += $thanh_Tien;

//         $ChiTietNhapHang = new ChiTietNhapHang();
//         $ChiTietNhapHang->nhap_hang_id = (int)$NhapHang->id;
//         $ChiTietNhapHang->san_pham_id = (int)$san_Pham->id;
//         $ChiTietNhapHang->gia_nhap = (double)$request->gia_Nhap[$i];
//         $ChiTietNhapHang->gia_ban = (double)$request->gia_Ban[$i];
//         $ChiTietNhapHang->so_luong = (int)$request->so_Luong[$i];
//         $ChiTietNhapHang->thanh_tien = (double)$thanh_Tien;
//         $ChiTietNhapHang->save();
//     }

//     $NhapHang->tong_tien += $tong_Tien;
//     $NhapHang->save();
//     return redirect()->route('san-pham.danh-sach');
// }

    public function xuLyThemMoi(Request $request)
{
    $request->validate([
        'ten.0' => 'required',
        'nha_cung_cap' => 'required',
        'ma.0' => 'required', // Thêm mã sản phẩm vào yêu cầu kiểm tra
    ], [
        'ten.0.required' => 'Tên sản phẩm không được để trống',
        'nha_cung_cap.required' => 'Nhà cung cấp không được để trống',
        // 'ma.0.required' => 'Mã sản phẩm không được để trống', // Thông báo khi mã sản phẩm bị bỏ trống
    ]);

    // Tạo mới nhập hàng
    $NhapHang = new NhapHang();
    $NhapHang->tong_tien = 0;
    $NhapHang->nha_cung_cap_id = (int)$request->nha_cung_cap;
    $NhapHang->save();

    $tong_Tien = 0;

    for($i = 0; $i < count($request->ten); $i++){
        $request->validate([
            "so_Luong.{$i}" => 'required',
            "gia_Nhap.{$i}" => 'required',
            "gia_Ban.{$i}" => 'required',
            "loai.{$i}" => 'required',
            "mau.{$i}" => 'required',
            "size.{$i}" => 'required',
            // "ma.{$i}" => 'required', // Thêm mã sản phẩm vào yêu cầu kiểm tra
        ], [
            "so_Luong.{$i}.required" => 'Số lượng không được để trống',
            "gia_Nhap.{$i}.required" => 'Giá nhập không được để trống',
            "gia_Ban.{$i}.required" => 'Giá bán không được để trống',
            "loai.{$i}.required" => 'Loại không được để trống',
            "mau.{$i}.required" => 'Màu không được để trống',
            "size.{$i}.required" => 'Size không được để trống',
            // "ma.{$i}.required" => 'Mã sản phẩm không được để trống', // Thông báo khi mã sản phẩm bị bỏ trống
        ]);

        $thanh_Tien = (double)$request->so_Luong[$i] * (double)$request->gia_Nhap[$i];
        $tong_Tien += $thanh_Tien;

        $san_Pham = SanPham::where('ten', $request->ten[$i])->first();

        if(empty($san_Pham)){
            if($request->so_Luong[$i] == null || $request->gia_Nhap[$i] == null || $request->gia_Ban[$i] == null || $request->loai[$i] == null || $request->mau[$i] == null || $request->size[$i] == null){
                continue;
            }

            $san_Pham = new SanPham();
            $san_Pham->ten = $request->ten[$i];
            $san_Pham->ma = $request->ma[$i];

            $san_Pham->gia_nhap = (double)$request->gia_Nhap[$i];
            $san_Pham->gia_ban = (double)$request->gia_Ban[$i];
            $san_Pham->so_luong = (int)$request->so_Luong[$i];
            $san_Pham->thong_tin = $request->Thong_Tin[$i];
            $san_Pham->loai_id = (int)$request->loai[$i];
            $san_Pham->nha_cung_cap_id = (int)$request->nha_cung_cap;
            // $san_Pham->ma = $request->ma[$i]; // Lưu mã sản phẩm mới
            $san_Pham->save();

            $chi_Tiet_San_Pham = new ChiTietSanPham();
            $chi_Tiet_San_Pham->san_pham_id = (int)$san_Pham->id;
            $chi_Tiet_San_Pham->mau_id = (int)$request->mau[$i];
            $chi_Tiet_San_Pham->size_id = (int)$request->size[$i];
            $chi_Tiet_San_Pham->so_luong = (int)$request->so_Luong[$i];
            $chi_Tiet_San_Pham->save();
        } else {
            $chi_Tiet_San_Pham = ChiTietSanPham::where('san_pham_id',$san_Pham->id)->where('mau_id',$request->mau[$i])->where('size_id',$request->size[$i])->first();

            if(empty($chi_Tiet_San_Pham)) {
                if(!empty($request->Thong_Tin[$i])){
                    $san_Pham->thong_tin = $request->Thong_Tin[$i];
                    $san_Pham->save();
                }
                $chi_Tiet_San_Pham = new ChiTietSanPham();
                $chi_Tiet_San_Pham->san_pham_id = (int)$san_Pham->id;
                $chi_Tiet_San_Pham->mau_id = (int)$request->mau[$i];
                $chi_Tiet_San_Pham->size_id = (int)$request->size[$i];
                $chi_Tiet_San_Pham->so_luong = (int)$request->so_Luong[$i];
                $chi_Tiet_San_Pham->save();
                $san_Pham->so_luong += (int)$request->so_Luong[$i];
                $san_Pham->save();
            } else {
                return redirect()->route('san-pham.nhap-hang')->with('thong_bao', 'Sản phẩm đã tồn tại');
            }
        }

        $ChiTietNhapHang = new ChiTietNhapHang();
        $ChiTietNhapHang->nhap_hang_id = (int)$NhapHang->id;
        $ChiTietNhapHang->san_pham_id = (int)$san_Pham->id;
        $ChiTietNhapHang->gia_nhap = (double)$request->gia_Nhap[$i];
        $ChiTietNhapHang->gia_ban = (double)$request->gia_Ban[$i];
        $ChiTietNhapHang->so_luong = (int)$request->so_Luong[$i];
        $ChiTietNhapHang->thanh_tien = (double)$thanh_Tien;
        $ChiTietNhapHang->save();
    }

    $NhapHang->tong_tien += $tong_Tien;
    $NhapHang->save();
    return redirect()->route('san-pham.danh-sach');
}


    public function view_Chi_Tiet($id)
    {
        $CT_San_Pham = ChiTietSanPham::where('san_pham_id',$id)->get();

        $sanPham = SanPham::where('id',$id)->first();
        $hinh_Anh = HinhAnh::where('san_pham_id',$id)->get();
        return view('SANPHAM/danh-sach-chi-tiet',compact('CT_San_Pham','sanPham','hinh_Anh'));
    }

    public function them_Anh(Request $request,$id)
    {
        $request->validate([
            'HinhAnh'=>'required',

        ],[
            'HinhAnh.required'=>'không được để trống',
        ]);
        $files = $request->HinhAnh;
        if($files)
        {
            foreach ($files as $file) {
                $HinhAnh= new HinhAnh();
                $HinhAnh->url = $file->store('Hinh_Anh');
                $HinhAnh->san_pham_id = $id;
                $HinhAnh->save();
            }
        }
        return redirect()->route('san-pham.chi-tiet-san-pham', $id)->with('success', 'Thêm ảnh thành công');

    }
    public function xoa_Anh($id)
    {
        $hinhAnh = HinhAnh::find($id);

        if ($hinhAnh) {
            Storage::delete($hinhAnh->url);

            $hinhAnh->delete();

            return redirect()->back()->with('success', 'Xóa ảnh thành công');
        }


}
    // public function xu_Ly_Sua(Request $request)
    // {
    //     $request->validate([
    //         'ten'=>'required',
    //         'ma'=>'required'

    //     ],[
    //         'ten.required'=>'không được để trống',
    //         'ma.required'=>'không được để trống',


    //     ]);
    //     $san_Pham = SanPham::where('id',$request->id)->first();
    //     $san_Pham->ten = $request->ten;
    //     $san_Pham->ma = $request->ma;

    //     $san_Pham->save();
    //     return response()->json([
    //         'success' => true,
    //         'message' => 'sửa thành công'
    //     ]);
    // }
    public function xu_Ly_Sua(Request $request)
{
    $request->validate([
        'ten' => 'required',
        'ma' => 'required'
    ], [
        'ten.required' => 'Tên sản phẩm không được để trống',
        'ma.required' => 'Mã sản phẩm không được để trống'
    ]);

    // Kiểm tra xem mã sản phẩm đã tồn tại hay chưa
    $existingProduct = SanPham::where('ma', $request->ma)->where('id', '!=', $request->id)->first();
    if ($existingProduct) {
        return response()->json([
            'success' => false,
            'message' => 'Mã sản phẩm đã tồn tại'
        ]);
    }

    $san_Pham = SanPham::find($request->id);
    if ($san_Pham) {
        $san_Pham->ten = $request->ten;
        $san_Pham->ma = $request->ma;
        $san_Pham->save();
        return response()->json([
            'success' => true,
            'message' => 'Sửa thành công'
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Không tìm thấy sản phẩm'
        ]);
    }
}



//     public function lichSuNhapHang()
// {
//     // Fetch data including 'ma' field
//     $nhap_Hang = NhapHang::with('nha_cung_cap')->paginate(10);

//     return view('ADMIN.lich-su-nhap-hang', compact('nhap_Hang'));
// }

}
