<!-- @extends('ADMIN/index')
@section('content')
<form action="{{ route('san-pham.xu-ly-them-so-luong') }}" method="post">
    @csrf
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">NHẬP HÀNG SỐ LƯỢNG</h6>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{$error }}<br>
                    @endforeach
                </div>
            @endif
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">MÃ</th>
                            <th scope="col">TÊN</th>
                            <th scope="col">SỐ LƯỢNG</th>
                            <th scope="col">GIÁ NHẬP</th>
                            <th scope="col">GIÁ BÁN</th>
                            <th scope="col">LOẠI</th>
                            <th scope="col">CHI TIẾT LOẠI</th>
                            <th scope="col">MÀU</th>
                            <th scope="col">SIZE</th>
                            <th scope="col">CHẤT LIỆU</th>
                            <th scope="col">KIỂU ĐỒ</th>
                            <th scope="col">THÔNG TIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 25%;">
                                <select name="maSanPham" id="maSanPham" onchange="thongTinTen(this.value)">
                                    <option></option>
                                    @php
                                        $addedMAs = [];
                                    @endphp
                                    @foreach($danhSachSanPham as $sanPham)
                                        @if (!in_array($sanPham->ma, $addedMAs))
                                            <option value="{{ $sanPham->ma }}">{{ $sanPham->ma }}</option>
                                            @php
                                                $addedMAs[] = $sanPham->ma;
                                            @endphp
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                            <td style="width: 25%;">
                                <select id="tenSanPham" name="san_Pham" class="ten" onchange="thongTinLoai(this.value)"></select>
                            </td>
                            <td style="width: 25%;"><input name="so_Luong" type="number"></td>
                            <td style="width: 25%;"><input name="gia_Nhap" type="number"></td>
                            <td style="width: 25%;"><input name="gia_Ban" type="number"></td>
                            <td style="width: 25%;">
                                <select id="loaiSanPham" name="loai" class="loai" onchange="thongTinChiTietLoai(this.value)"></select>
                            </td>
                            <td style="width: 25%;">
                                <select class="chi_tiet_loai" name="chi_tiet_loai" onchange="thongTinMau(document.getElementById('tenSanPham').value, this.value)"></select>
                            </td>
                            <td style="width: 25%;">
                                <select class="mau" name="mau" onchange="thongTinSize(document.getElementById('tenSanPham').value, this.value)"></select>
                            </td>
                            <td style="width: 25%;">
                                <select class="size" name="size"></select>
                            </td>
                            <td style="width: 25%;">
                                <select class="chat_lieu" name="chat_lieu" onchange="thongTinChatLieu(document.getElementById('tenSanPham').value, this.value)"></select>
                            </td>
                            <td style="width: 25%;">
                                <select class="kieu_do" name="kieu_do"></select>
                            </td>
                            <td style="width: 25%;"><textarea rows="4" cols="50" name="thong_Tin"></textarea></td>
                        </tr>
                    </tbody>
                </table>
                <div class="thongtin"></div>
            </div>
            <td><button class="btn btn-outline-success" style="margin: 15px 0 0 0;" type="submit">LƯU</button></td>
        </div>
    </div>
</form>

