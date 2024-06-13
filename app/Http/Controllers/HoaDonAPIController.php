<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\ChiTietSanPham;
use App\Models\SanPham;
use App\Models\Mau;
use App\Models\Size;
use Illuminate\Support\Str;

class HoaDonAPIController extends Controller
{
    public function TrangThaiThanhToan(Request $request)
    {
        //hàm này có tác dụng là bên reactjs sẽ gọi tự động khi đã thanh toán ngân hàng thành công
        //chuyển trạng thái thanh toán từ 0 thành 1
        //sao đó sẽ update lại số lượng sản phẩm vì trước đó trong hàm ThanhToan chỉ có tạo mới chứ chưa có giảm số lượng
        if($request->ma)
        {
            $hoaDon = HoaDon::where('id', $request->ma)->first();
            $hoaDon->trang_thai_thanh_toan = 1;
            $hoaDon->save();
        }
        else
        {
            $hoaDon = HoaDon::orderByDesc('id')->first();
            $hoaDon->trang_thai_thanh_toan = 1;
            $hoaDon->save();
        }

        $chiTietHoaDon = ChiTietHoaDon::where('hoa_don_id',$hoaDon->id)->get();
        foreach($chiTietHoaDon as $ChiTietHoaDon)
        {
            $chiTietSanPham = ChiTietSanPham::where('id', $ChiTietHoaDon->chi_tiet_san_pham_id)->with('san_pham')->first();
            $sanPham = SanPham::where('id', $chiTietSanPham->san_pham->id)->first();
            $chiTietSanPham->so_luong -= $ChiTietHoaDon->so_luong;
            $chiTietSanPham->save();
            $sanPham->so_luong -= $ChiTietHoaDon->so_luong;
            $sanPham->save();

        }

        return response()->json([

            "success"=>true,
            "message"=>"thành công",
            "data"=>$hoaDon->id,

        ]);
    }

//     public function TrangThaiThanhToan(Request $request)
// {
//     try {
//         $hoaDonId = $request->ma ?? HoaDon::orderByDesc('id')->first()->id;
//         $hoaDon = HoaDon::find($hoaDonId);
//         if (!$hoaDon) {
//             return response()->json(["success" => false, "message" => "Order not found"], 404);
//         }

//         $hoaDon->trang_thai_thanh_toan = 1;
//         $hoaDon->save();

//         $chiTietHoaDon = ChiTietHoaDon::where('hoa_don_id', $hoaDon->id)->get();
//         foreach ($chiTietHoaDon as $ChiTietHoaDon) {
//             $chiTietSanPham = ChiTietSanPham::with('san_pham')->find($ChiTietHoaDon->chi_tiet_san_pham_id);
//             if ($chiTietSanPham) {
//                 $sanPham = SanPham::find($chiTietSanPham->san_pham->id);
//                 if ($sanPham) {
//                     $chiTietSanPham->so_luong -= $ChiTietHoaDon->so_luong;
//                     $chiTietSanPham->save();
//                     $sanPham->so_luong -= $ChiTietHoaDon->so_luong;
//                     $sanPham->save();
//                 }
//             }
//         }

//         return response()->json(["success" => true, "message" => "thành công", "data" => $hoaDon->id]);
//     } catch (\Exception $e) {
//         Log::error('Error in TrangThaiThanhToan:', ['exception' => $e]);
//         return response()->json(["success" => false, "message" => $e->getMessage()], 500);
//     }
// }


    public function ThanhToan(Request $request)
    {

       $NgauNhien = now()->year. now()->month. now()->day . now()->hour. rand(0,9999);

        // Trả về response JSON cho client (có thể thay đổi tùy vào logic của bạn)
        for ($i = 0; $i < count($request->ten); $i++) {

            $mau = Mau::where('ten',$request->mau[$i])->first();



            $size = Size::where('ten',$request->size[$i])->first();

            $sanPham = SanPham::where('ten',$request->ten[$i])->first();
            // dd(1);

            $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$sanPham->id)

            ->where('mau_id',$mau->id)

            ->where('size_id',$size->id)->first();
        // Assuming so_luong is a single value, remove [i] index

        if ($chiTietSanPham->so_luong < $request->so_luong[$i]) {

            return response()->json(['errors' => 'Vui lòng giảm số lượng '. $request->ten[$i] . ', màu '
            . $request->mau[$i] .', size '. $request->size[$i]], 422);
        }
        }


        //tạo mới hoá đơn
        $hoaDon = new HoaDon();
        $hoaDon->khach_hang_id = $request->khach_hang;
        $hoaDon->tien_ship = $request->tien_ship;
        $hoaDon->tong_tien = $request->tong_tien;
        $hoaDon->ma = $NgauNhien;
        // $hoaDon->trang_thai_thanh_toan = 0;

        if($request->PhuongThucThanhToan==1)
        {

            $hoaDon->phuong_thuc_thanh_toan = "Thanh toán khi nhận hàng";

        }
        else
        {

            $hoaDon->phuong_thuc_thanh_toan = "Thanh toán qua Ngân hàng NCB";
        }

