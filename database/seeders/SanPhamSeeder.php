<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SanPham;
use App\Models\HinhAnh;
use App\Models\ChiTietSanPham;
use App\Models\Loai;
use App\Models\Mau;
use App\Models\Size;
use App\Models\NhaCungCap;


class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //----thêm Loại----
        $loai = new Loai();
        $loai->ten = "Áo thun";
        $loai->save();
        $loai = new Loai();
        $loai->ten = "Quần Tây";
        $loai->save();
        $loai = new Loai();
        $loai->ten = "Giày";
        $loai->save();
        $loai = new Loai();
        $loai->ten = "Áo Bóng Chày";
        $loai->save();
        $loai = new Loai();
        $loai->ten = "Áo Hoodie";
        $loai->save();
        $loai = new Loai();
        $loai->ten = "Quần jogger";
        $loai->save();
        $loai = new Loai();
        $loai->ten = "Quần shortd";
        $loai->save();

        $mau =new Mau();
        $mau->ten = "Đen";
        $mau->save();
        $mau =new Mau();
        $mau->ten = "Trắng";
        $mau->save();
        $mau =new Mau();
        $mau->ten = "Xám";
        $mau->save();
        $mau =new Mau();
        $mau->ten = "Be";
        $mau->save();
        $mau =new Mau();
        $mau->ten = "Đỏ";
        $mau->save();
        $mau =new Mau();
        $mau->ten = "Xanh Lá";
        $mau->save();
        $mau =new Mau();
        $mau->ten = "Vàng";
        $mau->save();
        $mau =new Mau();
        $mau->ten = "Hường";
        $mau->save();
        $mau =new Mau();
        $mau->ten = "Tím";
        $mau->save();
        $mau =new Mau();
        $mau->ten = "Xanh Nước Biển";
        $mau->save();


        $size = new Size();
        $size->ten = "S";
        $size->save();
        $size = new Size();
        $size->ten = "M";
        $size->save();
        $size = new Size();
        $size->ten = "L";
        $size->save();
        $size = new Size();
        $size->ten = "XL";
        $size->save();
        $size = new Size();
        $size->ten = "XXL";
        $size->save();

        $nhaCungCap = new NhaCungCap();
        $nhaCungCap->ten = "Red Dog";
        $nhaCungCap->email = "RedDog@gmail.com";
        $nhaCungCap->dia_chi = "tp Hồ Chí Minh";
        $nhaCungCap->save();
        $nhaCungCap = new NhaCungCap();
        $nhaCungCap->ten = "MLB";
        $nhaCungCap->email = "MLB@gmail.com";
        $nhaCungCap->dia_chi = "tp Hồ Chí Minh";
        $nhaCungCap->save();
        $nhaCungCap = new NhaCungCap();
        $nhaCungCap->ten = "Nike";
        $nhaCungCap->email = "nike@gmail.com";
        $nhaCungCap->dia_chi = "tp Hồ Chí Minh";
        $nhaCungCap->save();


        $sanPham = new SanPham();
        $sanPham->ten = 'Áo thun unisex tay ngắn in hình dễ thương';
        $sanPham->ma = 'ATUTN1';
        $sanPham->gia_nhap = 1000000;
        $sanPham->gia_ban = 1790000;
        $sanPham->so_luong = 1000;
        $sanPham->loai_id = 1;
        $sanPham->nha_cung_cap_id = 2;
        $sanPham->thong_tin = 'Mặc dù bạn đã quá quen thuộc với những chiếc áo thun đơn giản, nhưng giờ đây, item này đã được biến tấu đáng yêu hơn với hình ảnh một chú gấu vừa thời trang vừa đang trượt tuyết hoặc trượt băng. Điều này lại một lần nữa thể hiện tinh thần thể thao mà MLB đang hướng đến, giúp bạn dễ dàng thể hiện cái tôi của mình cũng như sự tự do, linh hoạt trong thời trang.';
        $sanPham->save();

        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoThun0.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoThun1.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoThun2.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoThun3.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoThun4.webp';
        $hinhAnh->save();


        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;

        $chiTietSanPham->mau_id = 4;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 4;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 4;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 4;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 4;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 10;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 10;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 10;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 10;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 10;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();


        $sanPham = new SanPham();
        $sanPham->ten = 'Áo thun unisex cổ tròn tay ngắn phom suông thời trang';
        $sanPham->ma = 'ATUCTTN1';

        $sanPham->gia_nhap = 1000000;
        $sanPham->gia_ban = 1790000;
        $sanPham->so_luong = 1500;
        $sanPham->loai_id = 1;
        $sanPham->nha_cung_cap_id = 2;
        $sanPham->thong_tin = 'Vừa năng động vừa cá tính với chiếc áo thun mới nhất đến từ thương hiệu MLB. Được làm từ chất vải 100% cotton thoáng mát, kết hợp cùng hình in logo các đội bóng chày pha lẫn họa tiết cube monogram, chiếc áo sẽ giúp bạn chất hơn bao giờ hết khi diện item này xuống phố.';
        $sanPham->save();


        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoThun11.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoThun12.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoThun13.jpg';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoThun14.jpg';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoThun15.jpg';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoThun16.jpg';
        $hinhAnh->save();

        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 4;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 4;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 4;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 4;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 4;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 10;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 10;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 10;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 10;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 10;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();


        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 3;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 3;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 3;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 3;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 3;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();


        $sanPham = new SanPham();
        $sanPham->ten = 'Áo polo nam tay ngắn Partial Monogram Collar';
        $sanPham->ma = 'APNTNPMC1';

        $sanPham->gia_nhap = 2000000;
        $sanPham->gia_ban = 2890000;
        $sanPham->so_luong = 1000;
        $sanPham->loai_id = 2;
        $sanPham->nha_cung_cap_id = 2;
        $sanPham->thong_tin = 'Chất liệu vải: 93% cotton, 7% polyurethane
        Kiểu dáng áo polo tay ngắn thời thượng
        Cổ bẻ với tone màu tương phản, phối nút cài thanh lịch
        Bo viền gấu tay
        Thiết kế trẻ trung với túi vuông ở ngực trái, logo bóng chày thêu nổi bật
        Chất vải mềm mịn, co giãn
        Gam màu hiện đại dễ dàng phối với nhiều trang phục và phụ kiện
        Xuất xứ thương hiệu: Hàn Quốc';
        $sanPham->save();

        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/aopolo1.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/aopolo2.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/aopolo3.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/aopolo4.webp';
        $hinhAnh->save();


        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;


        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();


        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;

        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();


        $sanPham = new SanPham();
        $sanPham->ten = 'Áo sơ mi denim unisex cổ bẻ tay dài Basic Multi Mega Logo';
        $sanPham->ma = 'ASMDUCBTD1';

        $sanPham->gia_nhap = 4000000;
        $sanPham->gia_ban = 4790000;
        $sanPham->so_luong = 500;
        $sanPham->loai_id = 3;
        $sanPham->nha_cung_cap_id = 2;
        $sanPham->thong_tin = 'Mang đậm phong cách cá tính kết hợp cùng chất liệu vải thoáng mát, chiếc áo sơ mi denim Basic Multi Mega Logo chính là bản phối hoàn hảo giữa phong cách đường phố và vẻ ngoài thời thượng, là item có thể giúp bạn tạo nên những outfit đa dạng cũng như phù hợp với nhiều sự kiện khác nhau. Đừng bỏ lỡ cơ hội sở hữu chiếc áo sơ mi ấn tượng này nếu bạn là một MLB-crew đích thực.';
        $sanPham->save();

        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoSoMi0.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoSoMi1.webp';
        $hinhAnh->save();


        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();




        $sanPham = new SanPham();
        $sanPham->ten = 'Áo bóng chày unisex tay ngắn Sunny Beach Graphic';
        $sanPham->ma = 'ABCUTN1';

        $sanPham->gia_nhap = 2000000;
        $sanPham->gia_ban = 2590000;
        $sanPham->so_luong = 500;
        $sanPham->loai_id = 4;
        $sanPham->nha_cung_cap_id = 2;
        $sanPham->thong_tin = 'Chất liệu: 70% cotton, 30% polyester
        Kiểu dáng áo bóng chày năng động, cá tính
        Tay ngắn, cổ V
        Phối hàng nút ở giữa
        Logo bóng chày in nổi bật ở ngực trái và phía sau
        Gam màu hiện đại, dễ phối với nhiều loại trang phục và phụ kiện khác nhau
        Xuất xứ thương hiệu: Hàn Quốc';
        $sanPham->save();

        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoBongChay1.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoBongChay2.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/AoBongChay3.webp';
        $hinhAnh->save();


        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();



        $sanPham = new SanPham();
        $sanPham->ten = 'Áo hoodie unisex tay dài phối mũ Basic Mega Logo Overfit Brushed';
        $sanPham->ma = 'AHUTD1';

        $sanPham->gia_nhap = 3000000;
        $sanPham->gia_ban = 3290000;
        $sanPham->so_luong = 1500;
        $sanPham->loai_id = 5;
        $sanPham->nha_cung_cap_id = 2;
        $sanPham->thong_tin = 'Hãy khám phá sự kết hợp hoàn hảo giữa phong cách năng động và ấm áp với chiếc áo hoodie Basic Mega Logo Overfit Brushed đến từ thương hiệu MLB. Được thiết kế để mang đến cho các MLB-crew những bản phối đầy sáng tạo và cá tính, chiếc áo này hứa hẹn sẽ là điểm nhấn rạng rỡ trong tủ đồ của bạn suốt mùa đông dài lạnh.';
        $sanPham->save();

        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/hoodie1.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/hoodie2.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/hoodie11.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/hoodie12.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/hoodie21.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/hoodie22.webp';
        $hinhAnh->save();

        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();

        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();

        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 3;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 3;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 3;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 3;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 3;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();

        $sanPham = new SanPham();
        $sanPham->ten = 'Quần jogger unisex lưng thun Basic Medium Logo Woven Summer';
        $sanPham->ma = 'QJULT1';

        $sanPham->gia_nhap = 2000000;
        $sanPham->gia_ban = 2190000;
        $sanPham->so_luong = 1500;
        $sanPham->loai_id = 6;
        $sanPham->nha_cung_cap_id = 2;
        $sanPham->thong_tin = 'Thành phần chất liệu: 89% polyester, 11% polyurethane
        Kiểu dáng jogger lưng thun thời trang
        Bo ống mềm mại
        Phối túi xéo hai bên
        Logo bóng chày thêu nổi bật ở ống quần trái
        Chất vải mềm mại
        Đường may tỉ mỉ, chắc chắn
        Gam màu hiện đại dễ dàng phối với nhiều trang phục và phụ kiện
        Xuất xứ thương hiệu: Hàn Quốc';
        $sanPham->save();

        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/quanjogger1.webp';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/quanjogger2.webp';
        $hinhAnh->save();


        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();

        $sanPham = new SanPham();
        $sanPham->ten = 'Quần shorts unisex ống rộng Paisley Clipped Logo Part 3';
        $sanPham->ma = 'QSUOR1';

        $sanPham->gia_nhap = 1000000;
        $sanPham->gia_ban = 1790000;
        $sanPham->so_luong = 1500;
        $sanPham->loai_id = 7;
        $sanPham->nha_cung_cap_id = 2;
        $sanPham->thong_tin = 'Chất liệu: 65% cotton, 35% polyester
        Kiểu dáng quần shorts ống rộng trẻ trung
        Lưng thun co giãn thoải mái
        Phối logo bóng chày in nổi bật ở góc trái quần
        Túi xéo hai bên
        Chất vải mềm, mịn, thấm hút tốt
        Xuất xứ thương hiệu: Hàn Quốc';
        $sanPham->save();

        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/quanshorts1.jpg';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/quanshorts2.jpg';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/quanshorts11.jpg';
        $hinhAnh->save();
        $hinhAnh = new HinhAnh();
        $hinhAnh->san_pham_id = $sanPham->id;
        $hinhAnh->url = 'Hinh_Anh/quanshorts12.jpg';
        $hinhAnh->save();


        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 1;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();

        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 1;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 2;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 3;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 4;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
        $chiTietSanPham = new ChiTietSanPham();
        $chiTietSanPham->san_pham_id = $sanPham->id;
        $chiTietSanPham->mau_id = 2;
        $chiTietSanPham->size_id = 5;
        $chiTietSanPham->so_luong = 100;
        $chiTietSanPham->save();
    }
}
