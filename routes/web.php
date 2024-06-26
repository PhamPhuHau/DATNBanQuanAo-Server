<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SizeController;

use App\Http\Controllers\MauController;
use App\Http\Controllers\ChatLieuController;
use App\Http\Controllers\KieuDoController;

use App\Http\Controllers\NhaCungCapController;

use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\LoaiController;
use App\Http\Controllers\QuanLyController;
use App\Http\Controllers\HoaDonController;
use App\Http\Controllers\DonHangController;
use App\Http\Controllers\TaiKhoanController;
use App\Http\Controllers\BinhLuanController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\SlideShowController;
use App\Http\Controllers\ChiTietLoaiController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('auth')->group(function(){
Route::get('/', [QuanLyController::class, 'trangChu'])->name('quan-ly.trang-chu');
Route::match(['get', 'post'], '/thay-doi-bieu-do', [QuanLyController::class, 'ThayDoiBieuDo'])->name('thay-doi-bieu-do');

/*-----------------------SANPHAM-------------------- */
Route::prefix('san-pham')->group(function(){
    Route::name('san-pham.')->group(function(){
        Route::get('/danh-sach',[SanPhamController::class,'view'] )->name('danh-sach');
        Route::get('/cap-nhat', function () {
            return view('SANPHAM/cap-nhat');
        })->name('cap-nhat');

        Route::get('nhap-hang',[SanPhamController::class,'themMoi'])->name('nhap-hang');
        Route::post('nhap-hang',[SanPhamController::class,'xuLyThemMoi'])->name('xl-nhap-hang');
        Route::get('nhap-so-luong',[SanPhamController::class,'themSoLuong'])->name('nhap-so-luong');
        Route::get('lay-thong-tin-san-pham-loai',[SanPhamController::class,'layThongTinLoai'])->name('lay-thong-tin-san-pham-loai');
        Route::get('lay-thong-tin-san-pham-chi-tiet-loai',[SanPhamController::class,'layThongTinChiTietLoai'])->name('lay-thong-tin-san-pham-chi-tiet-loai');

        Route::get('lay-thong-tin-san-pham-mau',[SanPhamController::class,'layThongTinMau'])->name('lay-thong-tin-san-pham-mau');
        Route::get('lay-thong-tin-san-pham-size',[SanPhamController::class,'layThongTinSize'])->name('lay-thong-tin-san-pham-size');
        Route::get('lay-thong-tin-san-pham-chat-lieu',[SanPhamController::class,'layThongTinChatLieu'])->name('lay-thong-tin-san-pham-chat-lieu');
        Route::get('lay-thong-tin-san-pham-kieu-do',[SanPhamController::class,'layThongTinKieuDo'])->name('lay-thong-tin-san-pham-kieu-do');

        Route::get('lay-thong-tin-san-pham-ten',[SanPhamController::class,'layThongTinTen'])->name('lay-thong-tin-san-pham-ten');
        Route::post('them-so-luong/{id}', [SanPhamController::class, 'themSoLuong'])->name('them-so-luong');

        Route::post('xu-ly-them-so-luong',[SanPhamController::class,'xuLyThemSoLuong'])->name('xu-ly-them-so-luong');

        Route::get('/xoa/{id}',[SanPhamController::class, 'Delete'])->name('xoa');
        Route::delete('xoa-chi-tiet-san-pham/{id}', [SanPhamController::class, 'xoaChiTietSanPham'])->name('xoa-chi-tiet-san-pham');

        Route::get('lich-su-nhap-hang',[SanPhamController::class,'lsNhapHang'])->name('lich-su-nhap-hang');
        Route::get('lich-su-chi-tiet-nhap-hang/{id}',[SanPhamController::class,'lsChiTietNhapHang'])->name('lich-su-chi-tiet-nhap-hang');
        Route::get('san-pham/{id}',[SanPhamController::class,'view_Chi_Tiet'])->name('chi-tiet-san-pham');
        Route::post('san-pham/{id}',[SanPhamController::class,'them_Anh'])->name('them-anh');
        Route::get('xoa-anh/{id}', [SanPhamController::class, 'xoa_Anh'])->name('xoa-anh');
        Route::post('cap-nhat-thong-tin/{id}', [SanPhamController::class, 'capNhatThongTin'])->name('cap-nhat-thong-tin');

        Route::post("sua",[SanPhamController::class,'xu_Ly_Sua'])->name('sua');
    });
});

/*-----------------------LOAI-------------------- */
Route::prefix('loai')->group(function(){
    Route::name('loai.')->group(function(){
        Route::get('danh-sach',[LoaiController::class,'View'])->name('danh-sach');
        Route::get("/them",[LoaiController::class, 'themMoi'])->name('them');
        Route::post("/them",[LoaiController::class, 'xuLyThemMoi'])->name('xl-them');
        Route::get("/cap-nhat/{id}",[LoaiController::class, 'Edit'])->name('cap-nhat');
        Route::post("/cap-nhat/{id}",[LoaiController::class, 'xlEdit'])->name('xl-cap-nhat');
        Route::get("/xoa/{id}",[LoaiController::class, 'Delete'])->name('xoa');
    });
});
/*-------------------CHITIETLOAI-----------------*/
Route::prefix('chi-tiet-loai')->group(function() {
    Route::name('chi-tiet-loai.')->group(function() {
        Route::get('danh-sach/{loai_id}', [ChiTietLoaiController::class, 'view'])->name('danh-sach');
        Route::get('them/{loai_id}', [ChiTietLoaiController::class, 'themMoi'])->name('them');
        Route::post('them', [ChiTietLoaiController::class, 'xuLyThemMoi'])->name('xl-them');
        Route::get('cap-nhat/{id}', [ChiTietLoaiController::class, 'edit'])->name('cap-nhat');
        // Route::post('cap-nhat/{id}', [ChiTietLoaiController::class, 'xlEdit'])->name('xl-cap-nhat');
        Route::post('xl-cap-nhat/{id}', [ChiTietLoaiController::class, 'xlEdit'])->name('xl-cap-nhat');

        Route::get('xoa/{id}', [ChiTietLoaiController::class, 'delete'])->name('xoa');
    });
});
/*-----------------------MAU-------------------- */
Route::prefix('mau')->group(function(){
    Route::name('mau.')->group(function(){

    Route::get('/danh-sach',[MauController::class,'View'])->name('danh-sach');
    Route::get("/them",[MauController::class, 'themMoi'])->name('them');
    Route::post("/them",[MauController::class, 'xuLyThemMoi'])->name('xl-them');

    Route::get("/cap-nhat/{id}",[MauController::class, 'Edit'])->name('cap-nhat');
    Route::post("/cap-nhat/{id}",[MauController::class, 'xlEdit'])->name('xl-cap-nhat');

    Route::get("/xoa/{id}",[MauController::class, 'Delete'])->name('xoa');
});
});
/*-----------------------------------CHATLIEU------------------------------------*/
Route::prefix('chat-lieu')->group(function(){
    Route::name('chat-lieu.')->group(function(){

    Route::get('/danh-sach',[ChatLieuController::class,'View'])->name('danh-sach');
    Route::get("/them",[ChatLieuController::class, 'themMoi'])->name('them');
    Route::post("/them",[ChatLieuController::class, 'xuLyThemMoi'])->name('xl-them');

    Route::get("/cap-nhat/{id}",[ChatLieuController::class, 'Edit'])->name('cap-nhat');
    Route::post("/cap-nhat/{id}",[ChatLieuController::class, 'xlEdit'])->name('xl-cap-nhat');

    Route::get("/xoa/{id}",[ChatLieuController::class, 'Delete'])->name('xoa');
});
});
/*-----------------------------------KIEUDO------------------------------------*/
Route::prefix('kieu-do')->group(function(){
    Route::name('kieu-do.')->group(function(){

    Route::get('/danh-sach',[KieuDoController::class,'View'])->name('danh-sach');
    Route::get("/them",[KieuDoController::class, 'themMoi'])->name('them');
    Route::post("/them",[KieuDoController::class, 'xuLyThemMoi'])->name('xl-them');

    Route::get("/cap-nhat/{id}",[KieuDoController::class, 'Edit'])->name('cap-nhat');
    Route::post("/cap-nhat/{id}",[KieuDoController::class, 'xlEdit'])->name('xl-cap-nhat');

    Route::get("/xoa/{id}",[KieuDoController::class, 'Delete'])->name('xoa');
});
});
/*-----------------------------------SIZE-----------------------------------------*/
Route::prefix('size')->group(function(){
    Route::name('size.')->group(function(){
        Route::get('/danh-sach',[SizeController::class,'View'])->name('danh-sach');
        Route::get("/them",[SizeController::class, 'themMoi'])->name('them');
        Route::post("/them",[SizeController::class, 'xuLyThemMoi'])->name('xl-them');

        Route::get("/cap-nhat/{id}",[SizeController::class, 'Edit'])->name('cap-nhat');
        Route::post("/cap-nhat/{id}",[SizeController::class, 'xlEdit'])->name('xl-cap-nhat');

        Route::get("/xoa/{id}",[SizeController::class, 'Delete'])->name('xoa');

    });
});
Route::get('/dang-xuat',[QuanLyController::class,'dangXuat'])->name('dang-xuat');
Route::get('/thong-tin',[QuanLyController::class,'thongTinhNguoiDung'])->name('thong-tin');
});
//----------------------------------NHACUNGCAP--------------------------------------------
Route::prefix('nha-cung-cap')->group(function(){
    Route::name('nha-cung-cap.')->group(function(){
        Route::get('/danh-sach',[NhaCungCapController::class,'View'])->name('danh-sach');
        Route::get("/them",[NhaCungCapController::class, 'themMoi'])->name('them');
        Route::post("/them",[NhaCungCapController::class, 'xuLyThemMoi'])->name('xl-them');
        Route::get("/xoa/{id}",[NhaCungCapController::class, 'Delete'])->name('xoa');
        Route::get("/cap-nhat/{id}",[NhaCungCapController::class, 'Edit'])->name('cap-nhat');
        Route::post("/cap-nhat/{id}",[NhaCungCapController::class, 'xlEdit'])->name('xl-cap-nhat');
    });
});

