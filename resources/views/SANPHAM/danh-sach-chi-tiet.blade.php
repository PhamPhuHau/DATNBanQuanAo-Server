@extends('ADMIN/index')
@section('content')

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>


<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Danh sách chi tiết</h6>
            <a href="{{ Route('san-pham.danh-sach') }}">Quay lại</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">ID</th>
                        <th scope="col">TÊN</th>
                        <th scope="col">MÃ</th>
                        <th scope="col">LOẠI</th>
                        <th scope="col">MÀU</th>
                        <th scope="col">SIZE</th>
                        <th scope="col">SỐ LƯỢNG</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($CT_San_Pham as $chi_tiet_san_pham)
                    <tr>
                        <td>{{ $chi_tiet_san_pham->id }}</td>
                        <td>{{ $chi_tiet_san_pham->san_pham->ten }}</td>
                        <td>{{ $chi_tiet_san_pham->san_pham->ma }}</td>
                        <td>{{ $chi_tiet_san_pham->san_pham->loai->ten }}</td>
                        <td>{{ $chi_tiet_san_pham->Mau->ten }}</td>
                        <td>{{ $chi_tiet_san_pham->Size->ten }}</td>
                        <td>{{ $chi_tiet_san_pham->so_luong }}</td>

                    </tr>
                    @endforeach

                        </table>
                        <div class="thongtin">
                            <h1 class="danh-sach-chi-tiet-hinh-anh">THÔNG TIN</h1>
                            {{$sanPham->thong_tin}}
                        </div>
                        <div class="sua"></div>

                        <div class="row">
                            <h1 class="danh-sach-chi-tiet-hinh-anh">HÌNH ẢNH</h1>
                            @if ($errors->any())
					<div class="alert alert-danger">

						@foreach($errors->all() as $error)
						{{$error }}<br>
					@endforeach
					</div>
				@endif
                        @foreach($hinh_Anh as $item)

                        <div class="col-sm-6">
                            <img src="{{ asset($item->url) }}"  class="AnhSP"/>
                            <a class="btn btn-outline-danger" href="{{ route('san-pham.xoa-anh', ['id' => $item->id ])}}">Xoá</a>

                        </div>

                            @endforeach
                            </div>


                            <form method="POST"  enctype="multipart/form-data" action="">
                                @csrf


                                <td >

                                <input class="form-control" type="file" name="HinhAnh[]" multiple required="true"  ><br>
                                </td>





                                <td>
                                    <button type="submit" class="btn btn-outline-success" >LƯU</button>
                                </td>


                            </form>

                    </div>
                </div>
</div>

@endsection
@section('chon')
<a href="/" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>THỐNG KÊ</a>
    <a href="{{ Route('san-pham.danh-sach') }}" class="nav-item nav-link active"><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
                    <a href="{{ Route('loai.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
                    <a href="{{ Route('mau.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>MÀU</a>
                    <a href="{{ Route('size.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>SIZE</a>
                    <a href="{{ Route('nha-cung-cap.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-home me-2"></i>NHÀ CUNG CẤP</a>
    <div class="nav-item dropdown ">
                        <a href="#" class="nav-link dropdown-toggle " data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>NHẬP HÀNG</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{ Route('san-pham.nhap-hang') }}" class="dropdown-item">MỚI</a>
                            <a href="{{ Route('san-pham.lich-su-nhap-hang') }}" class="dropdown-item">LỊCH SỬ NHẬP HÀNG</a>
                            <a href="{{ Route('san-pham.nhap-so-luong') }}" class="dropdown-item">THÊM SỐ LUỌNG</a>
                        </div>
                        <a href="{{ Route('hoa-don.danh-sach') }}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
                    <a href="{{ Route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>
                    <a href="{{ Route('binh-luan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-envelope me-2"></i>BÌNH LUẬN</a>
                    <a href="{{ Route('slideshow.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-laptop me-2"></i>SLIDESHOW</a>

@endsection
