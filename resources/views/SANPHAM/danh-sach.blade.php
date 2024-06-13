@extends('ADMIN/index')
@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="bg-light text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Danh sách</h6>
            <form method="GET" action="{{ route('san-pham.danh-sach') }}">
                <input type="text" name="search" class="form-control me-2" placeholder="Tìm kiếm theo mã" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">HÌNH</th>
                        <th scope="col">ID</th>
                        <th scope="col">MÃ</th>
                        <th scope="col">TÊN</th>
                        <th scope="col">GIÁ NHẬP</th>
                        <th scope="col">GIÁ BÁN</th>
                        <th scope="col">SỐ LƯỢNG</th>
                        <th scope="col">LOẠI</th>
                        <th scope="col">NHÀ CUNG CẤP</th>
                        <th scope="col">SỐ SAO</th>
                    </tr>
                </thead>
                @foreach($sanPham as $SanPham)
    @if(request('search') == '' || $SanPham->ma == request('search'))
        <tbody>
            <tr data-id="{{ $SanPham->id }}">
                <td>
                    @if($SanPham->hinh_anh->isNotEmpty())
                        <?php $hinhAnhMinId = $SanPham->hinh_anh->min('id'); ?>
                        <?php $hinhAnhMin = $SanPham->hinh_anh->where('id', $hinhAnhMinId)->first();?>
                        <img src="{{ asset($hinhAnhMin->url) }}" width="100%" height="50px" alt="">
                    @endif
                </td>
                <td>{{ $SanPham->id }}</td>
                <td class="ma-san-pham">{{ $SanPham->ma }}</td>
                <td class="ten-san-pham">{{ $SanPham->ten }}</td>
                <td>{{ $SanPham->gia_nhap }}</td>
                <td>{{ $SanPham->gia_ban }}</td>
                <td>{{ $SanPham->so_luong }}</td>
                <td>{{ $SanPham->loai->ten}}</td>
                <td>{{ $SanPham->nha_cung_cap->ten}}</td>
                <td>{{ $SanPham->so_sao }}</td>
                <td style="text-align: center;">
                    <a class="btn btn-outline-dark" href="{{ route('san-pham.chi-tiet-san-pham',['id'=>$SanPham->id]) }}">Chi tiết</a>
                    <a class="btn btn-outline-primary" onclick="them({{ $SanPham->id }}, '{{ $SanPham->ten }}', '{{ $SanPham->ma }}')">Cập nhật</a>
                    <a class="btn btn-outline-danger" href="{{ route('san-pham.xoa',['id'=>$SanPham->id]) }}">Xóa</a>
                </td>
            </tr>
        </tbody>
    @endif
@endforeach

            </table>
            <div class="row">
                <div class="col-sm-10"></div>
                <div class="col-sm-2">
                    <div class="phantrang">
                        {{ $sanPham->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="sua"></div>
@endsection

@section('js')
<script>
    function them(id, ten, ma) {
        $('#sua').html(`
            <div class="col-xl-3 from-cap-nhat">
                <h4>SỬA SẢN PHẨM</h4>
                <h6>ID: ` + id + `</h6>
                <div style="display: flex; align-items: center;">
                    <label for="ten">Tên:</label>
                    <input name="ten" id="inputTen" type="text" class="form-control text-dark" value="` + ten + `" placeholder="Nhập tên sản phẩm">
                </div>
                <div style="display: flex; align-items: center;">
                    <label for="ma">Mã:</label>
                    <input name="ma" id="inputMa" type="text" class="form-control text-dark" value="` + ma + `" placeholder="Nhập mã sản phẩm">
                </div>
                <button class="btn btn-outline-success" onclick="XuLySua(` + id + `, document.getElementById('inputTen').value, document.getElementById('inputMa').value)">SAVE</button>
            </div>`);
    }

    function XuLySua(id, ten, ma) {
    $.ajax({
        method: "POST",
        url: "{{ route('san-pham.sua') }}",
        data: {
            "_token": "{{ csrf_token() }}",
            "id": id,
            "ten": ten,
            "ma": ma
        },
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    text: 'Đã sửa thành công',
                    icon: "success"
                });
                var trElement = $("tr[data-id='" + id + "']");
                trElement.find('.ten-san-pham').text(ten);
                trElement.find('.ma-san-pham').text(ma);
            } else {
                Swal.fire({
                    text: 'Sửa thất bại: ' + response.message,
                    icon: "warning"
                });
            }
        },
        error: function(error) {
            Swal.fire({
                text: error.responseJSON.message,
                icon: "warning"
            });
        }
    });
}

</script>
@endsection

@section('chon')
<a href="/" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>THỐNG KÊ</a>
<a href="{{ Route('san-pham.danh-sach') }}" class="nav-item nav-link active"><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
<a href="{{ Route('loai.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
<a href="{{ Route('mau.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>MÀU</a>
<a href="{{ Route('size.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>SIZE</a>
<a href="{{ Route('nha-cung-cap.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-home me-2"></i>NHÀ CUNG CẤP</a>
<div class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>NHẬP HÀNG</a>
    <div class="dropdown-menu bg-transparent border-0">
        <a href="{{ Route('san-pham.nhap-hang') }}" class="dropdown-item">MỚI</a>
        <a href="{{ Route('san-pham.lich-su-nhap-hang') }}" class="dropdown-item">LỊCH SỬ NHẬP HÀNG</a>
        <a href="{{ Route('san-pham.nhap-so-luong') }}" class="dropdown-item">THÊM SỐ LƯỢNG</a>
    </div>
    <a href="{{ Route('hoa-don.danh-sach') }}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
    <a href="{{ Route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>
    <a href="{{ Route('binh-luan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-envelope me-2"></i>BÌNH LUẬN</a>
    <a href="{{ Route('slideshow.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-laptop me-2"></i>SLIDESHOW</a>
@endsection
