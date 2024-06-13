@extends('ADMIN/index')
@section('content')

<div class="container-fluid pt-4 px-4 trangchu">
    <div class="navbar-expand bg-light navbar-light sticky-top px-4 py-0">
        
        <div class="row">
            <div class="col-sm-4 doanhThuTren">
                <h3>Thành viên</h3>
                <h1>{{$khachHang->count()}}</h1>
            </div>
            <div class="col-sm-4 doanhThuTren">
                <h3>Sản phẩm</h3>
                <h1>{{ $demSanPham->count()}}</h1>
            </div>
            <div class="col-sm-4 doanhThuTren">
                <h3>Số tiền nhập hàng</h3>
                <h1>{{$nhapHang->sum('tong_tien')}} </h1>
            </div>
        </div>
       
           <div class='doanhThuGiua'>
           <div class="row">
            
                <div class="col-sm-6 TongDoanhThu" id="TongDoanhThu">
                    <p>Tổng doanh thu năm {{$namHienTai}} là: {{ $tongDoanhThu }} VND</p>
                </div>

                <div class="col-sm-6">
                <label for="NamSoDo">Năm</label>
            <select name="NamSoDo" id="NamSoDo" onchange="ThayDoiBieuDo(this.value)">
                <option value="{{$namHienTai}}">{{$namHienTai}}</option>
                <option value="{{$namHienTai - 1 }}">{{$namHienTai - 1 }}</option>
                <option value="{{$namHienTai - 2 }}">{{$namHienTai - 2}}</option>
            </select>
                </div>
            </div>
            
                
                <canvas id="SoDoCot"  aria-label="Column Chart" role="img"></canvas>
            </div>
        
        <div class="doanhThuDuoi">
        <div class="row">
            <div class="col-sm-6">
                @if($hoaDonNhieuNhat)
                <h3>Khách hàng mua nhiều</h3>
                    @if($hoaDonNhieuNhat->khach_hang->avatar)
                    <?php $hinhAnhMinId = $hoaDonNhieuNhat->khach_hang->min('id'); ?>
                    <?php $hinhAnhMin = $hoaDonNhieuNhat->khach_hang->where('id', $hinhAnhMinId)->first();?>
                    <img src="{{ asset('avatar/' . $hinhAnhMin->avatar) }}" width="200px" height="200px" alt="">
                    @endif
                    <br>
                    <h5 style=" margin-top: 10px">Họ tên: {{$hoaDonNhieuNhat->khach_hang->ho_ten}}</h5>
                    
                    <h5>Email: {{$hoaDonNhieuNhat->khach_hang->email}}</h5> 
                    @endif
            </div>
            <div class="col-sm-6">
            
            @if($chiTietHoaDon)
                <h3>Sản phẩm bán chạy</h3>
                @if($chiTietHoaDon->chi_tiet_san_pham->san_pham->hinh_anh)
                    <?php $hinhAnhMinId = $chiTietHoaDon->chi_tiet_san_pham->san_pham->hinh_anh->min('id'); ?>
                    <?php $hinhAnhMin = $chiTietHoaDon->chi_tiet_san_pham->san_pham->hinh_anh->where('id', $hinhAnhMinId)->first();?>
                    @if($hinhAnhMin)
                    <img src="{{ asset($hinhAnhMin->url) }}" width="200px" height="200px"  alt="">
                    @endif
                    <br>
                        <h5 style=" margin-top: 10px">Tên sản phẩm: {{$chiTietHoaDon->chi_tiet_san_pham->san_pham->ten}}</h5>
                        
                        <h5>Giá bán sản phẩm: {{$chiTietHoaDon->chi_tiet_san_pham->san_pham->gia_ban}} VNĐ</h5> 
                @endif
            @endif
            </div>
        </div>



        <div class="d-flex align-items-center justify-content-between mb-4" style="margin-top: 40px;">
                        <h1 class="mb-0"  >Các sản phẩm mới</h1>
                    </div>
        <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <!-- <th scope="col"><input class="form-check-input" type="checkbox"></th> -->
                                    <th scope="col">HÌNH</th>

                                    <th scope="col">ID</th>
                                    <th scope="col">TÊN</th>
                                    <th scope="col">GIÁ NHẬP</th>
                                    <th scope="col">GIÁ BÁN</th>
                                    <th scope="col">SỐ LƯỢNG</th>

                                </tr>
                            </thead>
                            @foreach($sanPham as $SanPham)
                            <tbody>
                            <tr data-id="{{ $SanPham->id }}">
                                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->


                                    <td>
                                        @if($SanPham->hinh_anh->isNotEmpty())
                                        <?php $hinhAnhMinId = $SanPham->hinh_anh->min('id'); ?>
                                        <?php $hinhAnhMin = $SanPham->hinh_anh->where('id', $hinhAnhMinId)->first();?>
                                        <img src="{{ asset($hinhAnhMin->url) }}" width="100%" height="50px" alt="">
                                        @endif
                                    </td>
                                    <td>{{ $SanPham->id }}</td>

                                    <!-- ... Các cột thông tin sản phẩm ... -->
                                    <td class="ten-san-pham">{{ $SanPham->ten }}</td>
                                    <!-- ... Các cột khác ... -->
                                    <td>{{ $SanPham->gia_nhap }}</td>
                                    <td>{{ $SanPham->gia_ban }}</td>
                                    <td>{{ $SanPham->so_luong }}</td>


                                    <td><a class="btn btn-outline-dark" href="{{ route('san-pham.chi-tiet-san-pham',['id'=>$SanPham->id]) }}">Chi tiết</a>

                                    </td>

                                </tr>

                            </tbody>
                            @endforeach

                        </table>
                        <div class="row">
                            <div class="col-sm-10">

                            </div>
                            <div class="col-sm-2">
                            <div class="phantrang">

                        </div>
                            </div>

                        </div>



                    </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