<script>
    function thongTinTen(ma) {
        $.ajax({
            method: "GET",
            url: "{{ route('san-pham.lay-thong-tin-san-pham-ten') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "ma": ma,
            },
        }).done(function(response) {
            console.log(response);
            $('.ten').empty().append('<option></option>'); // Empty and add a default empty option
            let addedValues = new Set(); // Use a set to track added values
            if (response.success && response.data.length > 0) {
                response.data.forEach(function(item) {
                    if (!addedValues.has(item.id)) {
                        $('.ten').append(`<option value="${item.id}">${item.ten}</option>`);
                        addedValues.add(item.id);
                    }
                });
            } else {
                console.log("Không có thông tin về tên sản phẩm");
            }
        });
    }

    function thongTinLoai(id) {
        $.ajax({
            method: "GET",
            url: "{{ route('san-pham.lay-thong-tin-san-pham-loai') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "id": id,
            },
        }).done(function(response) {
            $('.loai').empty().append('<option></option>');
            let addedValues = new Set();
            if (response.success && response.data.length > 0) {
                response.data.forEach(function(item) {
                    if (!addedValues.has(item.loai.id)) {
                        $('.loai').append(`<option value="${item.loai.id}">${item.loai.ten}</option>`);
                        addedValues.add(item.loai.id);
                    }
                });
            } else {
                console.log("Không có thông tin về loại");
            }
        });
    }

    function thongTinChiTietLoai(loai) {
        $.ajax({
            method: "GET",
            url: "{{ route('san-pham.lay-thong-tin-san-pham-chi-tiet-loai') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "loai": loai,
            },
        }).done(function(response) {
            $('.chi_tiet_loai').empty().append('<option></option>');
            let addedValues = new Set();
            if (response.success && response.data.length > 0) {
                response.data.forEach(function(item) {
                    if (!addedValues.has(item.id)) {
                        $('.chi_tiet_loai').append(`<option value="${item.id}">${item.ten}</option>`);
                        addedValues.add(item.id);
                    }
                });
            } else {
                console.log("Không có thông tin về chi tiết loại");
            }
        });
    }

    function thongTinMau(sanPham, loai) {
        $.ajax({
            method: "GET",
            url: "{{ route('san-pham.lay-thong-tin-san-pham-mau') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "sanPham": sanPham,
                "loai": loai
            },
        }).done(function(response) {
            console.log(response);
            $('.mau').empty().append('<option></option>');
            let addedValues = new Set();
            if (response.success && response.data.length > 0) {
                response.data.forEach(function(item) {
                    if (!addedValues.has(item.mau.id)) {
                        $('.mau').append(`<option value="${item.mau.id}">${item.mau.ten}</option>`);
                        addedValues.add(item.mau.id);
                    }
                });
            } else {
                console.log("Không có thông tin về màu");
            }
        });
    }

    function thongTinSize(sanPham, mau) {
        $.ajax({
            method: "GET",
            url: "{{ route('san-pham.lay-thong-tin-san-pham-size') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "sanPham": sanPham,
                "mau": mau
            },
        }).done(function(response) {
            $('.size').empty().append('<option></option>');
            let addedValues = new Set();
            if (response.success && response.data.length > 0) {
                response.data.forEach(function(item) {
                    if (!addedValues.has(item.size.id)) {
                        $('.size').append(`<option value="${item.size.id}">${item.size.ten}</option>`);
                        addedValues.add(item.size.id);
                    }
                });
            } else {
                console.log("Không có thông tin về size");
            }
        });
    }

    function thongTinChatLieu(sanPham, size) {
        $.ajax({
            method: "GET",
            url: "{{ route('san-pham.lay-thong-tin-san-pham-chat-lieu') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "sanPham": sanPham,
                "size": size
            },
        }).done(function(response) {
            $('.chat_lieu').empty().append('<option></option>');
            let addedValues = new Set();
            if (response.success && response.data.length > 0) {
                response.data.forEach(function(item) {
                    if (!addedValues.has(item.chat_lieu.id)) {
                        $('.chat_lieu').append(`<option value="${item.chat_lieu.id}">${item.chat_lieu.ten}</option>`);
                        addedValues.add(item.chat_lieu.id);
                    }
                });
            } else {
                console.log("Không có thông tin về chất liệu");
            }
        });
    }

    function thongTinKieuDo(chatLieu, size) {
        $.ajax({
            method: "GET",
            url: "{{ route('san-pham.lay-thong-tin-san-pham-kieu-do') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "chatLieu": chatLieu,
                "size": size
            },
        }).done(function(response) {
            $('.kieu_do').empty().append('<option></option>');
            let addedValues = new Set();
            if (response.success && response.data.length > 0) {
                response.data.forEach(function(item) {
                    if (!addedValues.has(item.kieu_do.id)) {
                        $('.kieu_do').append(`<option value="${item.kieu_do.id}">${item.kieu_do.ten}</option>`);
                        addedValues.add(item.kieu_do.id);
                    }
                });
            } else {
                console.log("Không có thông tin về kiểu đồ");
            }
        });
    }
</script>
@endsection

@section('chon')
<a href="/" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>THỐNG KÊ</a>
<a href="{{ Route('san-pham.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
<a href="{{ Route('loai.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
<a href="{{ Route('mau.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-table me-2"></i>MÀU</a>
<a href="{{ Route('size.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-chart-bar me-2"></i>SIZE</a>
<a href="{{ Route('nha-cung-cap.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-home me-2"></i>NHÀ CUNG CẤP</a>
<div class="nav-item dropdown ">
    <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>NHẬP HÀNG</a>
    <div class="dropdown-menu bg-transparent border-0">
        <a href="{{ Route('san-pham.nhap-hang') }}" class="dropdown-item">MỚI</a>
        <a href="{{ Route('san-pham.lich-su-nhap-hang') }}" class="dropdown-item">LỊCH SỬ NHẬP HÀNG</a>
        <a href="{{ Route('san-pham.nhap-so-luong') }}" class="dropdown-item active">THÊM SỐ LƯỢNG</a>
    </div>
    <a href="{{ Route('hoa-don.danh-sach') }}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
    <a href="{{ Route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>
    <a href="{{ Route('binh-luan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-envelope me-2"></i>BÌNH LUẬN</a>
    <a href="{{ Route('slideshow.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-laptop me-2"></i>SLIDESHOW</a>
@endsection

@if(session('thong_bao'))
    <script>alert("{{ session('thong_bao') }}")</script>
@endif -->