//-------------------QUANLY-----------------------
Route::middleware('guest')->group(function(){
Route::get('/dang-nhap',[QuanLyController::class, 'dangNhap'])->name('dang-nhap');

Route::post('/dang-nhap',[QuanLyController::class, 'xuLyDangNhap'])->name('xl-dang-nhap');


});


//-----------------------------------------HOADON-------------------------------------------------
Route::prefix('hoa-don')->group(function(){
    Route::name('hoa-don.')->group(function(){
        Route::get('/danh-sach',[HoaDonController::class,'View'])->name('danh-sach');
        Route::get('/danh-sach-chi-tiet/{id}',[HoaDonController::class,'HienChiTiet'])->name('danh-sach-chi-tiet');
        Route::get('/huy/{id}',[HoaDonController::class,'Huy'])->name('huy');
        Route::get('/xac-nhan/{id}',[HoaDonController::class,'XacNhan'])->name('xac-nhan');
        Route::get('/van-chuyen/{id}',[HoaDonController::class,'VanChuyen'])->name('van-chuyen');
        Route::get('/thanh-cong/{id}',[HoaDonController::class,'ThanhCong'])->name('thanh-cong');
        Route::get('/loc/{id}',[HoaDonController::class,'Loc'])->name('loc');
        Route::get('/loc-thanh-toan/{id}',[HoaDonController::class,'LocThanhToan'])->name('loc-thanh-toan');

    });
});

