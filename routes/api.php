<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhachHangAPIController;
use  App\Http\Controllers\SanPhamAPIController;
use  App\Http\Controllers\BinhLuanAPIController;
use  App\Http\Controllers\LoaiAPIController;
use  App\Http\Controllers\ChiTietLoaiAPIController;

use  App\Http\Controllers\HoaDonAPIController;
use  App\Http\Controllers\DanhGiaAPIController;
use App\Http\Controllers\SlideShowAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//-------------TÀI KHOẢNG-------------------
Route::post('/login',[KhachHangAPIController::class,'login'])->middleware('api');
Route::post('me',[KhachHangAPIController::class,'me'])->middleware('api');

Route::post('/logout',[KhachHangAPIController::class,'logout'])->middleware('api');

Route::post('/regester',[KhachHangAPIController::class,'Regester'])->middleware('api');
Route::post('/doi-mat-khau',[KhachHangAPIController::class,'doiMatKhau'])->middleware('api');
Route::post('/cap_nhat_thong_tin',[KhachHangAPIController::class,'capNhatThongTin'])->middleware('api');
Route::match(['get', 'post'],'/lay-lai-mat-khau',[KhachHangAPIController::class,'LayLaiMatKhau']);
Route::post('/them-avatar',[KhachHangAPIController::class,'ThemAvatar']);



//---------------SẢN PHẨM-----------------------------------
route::get('danh-sach-san-pham',[SanPhamAPIController::class,'DanhSachSanPham']);

route::get('chi-tiet-san-pham/{id}',[SanPhamAPIController::class,'ChiTietSanPham']);

route::post('tim-kiem/{ten}',[SanPhamAPIController::class,'TimKiem']);

route::get('tim-kiem-gia-tang/{ten}',[SanPhamAPIController::class,'TimKiemGiaTang']);

route::get('tim-kiem-gia-giam/{ten}',[SanPhamAPIController::class,'TimKiemGiaGiam']);

route::post('loc-loai/{idLoai}',[SanPhamAPIController::class,'LocLoaiSanPham']);

route::get('gia-tang/{id}',[SanPhamAPIController::class,'GiaTang']);

route::get('gia-giam/{id}',[SanPhamAPIController::class,'GiaGiam']);

route::post('kiem-tra-so-luong',[SanPhamAPIController::class,'KiemTraSoLuong']);

//------------------BÌNH LUẬN---------------------------

route::post('luu-binh-luan', [BinhLuanAPIController::class, 'ThemBinhLuanCapMot']);
route::get('danh-sach-binh-luan-cap-mot/{id}', [BinhLuanAPIController::class, 'DanhSachBinhLuanCapMot']);

Route::post('/tim-binh-luan',[BinhLuanAPIController::class,'TimBinhLuan'])->middleware('api');

route::post('luu-binh-luan-cap-hai', [BinhLuanAPIController::class, 'ThemBinhLuanCapHai']);
route::post('danh-sach-binh-luan-cap-hai', [BinhLuanAPIController::class, 'DanhSachBinhLuanCapHai']);

//-----------------LOAI----------------------------

route::get('danh-sach-loai',[LoaiAPIController::class,'DanhSachLoai']);
route::get('danh-sach-chi-tiet-loai',[ChiTietLoaiAPIController::class,'DanhSachChiTietLoai']);


//---------------------HOÁ ĐƠN-------------------


route::match(['get', 'post'],'thanh-toan',[HoaDonAPIController::class,'ThanhToan']);
route::match(['get', 'post'],'trang-thai-thanh-toan',[HoaDonAPIController::class,'TrangThaiThanhToan']);

route::post('kiem-tra-don-hang',[HoaDonAPIController::class,'KiemTraDonHang']);
route::match(['get', 'post'],'da-nhan-duoc-hang',[HoaDonAPIController::class,'ThanhCong']);
route::match(['get', 'post'],'lay-hoa-don-khach-hang',[HoaDonAPIController::class,'LayHoaDonKhachHang']);


route::get('huy-don-hang/{id}',[HoaDonAPIController::class,'Huy']);

//--------------------ĐÁNH GIÁ-----------------------

route::post('them-danh-gia',[DanhGiaAPIController::class,'ThemDanhGia']);
route::get('danh-sach-danh-gia/{id}',[DanhGiaAPIController::class,'LayDanhGia']);

//-------------------------Slide-----------------------
// Ví dụ:



