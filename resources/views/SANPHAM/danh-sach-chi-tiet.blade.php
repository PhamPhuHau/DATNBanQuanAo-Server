@extends('ADMIN/index')
@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Danh sách chi tiết</h6>
            <a href="{{ route('san-pham.danh-sach') }}">Quay lại</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">ID</th>
                        <th scope="col">TÊN</th>
                        <th scope="col">MÃ</th>
                        <th scope="col">CHI TIẾT LOẠI</th>
                        <th scope="col">MÀU</th>
                        <th scope="col">SIZE</th>
                        <th scope="col">CHẤT LIỆU</th>
                        <th scope="col">KIỂU ĐỒ</th>
                        <th scope="col">SỐ LƯỢNG</th>
                        <th scope="col">THÊM SỐ LƯỢNG</th>
                        <th scope="col">XÓA</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($CT_San_Pham as $chi_tiet_san_pham)
                    <tr>
                        <td>{{ $chi_tiet_san_pham->id }}</td>
                        <td>{{ $chi_tiet_san_pham->san_pham->ten }}</td>
                        <td>{{ $chi_tiet_san_pham->san_pham->ma }}</td>
                        <td>{{ $chi_tiet_san_pham->san_pham->chi_tiet_loai->ten }}</td>
                        <td>{{ $chi_tiet_san_pham->mau->ten }}</td>
                        <td>{{ $chi_tiet_san_pham->size->ten }}</td>
                        <td>{{ $chi_tiet_san_pham->chat_lieu->ten }}</td>
                        <td>{{ $chi_tiet_san_pham->kieu_do->ten }}</td>
                        <td>{{ $chi_tiet_san_pham->so_luong }}</td>
                        <td>
                            <form method="POST" action="{{ route('san-pham.them-so-luong', ['id' => $chi_tiet_san_pham->id]) }}">
                                @csrf
                                <input type="number" name="so_luong_them" min="1" value="1" required>
                                <button type="submit" class="btn btn-outline-success">Thêm</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('san-pham.xoa-chi-tiet-san-pham', ['id' => $chi_tiet_san_pham->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa chi tiết sản phẩm này?')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="thongtin">
            <h1 class="danh-sach-chi-tiet-hinh-anh">THÔNG TIN</h1>
            <form method="POST" action="{{ route('san-pham.cap-nhat-thong-tin', ['id' => $sanPham->id]) }}">
                @csrf
                <div class="mb-3">
                    <textarea class="form-control" name="thong_tin" rows="4" required>{{ $sanPham->thong_tin }}</textarea>
                </div>
                <button type="submit" class="btn btn-outline-success">Cập nhật</button>
            </form>
        </div>

        <div class="row">
            <h1 class="danh-sach-chi-tiet-hinh-anh">HÌNH ẢNH</h1>
            @if ($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                {{ $error }}<br>
                @endforeach
            </div>
            @endif
            @foreach($hinh_Anh as $item)
            <div class="col-sm-6">
                <img src="{{ asset($item->url) }}" class="AnhSP" />
                <a class="btn btn-outline-danger" href="{{ route('san-pham.xoa-anh', ['id' => $item->id ]) }}">Xoá</a>
            </div>
            @endforeach
        </div>

        <form method="POST" enctype="multipart/form-data" action="{{ route('san-pham.them-anh', ['id' => $sanPham->id]) }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="HinhAnh" class="form-label">Chọn hình ảnh</label>
                    <input type="file" class="form-control" id="HinhAnh" name="HinhAnh[]" multiple required>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-outline-success mt-4">LƯU</button>
                </div>
            </div>
        </form>

    </div>
</div>

@endsection

@section('chon')
<a href="/" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>THỐNG KÊ</a>
<a href="{{ Route('san-pham.danh-sach') }}" class="nav-item nav-link active"><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
<a href="{{ Route('mau.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>MÀU</a>
<a href="{{ Route('size.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>SIZE</a>
<a href="{{ Route('loai.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
<a href="{{ Route('chat-lieu.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>CHẤT LIỆU</a>
<a href="{{ Route('nha-cung-cap.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-home me-2"></i>NHÀ CUNG CẤP</a>
<div class="nav-item dropdown ">
    <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>NHẬP HÀNG</a>
    <div class="dropdown-menu bg-transparent border-0">
        <a href="{{ Route('san-pham.nhap-hang') }}" class="dropdown-item">MỚI</a>
        <a href="{{ Route('san-pham.lich-su-nhap-hang') }}" class="dropdown-item">LỊCH SỬ NHẬP HÀNG</a>
        <a href="{{ Route('san-pham.nhap-so-luong') }}" class="dropdown-item">THÊM SỐ LƯỢNG</a>
    </div>
</div>
<a href="{{ Route('hoa-don.danh-sach') }}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
<a href="{{ Route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>
<a href="{{ Route('binh-luan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-envelope me-2"></i>BÌNH LUẬN</a>
<a href="{{ Route('slideshow.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-laptop me-2"></i>SLIDESHOW</a>
@endsection