//-----------------------------------------DONHANG-------------------------------------------------
Route::prefix('don-hang')->group(function(){
    Route::name('don-hang.')->group(function(){
        Route::get('/danh-sach',[DonHangController::class,'View'])->name('danh-sach');
    });
});

//-----------------------------------------TAIKHOAN-------------------------------------------------
Route::prefix('tai-khoan')->group(function(){
    Route::name('tai-khoan.')->group(function(){
        Route::get('/danh-sach',[TaiKhoanController::class,'View'])->name('danh-sach');
        Route::get('/danh-sach-khoa',[TaiKhoanController::class,'HienKhoa'])->name('danh-sach-khoa');
        Route::get('/danh-sach/{id}',[TaiKhoanController::class,'Khoa'])->name('khoa');
        Route::get('/danh-sach-khoa/{id}',[TaiKhoanController::class,'MoKhoa'])->name('mo-khoa');
        Route::get('/them',[TaiKhoanController::class,'Them'])->name('them');
        Route::post('/xu-ly-them',[TaiKhoanController::class,'XLThem'])->name('xu-ly-them');
        Route::get('/cap-nhat/{id}',[TaiKhoanController::class,'CapNhat'])->name('cap-nhat');
        Route::post('/xu-ly-cap-nhat/{id}',[TaiKhoanController::class,'XLCapNhat'])->name('xu-ly-cap-nhat');
        Route::get('/xoa/{id}',[TaiKhoanController::class,'Xoa'])->name('xoa');

    });
});




//-----------------------------------------BINHLUAN-------------------------------------------------
Route::prefix('binh-luan')->group(function(){
    Route::name('binh-luan.')->group(function(){
        Route::get('/danh-sach',[BinhLuanController::class,'DanhSachBinhLuanCapMot'])->name('danh-sach');
        Route::get('/danh-sach/{id}',[BinhLuanController::class,'DanhSachBinhLuanCapHai'])->name('danh-sach-cap-hai');
        Route::get('/xoa-cap-mot/{id}',[BinhLuanController::class,'XoaCapMot'])->name('xoa-cap-mot');
        Route::get('/xoa-cap-hai/{id}',[BinhLuanController::class,'XoaCapHai'])->name('xoa-cap-hai');

    });
});
//---------------------------------SlideShow------------------
Route::prefix('slideshow')->group(function () {
    Route::name('slideshow.')->group(function () {

        Route::get('/danh-sach', [SlideShowController::class, 'view'])->name('danh-sach');
        Route::post('/them-anh', [SlideShowController::class, 'them_Anh'])->name('them-anh');
        Route::get('/xoa-anh/{id}', [SlideShowController::class, 'xoa_Anh'])->name('xoa-anh');
    });
});



//----------------------------------------------PDF-----------------------------------
Route::get('/export-pdf/{id}', [PDFController::class,'exportPDF'])->name('thuchien');