<script>
   // Biểu đồ cột
let ThangNay = 0;
let ThangTruoc = 0;
let HaiThangTruoc = 0;

let itemDataBar = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

function ThayDoiBieuDo(Nam) {
    $.ajax({
        method: "POST",
        url: "{{ route('thay-doi-bieu-do') }}",
        data: {
            "_token": "{{ csrf_token() }}",
            "Nam": Nam
        },
    }).done(function(response) {
        $('.TongDoanhThu').html(`<p>Tổng doanh thu năm ${Nam} là: ${response.tongDoanhThu} VND</p>
`);
        itemDataBar = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        if (response.data && response.data.length > 0) {
           
            for (const item of response.data) { 
                console.log(new Date(item.created_at).getMonth());
                // Kiểm tra năm của mỗi item
                if (new Date(item.created_at).getFullYear() == Nam) {
                    // Thực hiện các hành động khi năm trùng khớp
                    switch (new Date(item.created_at).getMonth() + 1) {
                        case 1: itemDataBar[0] += item.tong_tien;
                            break;
                        case 2: itemDataBar[1] += item.tong_tien;
                            break;
                        case 3: itemDataBar[2] += item.tong_tien;
                            break;
                        case 4: itemDataBar[3] += item.tong_tien;
                            break;
                        case 5: itemDataBar[4] += item.tong_tien;
                            break;
                        case 6: itemDataBar[5] += item.tong_tien;
                            break;
                        case 7: itemDataBar[6] += item.tong_tien;
                            break;
                        case 8: itemDataBar[7] += item.tong_tien;
                            break;
                        case 9: itemDataBar[8] += item.tong_tien;
                            break;
                        case 10: itemDataBar[9] += item.tong_tien;
                            break;
                        case 11: itemDataBar[10] += item.tong_tien;
                            break;
                        case 12: itemDataBar[11] += item.tong_tien;
                            break;
                    }

                    
                }
            }
        } else {
            console.error('Invalid response data format or empty data.');
        }
        const chart = chartBar // Sửa ID của biểu đồ

                    // Update the chart data and redraw
                    chart.data.datasets[0].data = itemDataBar;
                   
                    chart.update();
    });
}



    @foreach($HoaDon as $HoaDon)
    @if($HoaDon->created_at->year == $namHienTai)
        @switch($HoaDon->created_at->month)
            @case(1)
                itemDataBar[0] +=  {{ $HoaDon->tong_tien }};
            @break

            @case(2)
                itemDataBar[1] +=  {{ $HoaDon->tong_tien }};
            @break

            @case(3)
                itemDataBar[2] +=  {{ $HoaDon->tong_tien }};
            @break

            @case(4)
                itemDataBar[3] +=  {{ $HoaDon->tong_tien }};
            @break

            @case(5)
                itemDataBar[4] +=  {{ $HoaDon->tong_tien }};
            @break

            @case(6)
                itemDataBar[5] +=  {{ $HoaDon->tong_tien }};
            @break

            @case(7)
                itemDataBar[6] +=  {{ $HoaDon->tong_tien }};
            @break

            @case(8)
                itemDataBar[7] +=  {{ $HoaDon->tong_tien }};
            @break

            @case(9)
                itemDataBar[8] +=  {{ $HoaDon->tong_tien }};
            @break

            @case(10)
                itemDataBar[9] +=  {{ $HoaDon->tong_tien }};
            @break

            @case(11)
                itemDataBar[10] +=  {{ $HoaDon->tong_tien }};
            @break

            @case(12)
                itemDataBar[11] +=  {{ $HoaDon->tong_tien }};
            @break
        @endswitch
        @endif
    @endforeach

    //----------------------------SƠ ĐỒ CỘT----------------------------------
    let labelsBar = ['tháng 1', 'tháng 2', 'tháng 3', 'tháng 4', 'tháng 5', 'tháng 6', 'tháng 7', 'tháng 8', 'tháng 9', 'tháng 10', 'tháng 11', 'tháng 12'];
   
    const dataBar = {
        labels: labelsBar,
        datasets: [{
            label: 'Doanh thu từng tháng',
            data: itemDataBar,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(75, 192, 192)',
                'rgb(255, 205, 86)',
                'rgb(0, 205, 86)',
            ]
        }]
    };

    const configBar = {
        type: 'bar',
        data: dataBar,
        options: {
            height: 500, // Đặt chiều cao là 500px
            width: 400,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tháng'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Doanh thu'
                    }
                }
            }
        }
    };

    const chartBar = new Chart(
        document.getElementById('SoDoCot'),
        configBar
    );


 
</script>


@endsection

@section('chon')
                    <a href="/" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>THỐNG KÊ</a>



                    <a href="{{ Route('san-pham.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
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
                    </div>
                    <a href="{{ Route('hoa-don.danh-sach') }}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
                    <a href="{{ Route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>
                    <a href="{{ Route('binh-luan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-envelope me-2"></i>BÌNH LUẬN</a>
                    <a href="{{ Route('slideshow.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-laptop me-2"></i>SLIDESHOW</a>


@endsection
