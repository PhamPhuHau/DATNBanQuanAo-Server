@extends('ADMIN/index')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Danh sách chi tiết loại</h6>
            <a href="{{ route('chi-tiet-loai.them', ['loai_id' => $loai_id]) }}" type="button" class="btn btn-sm btn-outline-secondary">Thêm mới</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">ID</th>
                        <th scope="col">TÊN</th>
                        <th scope="col">HÀNH ĐỘNG</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chi_tiet_loai as $ChiTietLoai)
                    <tr>
                        <td style="width: 25%;">{{ $ChiTietLoai->id }}</td>
                        <td>{{ $ChiTietLoai->ten }}</td>
                        <td>
                            <a class="btn btn-outline-primary" href="{{ route('chi-tiet-loai.cap-nhat', ['id' => $ChiTietLoai->id]) }}">Cập nhật</a>
                            <form action="{{ route('chi-tiet-loai.xoa', ['id' => $ChiTietLoai->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row mt-3">
                <div class="col-sm-10">
                    <!-- Pagination links will be aligned to the right -->
                </div>
                <div class="col-sm-2">
                    <div class="phantrang">
                        {{ $chi_tiet_loai->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('chon')
<a href="/" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>THỐNG KÊ</a>
<a href="{{ Route('san-pham.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
                    <a href="{{ Route('loai.danh-sach') }}" class="nav-item nav-link active"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
                    <a href="{{ Route('mau.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>MÀU</a>
                    <a href="{{ Route('size.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>SIZE</a>
                    <a href="{{ Route('chat-lieu.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-chart-bar me-2"></i>CHẤT LIỆU</a>
                    <a href="{{ Route('kieu-do.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-chart-bar me-2"></i>KIỂU ĐỒ</a>

                    <a href="{{ Route('nha-cung-cap.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-home me-2"></i>NHÀ CUNG CẤP</a>


                    <div class="nav-item dropdown ">
                        <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>NHẬP HÀNG</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ Route('san-pham.nhap-hang') }}" class="dropdown-item">MỚI</a>
                            <a href="{{ Route('san-pham.lich-su-nhap-hang') }}" class="dropdown-item">LỊCH SỬ NHẬP HÀNG</a>
                        </div>
                    </div>
                    <a href="{{ Route('hoa-don.danh-sach') }}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
                    <a href="{{ Route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>
                    <a href="{{ Route('binh-luan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-envelope me-2"></i>BÌNH LUẬN</a>
                    <a href="{{ Route('slideshow.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-laptop me-2"></i>SLIDESHOW</a>


@endsection
