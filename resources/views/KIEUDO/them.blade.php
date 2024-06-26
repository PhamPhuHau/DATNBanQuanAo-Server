@extends('ADMIN/index')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="row mb-4">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="mb-0">Thêm mới kiểu đồ</h4>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                {{$error }}<br>
                            @endforeach
                        </div>
                    @endif
                    <div class="card-body p-0 create-project-main">
                        <form method="POST" action="{{ route('kieu-do.xl-them') }}">
                            @csrf
                            <div class="row p-5 border-bottom">
                                <div class="col-sm-12 col-md-12 col-xl-3">
                                    <div class="form-group">
                                        <label for="kieudo-name" class="form-label text-muted">Tên kiểu đồ:</label>
                                        <div class="input-group">
                                            <input id="kieudo-name" name="ten" type="text" class="form-control text-dark" placeholder="Nhập tên kiểu đồ">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-5">
                                <div class="btn-list text-end">
                                    <a class="btn btn-outline-danger" href="{{ route('kieu-do.danh-sach') }}">Cancel</a>
                                    <button class="btn btn-outline-success" type="submit">
                                        <i class="fe fe-check-circle"></i> Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('chon')
<a href="/" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>THỐNG KÊ</a>
<a href="{{ route('san-pham.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
<a href="{{ route('loai.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
<a href="{{ route('mau.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-table me-2"></i>MÀU</a>
<a href="{{ route('size.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>SIZE</a>
<a href="{{ Route('chat-lieu.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-chart-bar me-2"></i>CHẤT LIỆU</a>
<a href="{{ Route('kieu-do.danh-sach') }}" class="nav-item nav-link active"><i class="fa fa-chart-bar me-2"></i>KIỂU ĐỒ</a>
<a href="{{ route('nha-cung-cap.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-home me-2"></i>NHÀ CUNG CẤP</a>
<div class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>NHẬP HÀNG</a>
    <div class="dropdown-menu bg-transparent border-0">
        <a href="{{ route('san-pham.nhap-hang') }}" class="dropdown-item">MỚI</a>
        <a href="{{ route('san-pham.lich-su-nhap-hang') }}" class="dropdown-item">LỊCH SỬ NHẬP HÀNG</a>
        <a href="{{ route('san-pham.nhap-so-luong') }}" class="dropdown-item">THÊM SỐ LƯỢNG</a>
    </div>
</div>
<a href="{{ route('hoa-don.danh-sach') }}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
<a href="{{ route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>
<a href="{{ route('binh-luan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-envelope me-2"></i>BÌNH LUẬN</a>
<a href="{{ route('slideshow.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-laptop me-2"></i>SLIDESHOW</a>
@endsection