        $hoaDon->trang_thai = 1;


        // $hoaDon->save();
        // dd(1);




        $hoaDon->save();
        for($i = 0; $i < count($request->ten) ; $i++){

            $mau = Mau::where('ten',$request->mau[$i])->first();
            $size = Size::where('ten',$request->size[$i])->first();
            $sanPham = SanPham::where('ten',$request->ten[$i])->first();
            $chiTietSanPham = ChiTietSanPham::where('san_pham_id',$sanPham->id)->where('mau_id',$mau->id)->where('size_id',$size->id)->first();

            if($chiTietSanPham)
            {
                $chiTietHoaDon = new ChiTietHoaDon();
                $chiTietHoaDon->hoa_don_id = $hoaDon->id;
                $chiTietHoaDon->chi_tiet_san_pham_id = $chiTietSanPham->id;
                $chiTietHoaDon->so_luong = (int)$request->so_luong[$i];
                $chiTietHoaDon->thanh_tien =  (int) $request->so_luong[$i] * $request->gia[$i] ;
                $chiTietHoaDon->save();

                if($request->PhuongThucThanhToan==1)
                {
                    $chiTietSanPham->so_luong -= $request->so_luong[$i];
                    $chiTietSanPham->save();
                    $sanPham->so_luong -= $request->so_luong[$i];
                    $sanPham->save();
                }

            }
        }

        if($request->PhuongThucThanhToan == 2)
        {
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://localhost:3000/ThanhToan";
            $vnp_TmnCode = "AJ5OA62P";//Mã website tại VNPAY
            $vnp_HashSecret = "FQIXOHHXXCKXLGGXOIWERHWOARBOIGGA"; //Chuỗi bí mật

            $vnp_TxnRef = $NgauNhien; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = "abc";
            $vnp_OrderType = "billpayment";
            $vnp_Amount = $hoaDon->tong_tien * 100;
            $vnp_Locale = "vn";
            $vnp_BankCode = "ncb";
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }

            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }

            //truyền thông tin vào hoá đơn
            return response()->json([
                "success"=>true,
                "message"=>"thành công",
                'url' => $vnp_Url,
                "data"=>$hoaDon->id,
            ]);
        }




        return response()->json([

            "success"=>true,
            "message"=>"thành công",
            "data"=>$hoaDon->id,

        ]);
        return response()->json([
            "success" => true,
            "message" => "thành công",
            "data" => $hoaDon->id,
        ]);


    }

    // public function ThanhToan(Request $request)
    // {

    //     $validator = Validator::make($request->all(), [
    //         'khach_hang' => 'required|integer',
    //         'tong_tien' => 'required|numeric',
    //         'mau' => 'required|array',
    //         'tien_ship' => 'required|numeric',
    //         'size' => 'required|array',
    //         'so_luong' => 'required|array',
    //         'gia' => 'required|array',
    //         'ten' => 'required|array',
    //         'PhuongThucThanhToan' => 'required|integer',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             "success" => false,
    //             "message" => "Validation error",
    //             "errors" => $validator->errors()
    //         ], 422);
    //     }

    //     try {

    //         $NgauNhien = now()->year . now()->month . now()->day . now()->hour . rand(0, 9999);

    //         for ($i = 0; $i < count($request->ten); $i++) {
    //             $mau = Mau::where('ten', $request->mau[$i])->first();
    //             $size = Size::where('ten', $request->size[$i])->first();
    //             $sanPham = SanPham::where('ten', $request->ten[$i])->first();
    //             $chiTietSanPham = ChiTietSanPham::where('san_pham_id', $sanPham->id)
    //                 ->where('mau_id', $mau->id)
    //                 ->where('size_id', $size->id)
    //                 ->first();

    //             if ($chiTietSanPham->so_luong < $request->so_luong[$i]) {
    //                 return response()->json(['errors' => 'Vui lòng giảm số lượng ' . $request->ten[$i] . ', màu ' . $request->mau[$i] . ', size ' . $request->size[$i]], 422);
    //             }
    //         }

    //         // Create new HoaDon
    //         $hoaDon = new HoaDon();
    //         $hoaDon->khach_hang_id = $request->khach_hang;
    //         $hoaDon->tien_ship = $request->tien_ship;
    //         $hoaDon->tong_tien = $request->tong_tien;
    //         $hoaDon->trang_thai_thanh_toan = 0;
    //         $hoaDon->phuong_thuc_thanh_toan = $request->PhuongThucThanhToan == 1 ? "Thanh toán khi nhận hàng" : "Thanh toán qua Ngân hàng NCB";
    //         $hoaDon->trang_thai = 1;
    //         $hoaDon->ma = $NgauNhien;
    //         $hoaDon->save();

    //         for ($i = 0; $i < count($request->ten); $i++) {
    //             $mau = Mau::where('ten', $request->mau[$i])->first();
    //             $size = Size::where('ten', $request->size[$i])->first();
    //             $sanPham = SanPham::where('ten', $request->ten[$i])->first();
    //             $chiTietSanPham = ChiTietSanPham::where('san_pham_id', $sanPham->id)
    //                 ->where('mau_id', $mau->id)
    //                 ->where('size_id', $size->id)
    //                 ->first();

    //             if ($chiTietSanPham) {
    //                 $chiTietHoaDon = new ChiTietHoaDon();
    //                 $chiTietHoaDon->hoa_don_id = $hoaDon->id;
    //                 $chiTietHoaDon->chi_tiet_san_pham_id = $chiTietSanPham->id;
    //                 $chiTietHoaDon->so_luong = (int)$request->so_luong[$i];
    //                 $chiTietHoaDon->thanh_tien = (int)$request->so_luong[$i] * $request->gia[$i];
    //                 $chiTietHoaDon->save();

    //                 if ($request->PhuongThucThanhToan == 1) {
    //                     $chiTietSanPham->so_luong -= $request->so_luong[$i];
    //                     $chiTietSanPham->save();
    //                     $sanPham->so_luong -= $request->so_luong[$i];
    //                     $sanPham->save();
    //                 }
    //             }
    //         }

    //         if ($request->PhuongThucThanhToan == 2) {
    //             $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    //             $vnp_Returnurl = "http://localhost:3000/ThanhToan";
    //             $vnp_TmnCode = "AJ5OA62P";
    //             $vnp_HashSecret = "FQIXOHHXXCKXLGGXOIWERHWOARBOIGGA";

    //             $vnp_TxnRef = $NgauNhien;
    //             $vnp_OrderInfo = "abc";
    //             $vnp_OrderType = "billpayment";
    //             $vnp_Amount = $hoaDon->tong_tien * 100;
    //             $vnp_Locale = "vn";
    //             $vnp_BankCode = "ncb";
    //             $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

    //             $inputData = array(
    //                 "vnp_Version" => "2.1.0",
    //                 "vnp_TmnCode" => $vnp_TmnCode,
    //                 "vnp_Amount" => $vnp_Amount,
    //                 "vnp_Command" => "pay",
    //                 "vnp_CreateDate" => date('YmdHis'),
    //                 "vnp_CurrCode" => "VND",
    //                 "vnp_IpAddr" => $vnp_IpAddr,
    //                 "vnp_Locale" => $vnp_Locale,
    //                 "vnp_OrderInfo" => $vnp_OrderInfo,
    //                 "vnp_OrderType" => $vnp_OrderType,
    //                 "vnp_ReturnUrl" => $vnp_Returnurl,
    //                 "vnp_TxnRef" => $vnp_TxnRef,
    //             );

    //             if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    //                 $inputData['vnp_BankCode'] = $vnp_BankCode;
    //             }

    //             ksort($inputData);
    //             $query = "";
    //             $hashdata = "";
    //             foreach ($inputData as $key => $value) {
    //                 if ($query != "") {
    //                     $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    //                     $query .= '&' . urlencode($key) . "=" . urlencode($value);
    //                 } else {
    //                     $hashdata .= urlencode($key) . "=" . urlencode($value);
    //                     $query .= urlencode($key) . "=" . urlencode($value);
    //                 }
    //             }

    //             $vnp_Url = $vnp_Url . "?" . $query;
    //             if (isset($vnp_HashSecret)) {
    //                 $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    //                 $vnp_Url .= '&vnp_SecureHash=' . $vnpSecureHash;
    //             }

    //             return response()->json([
    //                 "success" => true,
    //                 "url" => $vnp_Url,
    //             ]);
    //         } else {
    //             return response()->json([
    //                 "success" => true,
    //                 "data" => $hoaDon->id,
    //             ]);
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Error in ThanhToan:', ['exception' => $e]);
    //         return response()->json([
    //             "success" => false,
    //             "message" => $e->getMessage(),
    //         ], 500);
    //     }
    // }


    public function KiemTraDonHang(Request $request)
    {
        $hoaDon = HoaDon::where('id',$request->hdID)->first();
        $chiTietHoaDon = ChiTietHoaDon::where('hoa_don_id',$hoaDon->id)->get();
        foreach($chiTietHoaDon as $danhSach)
        {
            $danhSach->chi_tiet_san_pham->san_pham;
        }
        return response()->json([
            "success"=>true,
            "message"=>"thành công",
            "data"=>$hoaDon,
            "dataCTHoaDon"=>$chiTietHoaDon,
        ]);
    }


    public function ThanhCong(Request $request)
    {
        $hoaDon = HoaDon::where('id',$request->hdID)->first();
       $hoaDon->trang_thai =4;
       $hoaDon->trang_thai_thanh_toan = 1;
        $hoaDon->save();

        return response()->json([
            "success"=>true,
            "message"=>"thành công",
            "data"=>$hoaDon,
        ]);
    }

    public function LayHoaDonKhachHang(Request $request)
    {
        $hoaDon = HoaDon::where('khach_hang_id',$request->KhachHang)->orderBy('id', 'desc')->get();


        return response()->json([
            "success"=>true,
            "message"=>"thành công",
            "data"=>$hoaDon,

        ]);
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

        return response()->json([
            "success"=>true,
            "message"=>"thành công",


        ]);    }
}
