<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\NhaCungCap;
use App\models\Loai;
use App\models\ChiTietLoai;

use App\models\Mau;
use App\models\Size;
use App\models\ChatLieu;
use App\models\KieuDo;


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


    // public function themSoLuong()
    // {
    //     $danhSachSanPham = SanPham::all();
    //     return view('NHAPHANG/nhap-hang-so-luong',compact('danhSachSanPham'));
    // }


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

    public function layThongTinChiTietLoai(Request $request)
    {
        $chiTietLoai = ChiTietLoai::where('loai_id', $request->loai)->get();
        $chiTietLoaiArray = [];

        foreach ($chiTietLoai as $ctl) {
            $chiTietLoaiArray[] = $ctl;
        }

        return response()->json([
            'success' => true,
            'data' => $chiTietLoaiArray,
            'message' => 'Lấy thông tin chi tiết loại thành công'
        ]);
    }


    public function layThongTinMau(Request $request)
    {
        $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$request->sanPham)->get();
        $size=[];
        $loai=[];
        $mau=[];
        $chat_lieu=[];
        $kieu_do=[];


        foreach ($chiTietSanPham as $ctsp) {
    // Kiểm tra xem có thông tin về size không
            if ($ctsp->size) {
                // Nếu có, in ra thông tin
                $size[]=$ctsp->size;
                $loai[]=$ctsp->loai;
                $mau[]=$ctsp->mau;
                $chat_lieu[]=$ctsp->chat_lieu;
                $kieu_do[]=$ctsp->kieu_do;

            } else {
                // Nếu không, thông báo lỗi
                dd("Không có thông tin về màu");
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
        $chat_lieu=[];
        $kieu_do=[];



        foreach ($chiTietSanPham as $ctsp) {
    // Kiểm tra xem có thông tin về size không
            if ($ctsp->size) {
                // Nếu có, in ra thông tin
                $size[]=$ctsp->size;
                $loai[]=$ctsp->loai;
                $mau[]=$ctsp->mau;
                $chat_lieu[]=$ctsp->chat_lieu;
                $kieu_do[]=$ctsp->kieu_do;


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

    public function layThongTinSanPhamChatLieu(Request $request)
{
    $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$request->sanPham)->get();
        $size=[];
        $loai=[];
        $mau=[];
        $chat_lieu=[];
        $kieu_do=[];


        foreach ($chiTietSanPham as $ctsp) {
    // Kiểm tra xem có thông tin về size không
            if ($ctsp->size) {
                // Nếu có, in ra thông tin
                $size[]=$ctsp->size;
                $loai[]=$ctsp->loai;
                $mau[]=$ctsp->mau;
                $chat_lieu[]=$ctsp->chat_lieu;
                $kieu_do[]=$ctsp->kieu_do;

            } else {
                // Nếu không, thông báo lỗi
                dd("Không có thông tin về chất liệu");
            }
        }

        return response()->json([
            'success' => true,
            'data' => $chiTietSanPham,
            'message' => 'sửa thành công'
        ]);
}

public function layThongTinSanPhamKieuDo(Request $request)
{
    $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$request->sanPham)->get();
    $size=[];
    $loai=[];
    $mau=[];
    $chat_lieu=[];
    $kieu_do=[];


    foreach ($chiTietSanPham as $ctsp) {
// Kiểm tra xem có thông tin về size không
        if ($ctsp->size) {
            // Nếu có, in ra thông tin
            $size[]=$ctsp->size;
            $loai[]=$ctsp->loai;
            $mau[]=$ctsp->mau;
            $chat_lieu[]=$ctsp->chat_lieu;
            $kieu_do[]=$ctsp->kieu_do;

        } else {
            // Nếu không, thông báo lỗi
            dd("Không có thông tin về kiểu đồ");
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

    public function xoaChiTietSanPham($id)
    {
        try {
            $chiTietSanPham = ChiTietSanPham::findOrFail($id);
            $soLuongXoa = $chiTietSanPham->so_luong; // Lấy số lượng của chi tiết sản phẩm

            // Xóa chi tiết sản phẩm
            $chiTietSanPham->delete();

            // Cập nhật lại số lượng sản phẩm chính
            $sanPham = SanPham::findOrFail($chiTietSanPham->san_pham_id);
            $sanPham->so_luong -= $soLuongXoa; // Giảm số lượng đi số lượng của chi tiết sản phẩm đã xóa
            $sanPham->save();

            return redirect()->back()->with('success', 'Xóa chi tiết sản phẩm thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Xóa chi tiết sản phẩm thất bại: ' . $e->getMessage());
        }
    }
    public function themSoLuong(Request $request, $id)
    {
        $request->validate([
            'so_luong_them' => 'required|integer|min:1',
            'gia_nhap' => 'nullable|numeric|min:0',
            'gia_ban' => 'nullable|numeric|min:0',
        ], [
            'so_luong_them.required' => 'Số lượng thêm không được để trống',
            'so_luong_them.integer' => 'Số lượng thêm phải là số nguyên',
            'so_luong_them.min' => 'Số lượng thêm phải lớn hơn 0',
            'gia_nhap.numeric' => 'Giá nhập phải là số',
            'gia_nhap.min' => 'Giá nhập phải lớn hơn hoặc bằng 0',
            'gia_ban.numeric' => 'Giá bán phải là số',
            'gia_ban.min' => 'Giá bán phải lớn hơn hoặc bằng 0',
        ]);

        $chi_tiet_san_pham = ChiTietSanPham::find($id);
        if ($chi_tiet_san_pham) {
            // Tăng số lượng sản phẩm chính theo số lượng mới thêm vào
            $san_pham = $chi_tiet_san_pham->san_pham;
            $san_pham->so_luong += $request->input('so_luong_them');

            // Cập nhật số lượng cho chi tiết sản phẩm
            $chi_tiet_san_pham->so_luong += $request->input('so_luong_them');

            // Tìm nhà cung cấp thông qua sản phẩm nhập hàng trước đó
            $nhapHangTruocDo = ChiTietNhapHang::where('san_pham_id', $san_pham->id)->first();
            $nhaCungCapId = $nhapHangTruocDo ? $nhapHangTruocDo->nha_cung_cap_id : null;

            // Tạo hóa đơn nhập hàng mới
            $nhapHang = new NhapHang();
            $nhapHang->tong_tien = 0; // Đặt tạm thời tổng tiền bằng 0
            $nhapHang->save();

            // Tạo chi tiết nhập hàng mới
            $chiTietNhapHang = new ChiTietNhapHang();
            $chiTietNhapHang->nhap_hang_id = $nhapHang->id;
            $chiTietNhapHang->san_pham_id = $san_pham->id;
            $chiTietNhapHang->nha_cung_cap_id = $nhaCungCapId;
            $chiTietNhapHang->so_luong = $request->input('so_luong_them');

            // Cập nhật giá nhập và giá bán
            if ($request->input('gia_nhap')) {
                $chiTietNhapHang->gia_nhap = $request->input('gia_nhap');
                $san_pham->gia_nhap = $request->input('gia_nhap');
            } else {
                $chiTietNhapHang->gia_nhap = $san_pham->gia_nhap;
            }

            if ($request->input('gia_ban')) {
                $chiTietNhapHang->gia_ban = $request->input('gia_ban');
                $san_pham->gia_ban = $request->input('gia_ban');
            } else {
                $chiTietNhapHang->gia_ban = $san_pham->gia_ban;
            }

            // Tính toán thành tiền và tổng tiền
            $chiTietNhapHang->thanh_tien = $chiTietNhapHang->so_luong * $chiTietNhapHang->gia_nhap;
            $nhapHang->tong_tien += $chiTietNhapHang->thanh_tien;

            // Lưu chi tiết nhập hàng và cập nhật lại hóa đơn nhập hàng
            $chiTietNhapHang->save();
            $nhapHang->tong_tien = $chiTietNhapHang->thanh_tien;
            $nhapHang->save();

            // Lưu cập nhật sản phẩm và chi tiết sản phẩm
            $san_pham->save();
            $chi_tiet_san_pham->save();

            return redirect()->back()->with('success', 'Số lượng sản phẩm đã được cập nhật và hóa đơn nhập hàng đã được tạo.');
        }
        return redirect()->back()->with('error', 'Không tìm thấy sản phẩm chi tiết.');
    }




    // public function xuLyThemSoLuong(Request $request)
    // {
    //     $request->validate([
    //         "san_Pham" => 'required',
    //         "so_Luong" => 'required',
    //         "loai" => 'required',
    //         "mau" => 'required',
    //         "size" => 'required',
    //     ], [
    //         "so_Luong.required" => 'Số lượng không được để trống',
    //         "san_Pham.required" => 'sản phẩm không được để trống',
    //         "loai.required" => 'Loại không được để trống',
    //         "mau.required" => 'Màu không được để trống',
    //         "size.required" => 'Size không được để trống',
    //     ]);

    //     $nhapHang = ChiTietNhapHang::where('san_pham_id',$request->san_Pham)->first();//được dùng để lưu nhà cúng cấp id
    //     $nhaCungCap = $nhapHang->nhap_hang->nha_cung_cap_id; //được dùg để luu nhà cung cấp id
    //     $sanPham = SanPham::where('id',$request->san_Pham)->first();//tim san pham
    //     $sanPham->so_luong += (int)$request->so_Luong;// cap nhat lai so luong san pham


    //     $nhapHang = new NhapHang(); // tao mới hoá đơn nhập hàng
    //     $nhapHang->tong_tien = 0; //cho tong_tien bằng 0 để lưu trước
    //     // $nhapHang->nha_cung_cap_id = (int)$nhaCungCap; //lưu nhà cung cấp

    //     $nhapHang->save();

    //     $chiTietNhapHang = new ChiTietNhapHang();//tạo mới chi tiết hoá đơn nhập
    //     $chiTietNhapHang->nhap_hang_id = $nhapHang->id;
    //     $chiTietNhapHang->san_pham_id = $request->san_Pham;
    //     $chiTietNhapHang->nha_cung_cap_id = (int)$nhaCungCap; //lưu nhà cung cấp

    //     $chiTietNhapHang->so_luong = (int)$request->so_Luong;

    //     if($request->gia_Nhap==null)//nếu người dùng không nhập giá nhập thì giá nhập sẽ lấy của sản phẩm đã lưu
    //     {
    //         $chiTietNhapHang->gia_nhap = $sanPham->gia_nhap;
    //         $chiTietNhapHang->thanh_tien = (int)$request->so_Luong * $sanPham->gia_nhap;//lưu thành tiền
    //         $nhapHang->tong_tien += (int)$request->so_Luong * $sanPham->gia_nhap;
    //     }
    //     else//nếu người dùng đã nhập giá nhập thì sẽ update lại giá của sản phẩm và lưu giá nhập mới vào hoá đơn nhập
    //     {
    //          $chiTietNhapHang->gia_nhap = $request->gia_Nhap;
    //          $sanPham->gia_nhap = $request->gia_Nhap;
    //          $chiTietNhapHang->thanh_tien = (int)$request->so_Luong * $request->gia_Nhap;
    //          $nhapHang->tong_tien += (int)$request->so_Luong * $request->gia_Nhap;
    //     }
    //     if($request->gia_Ban==null)//nếu người dùng không nhập giá bán thì giá nhập sẽ lấy của sản phẩm đã lưu
    //     {
    //         $chiTietNhapHang->gia_ban = $sanPham->gia_ban;


    //     }
    //     else //nếu người dùng đã nhập giá nhập thì sẽ update lại giá của sản phẩm và lưu giá nhập mới vào hoá đơn nhập
    //     {
    //         $chiTietNhapHang->gia_ban = $request->gia_Ban;
    //         $sanPham->gia_ban = $request->gia_Ban;
    //     }
    //     if($request->thong_Tin)//kiểm tra thông tin có tồn tại chưa nếu có thì update lại thông tin vô sản phẩm
    //     {
    //         $sanPham->thong_tin = $request->thong_Tin;
    //     }

    //     $chiTietSanPham = ChiTietSanPham::where('san_pham_id', $request->san_Pham)->where('size_id',$request->size)->where('mau_id',$request->mau)->first();
    //     $chiTietSanPham->so_luong +=  (int)$request->so_Luong;
    //     $chiTietNhapHang->save();
    //     $chiTietSanPham->save();
    //     $nhapHang->save();
    //     $sanPham->save();
    //     return redirect()->route('san-pham.danh-sach');

    // }
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
        $chi_tiet_loai = ChiTietLoai::all();

        $mau = Mau::all();
        $size = Size::all();
        $chat_lieu = ChatLieu::all();
        $kieu_do = KieuDo::all();

        return view('NHAPHANG/danh-sach',compact('nha_Cung_Cap','loai','chi_tiet_loai','mau','size','chat_lieu','kieu_do'));
    }




    public function xuLyThemMoi(Request $request)
{
    $request->validate([
        'ten.*' => 'required',
        'nha_cung_cap' => 'required',
        'ma.*' => 'required',
        'loai.*' => 'required',
        'chi_tiet_loai.*' => 'required',

        'mau.*' => 'required',
        'size.*' => 'required',
        'chat_lieu.*' => 'required',
        'kieu_do.*' => 'required',
        'so_Luong.*' => 'required',
        'gia_Nhap.*' => 'required',
        'gia_Ban.*' => 'required',
    ], [
        'ten.*.required' => 'Tên sản phẩm không được để trống',
        'nha_cung_cap.required' => 'Nhà cung cấp không được để trống',
        'ma.*.required' => 'Mã sản phẩm không được để trống',
        'loai.*.required' => 'Loại không được để trống',
        'chi_tiet_loai.*.required' => 'Chi tiết loại không được để trống',

        'mau.*.required' => 'Màu không được để trống',
        'size.*.required' => 'Size không được để trống',
        'chat_lieu.*.required' => 'Chất liệu không được để trống',
        'kieu_do.*.required' => 'Kiểu dồ không được để trống',
        'so_Luong.*.required' => 'Số lượng không được để trống',
        'gia_Nhap.*.required' => 'Giá nhập không được để trống',
        'gia_Ban.*.required' => 'Giá bán không được để trống',
    ]);
    $nhapHang = new NhapHang();
    $nhapHang->tong_tien = 0;
    $tong_Tien = 0;

    for ($i = 0; $i < count($request->ten); $i++) {
        $thanh_Tien = (double)$request->so_Luong[$i] * (double)$request->gia_Nhap[$i];
        $tong_Tien += $thanh_Tien;

        // Tìm sản phẩm theo mã, tên và nhà cung cấp
        $sanPham = SanPham::where('ten', $request->ten[$i])
            ->where('ma', $request->ma[$i])
            ->where('nha_cung_cap_id', $request->nha_cung_cap[$i])
            ->where('loai_id', $request->loai[$i])
            ->where('chi_tiet_loai_id', $request->chi_tiet_loai[$i])

            ->first();

        if ($sanPham) {
            // Nếu sản phẩm đã tồn tại, kiểm tra chi tiết sản phẩm
            $chiTietSanPham = ChiTietSanPham::where('san_pham_id', $sanPham->id)
                ->where('mau_id', $request->mau[$i])
                ->where('size_id', $request->size[$i])
                ->where('chat_lieu_id', $request->chat_lieu[$i])
                ->where('kieu_do_id', $request->kieu_do[$i])
                ->first();

            if ($chiTietSanPham) {
                // Nếu cả sản phẩm và chi tiết sản phẩm đã tồn tại, thông báo lỗi
                return redirect()->route('san-pham.nhap-hang')->with('thong_bao','Sản phẩm đã tồn tại');
            } else {
                // Nếu chỉ sản phẩm đã tồn tại, cập nhật số lượng
                $sanPham->so_luong += (int)$request->so_Luong[$i];
                $sanPham->save();
            }
        } else {
            // Nếu sản phẩm chưa tồn tại, tạo mới
            $sanPham = new SanPham();
            $sanPham->ten = $request->ten[$i];
            $sanPham->ma = $request->ma[$i];
            $sanPham->gia_nhap = (double)$request->gia_Nhap[$i];
            $sanPham->gia_ban = (double)$request->gia_Ban[$i];
            $sanPham->so_luong = (int)$request->so_Luong[$i];
            $sanPham->loai_id = (int)$request->loai[$i];
            $sanPham->chi_tiet_loai_id = (int)$request->chi_tiet_loai[$i];
            $sanPham->nha_cung_cap_id = (int)$request->nha_cung_cap[$i];
            $sanPham->save();
        }
        $nhapHang->save();

        // Tạo mới chi tiết sản phẩm
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = (int)$request->mau[$i];
        $chiTietSanPham->size_id = (int)$request->size[$i];
        $chiTietSanPham->chat_lieu_id = (int)$request->chat_lieu[$i];
        $chiTietSanPham->kieu_do_id = (int)$request->kieu_do[$i];
        $chiTietSanPham->so_luong = (int)$request->so_Luong[$i];
        $chiTietSanPham->save();

        // Tạo mới nhập hàng


        // Tạo mới chi tiết nhập hàng
        $chiTietNhapHang = new ChiTietNhapHang();
        $chiTietNhapHang->nhap_hang_id = $nhapHang->id;
        $chiTietNhapHang->san_pham_id = $sanPham->id;
        $chiTietNhapHang->nha_cung_cap_id = (int)$request->nha_cung_cap;
        $chiTietNhapHang->gia_nhap = (double)$request->gia_Nhap[$i];
        $chiTietNhapHang->gia_ban = (double)$request->gia_Ban[$i];
        $chiTietNhapHang->so_luong = (int)$request->so_Luong[$i];
        $chiTietNhapHang->thanh_tien = (double)$thanh_Tien;
        $chiTietNhapHang->save();
    }

    // Cập nhật tổng tiền cho nhập hàng
    $nhapHang->tong_tien += $tong_Tien;
    $nhapHang->save();

    return redirect()->route('san-pham.danh-sach')->with('thong_bao', 'Thêm sản phẩm thành công.');
}





//     public function xuLyThemMoi(Request $request)
// {
//     $request->validate([
//         'ten.0' => 'required',
//         'nha_cung_cap' => 'required',
//         'ma.0' => 'required', // Thêm mã sản phẩm vào yêu cầu kiểm tra
//     ], [
//         'ten.0.required' => 'Tên sản phẩm không được để trống',
//         'nha_cung_cap.required' => 'Nhà cung cấp không được để trống',
//         'ma.0.required' => 'Mã sản phẩm không được để trống', // Thông báo khi mã sản phẩm bị bỏ trống
//     ]);

//     // Tạo mới nhập hàng
//     $NhapHang = new NhapHang();
//     $NhapHang->tong_tien = 0;
//     // $NhapHang->nha_cung_cap_id = (int)$request->nha_cung_cap;
//     $NhapHang->save();

//     $tong_Tien = 0;

//     for($i = 0; $i < count($request->ten); $i++){
//         $request->validate([

//             "so_Luong.{$i}" => 'required',
//             "gia_Nhap.{$i}" => 'required',
//             "gia_Ban.{$i}" => 'required',
//             "loai.{$i}" => 'required',
//             "mau.{$i}" => 'required',
//             "size.{$i}" => 'required',
//             "chat_lieu.{$i}" => 'required',
//             "kieu_do.{$i}" => 'required',



//             // "ma.{$i}" => 'required', // Thêm mã sản phẩm vào yêu cầu kiểm tra
//         ], [
//             "so_Luong.{$i}.required" => 'Số lượng không được để trống',
//             "gia_Nhap.{$i}.required" => 'Giá nhập không được để trống',
//             "gia_Ban.{$i}.required" => 'Giá bán không được để trống',
//             "loai.{$i}.required" => 'Loại không được để trống',
//             "mau.{$i}.required" => 'Màu không được để trống',
//             "size.{$i}.required" => 'Size không được để trống',
//             "chat_lieu.{$i}.required" => 'Chất liệu không được để trống',
//             "kieu_do.{$i}.required" => 'Kiểu dồ không được để trống',


//             // "ma.{$i}.required" => 'Mã sản phẩm không được để trống', // Thông báo khi mã sản phẩm bị bỏ trống
//         ]);

//         $thanh_Tien = (double)$request->so_Luong[$i] * (double)$request->gia_Nhap[$i];
//         $tong_Tien += $thanh_Tien;

//         $san_Pham = SanPham::where('ten', $request->ten[$i])->first();

//         if(empty($san_Pham)){
//             if($request->so_Luong[$i] == null || $request->gia_Nhap[$i] == null || $request->gia_Ban[$i] == null || $request->loai[$i] == null || $request->chat_lieu[$i] == null || $request->kieu_do[$i] == null|| $request->mau[$i] == null || $request->size[$i] == null ){
//                 continue;
//             }

//             $san_Pham = new SanPham();
//             $san_Pham->ten = $request->ten[$i];
//             $san_Pham->ma = $request->ma[$i];

//             $san_Pham->gia_nhap = (double)$request->gia_Nhap[$i];
//             $san_Pham->gia_ban = (double)$request->gia_Ban[$i];
//             $san_Pham->so_luong = (int)$request->so_Luong[$i];
//             $san_Pham->thong_tin = $request->Thong_Tin[$i];
//             $san_Pham->loai_id = (int)$request->loai[$i];
//             $san_Pham->chi_tiet_loai_id = (int)$request->chi_tiet_loai[$i];

//             $san_Pham->nha_cung_cap_id = (int)$request->nha_cung_cap;
//             // $san_Pham->ma = $request->ma[$i]; // Lưu mã sản phẩm mới
//             $san_Pham->save();

//             $chi_Tiet_San_Pham = new ChiTietSanPham();
//             $chi_Tiet_San_Pham->san_pham_id = (int)$san_Pham->id;
//             $chi_Tiet_San_Pham->mau_id = (int)$request->mau[$i];
//             $chi_Tiet_San_Pham->size_id = (int)$request->size[$i];
//             $chi_Tiet_San_Pham->chat_lieu_id = (int)$request->chat_lieu[$i];
//             $chi_Tiet_San_Pham->kieu_do_id = (int)$request->kieu_do[$i];

//             $chi_Tiet_San_Pham->so_luong = (int)$request->so_Luong[$i];
//             $chi_Tiet_San_Pham->save();
//         } else {
//             $chi_Tiet_San_Pham = ChiTietSanPham::where('san_pham_id',$san_Pham->id)->where('mau_id',$request->mau[$i])->where('size_id',$request->size[$i])->where('chat_lieu_id',$request->chat_lieu[$i])->where('kieu_do_id',$request->kieu_do[$i])->first();

//             if(empty($chi_Tiet_San_Pham)) {
//                 if(!empty($request->Thong_Tin[$i])){
//                     $san_Pham->thong_tin = $request->Thong_Tin[$i];
//                     $san_Pham->save();
//                 }
//                 $chi_Tiet_San_Pham = new ChiTietSanPham();
//                 $chi_Tiet_San_Pham->san_pham_id = (int)$san_Pham->id;
//                 $chi_Tiet_San_Pham->mau_id = (int)$request->mau[$i];
//                 $chi_Tiet_San_Pham->size_id = (int)$request->size[$i];
//                 $chi_Tiet_San_Pham->chat_lieu_id = (int)$request->chat_lieu[$i];
//                 $chi_Tiet_San_Pham->kieu_do_id = (int)$request->kieu_do[$i];
//                 $chi_Tiet_San_Pham->so_luong = (int)$request->so_Luong[$i];
//                 $chi_Tiet_San_Pham->save();
//                 $san_Pham->so_luong += (int)$request->so_Luong[$i];
//                 $san_Pham->save();
//             } else {
//                 return redirect()->route('san-pham.nhap-hang')->with('thong_bao', 'Sản phẩm đã tồn tại');
//             }
//         }

//         $ChiTietNhapHang = new ChiTietNhapHang();
//         $ChiTietNhapHang->nhap_hang_id = (int)$NhapHang->id;
//         $ChiTietNhapHang->san_pham_id = (int)$san_Pham->id;
//         $ChiTietNhapHang->nha_cung_cap_id = (int)$NhapHang->id;

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
    // Validate input data
    $request->validate([
        'ten' => 'required',
        'ma' => 'required',
        'gia_nhap' => 'required|numeric|min:0',
        'gia_ban' => 'required|numeric|min:0',
    ], [
        'ten.required' => 'Tên sản phẩm không được để trống',
        'ma.required' => 'Mã sản phẩm không được để trống',
        'gia_nhap.required' => 'Giá nhập không được để trống',
        'gia_nhap.numeric' => 'Giá nhập phải là một số',
        'gia_nhap.min' => 'Giá nhập phải lớn hơn hoặc bằng 0',
        'gia_ban.required' => 'Giá bán không được để trống',
        'gia_ban.numeric' => 'Giá bán phải là một số',
        'gia_ban.min' => 'Giá bán phải lớn hơn hoặc bằng 0',
    ]);

    // Kiểm tra xem mã sản phẩm đã tồn tại hay chưa
    $existingProduct = SanPham::where('ma', $request->ma)->where('id', '!=', $request->id)->first();
    if ($existingProduct) {
        return response()->json([
            'success' => false,
            'message' => 'Mã sản phẩm đã tồn tại'
        ]);
    }

    // Tìm sản phẩm cần sửa
    $san_Pham = SanPham::find($request->id);
    if ($san_Pham) {
        // Cập nhật thông tin sản phẩm
        $san_Pham->ten = $request->ten;
        $san_Pham->ma = $request->ma;
        $san_Pham->gia_nhap = $request->gia_nhap;
        $san_Pham->gia_ban = $request->gia_ban;
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
public function capNhatThongTin(Request $request, $id)
{
    $request->validate([
        'thong_tin' => 'required|string',
    ], [
        'thong_tin.required' => 'Thông tin không được để trống',
    ]);

    $sanPham = SanPham::find($id);
    if ($sanPham) {
        $sanPham->thong_tin = $request->input('thong_tin');
        $sanPham->save();

        return redirect()->back()->with('success', 'Thông tin sản phẩm đã được cập nhật.');
    }
    return redirect()->back()->with('error', 'Không tìm thấy sản phẩm.');
}



}
