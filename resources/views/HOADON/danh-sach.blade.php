@extends('ADMIN/index')
@section('content')
<div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">DANH SÁCH HOÁ ĐƠN</h6>
                        <select onchange="window.location.href=this.value">
                            <option>
                                thanh toán ngân hàng
                            </option>
                            <option value="{{ route('hoa-don.danh-sach') }}">tất cả</option>
                            <option value="{{ route('hoa-don.loc-thanh-toan', ['id'=>1]) }}">
                                đã thanh toán qua ngân hàng
                            </option>
                            <option value="{{ route('hoa-don.loc-thanh-toan', ['id'=>0]) }}">
                                chưa thanh toán qua ngân hàng
                            </option>
                        </select>
                        <select onchange="window.location.href=this.value">
                        <option>
                                trạng thái
                            </option>
                            <option value="{{ route('hoa-don.danh-sach') }}">tất cả</option>
                            <option value="{{ route('hoa-don.loc', ['id'=>0]) }}">đã huỷ</option>
                            <option value="{{ route('hoa-don.loc', ['id'=>1]) }}">chờ xác nhận</option>
                            <option value="{{ route('hoa-don.loc', ['id'=>2]) }}">đã xác nhận</option>
                            <option value="{{ route('hoa-don.loc', ['id'=>3]) }}">đang vận chuyển</option>
                            <option value="{{ route('hoa-don.loc', ['id'=>4]) }}">đã giao</option>
                        </select>

                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <!-- <th scope="col"><input class="form-check-input" type="checkbox"></th> -->
                                    <th scope="col">ID</th>
                                    <th scope="col">TÊN</th>
                                    <th>TỔNG TIỀN</th>
                                    <th>TIỀN SHIP</th>
                                    <th>TRẠNG THÁI</th>
                                    <th>PHƯƠNG THỨC THANH TOÁN</th>
                                    <th>TRẠNG THÁI THANH TOÁN</th>
                                </tr>
                            </thead>
                            @foreach($hoaDon as $HoaDon)
                               
                            <tbody>
                                <tr>
                                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                    <td>{{ $HoaDon->ma }}</td>
                                    
                                    <td>{{ $HoaDon->khach_hang->ho_ten }}</td>
                                    <td>{{ $HoaDon->tong_tien }}</td>
                                    <td>{{ $HoaDon->tien_ship }}</td>
                                    <td>
                                    
                                    @switch($HoaDon->trang_thai) 
                                        @case(0) Đã huỷ @break
                                        @case(1) Chờ xác nhận @break
                                        @case(2) Đã xác nhận @break
                                        @case(3) Đã bàn giao cho vận chuyển @break
                                        @case(4) Đã giao @break
                                        @default trạng thái không xác định 
                                    @endswitch



                                    </td>
                                    <td>{{ $HoaDon->phuong_thuc_thanh_toan }}</td>
                                    <td>
                                        @switch($HoaDon->trang_thai_thanh_toan) 
                                            @case(0) chưa thanh toán @break
                                            @case(1) đã thanh toán @break
                                            @default trạng thái không xác định 
                                        @endswitch
                                    </td>
                                    <td><a class="btn btn-outline-primary" href="{{ route('hoa-don.danh-sach-chi-tiet', ['id'=>$HoaDon->id]) }}">Xem chi tiết</a>
                                   
                                    @switch($HoaDon->trang_thai) 
                                       
                                        @case(1) <a class="btn btn-outline-success" href="{{ route('hoa-don.xac-nhan', ['id'=>$HoaDon->id]) }}">Xác nhận</a>
                                        <a class="btn btn-outline-danger" href="{{ route('hoa-don.huy', ['id'=>$HoaDon->id]) }}">Huỷ</a> @break

                                        @case(2) <a class="btn btn-outline-success" href="{{ route('hoa-don.van-chuyen', ['id'=>$HoaDon->id]) }}">Vận Chuyển</a>
                                        <a class="btn btn-outline-danger" href="{{ route('hoa-don.huy', ['id'=>$HoaDon->id]) }}">Huỷ</a> @break

                                        @case(3) <a class="btn btn-outline-success" href="{{ route('hoa-don.thanh-cong', ['id'=>$HoaDon->id]) }}">Thành công</a>
                                        <a class="btn btn-outline-danger" href="{{ route('hoa-don.huy', ['id'=>$HoaDon->id]) }}">Huỷ</a> @break

                                       
                                        @default 
                                    @endswitch
                                    
                                </td>
                                <td><a href="{{ route('thuchien',['id'=>$HoaDon->id]) }}" class="btn btn-outline-success">
								<i class="fe fe-check-circle"></i>
								XUẤT PDF
        </a></td>
                                </tr>
                                
                            </tbody>
                            @endforeach
                        </table>
                        <div class="row">
                            <div class="col-sm-10">
                            {{ $hoaDon->links() }}
                            </div>
                            <div class="col-sm-2">
                            <div class="phantrang">
                       
                        </div>
                            </div>

                        </div>
                    </div>
                </div>
</div>

@endsection
@section('chon')
<a href="/" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>THỐNG KÊ</a>    <a href="{{ Route('san-pham.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
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
                        <a href="{{ Route('hoa-don.danh-sach') }}" class="nav-item nav-link active"><i class="far fa-file-alt me-2"></i>HÓA ĐƠN</a>
                    <a href="{{ Route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>
                    <a href="{{ Route('binh-luan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-envelope me-2"></i>BÌNH LUẬN</a>
                    <a href="{{ Route('slideshow.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-laptop me-2"></i>SLIDESHOW</a>

@endsection