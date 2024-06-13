@extends('ADMIN/index')
@section('content')


<div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">CẬP NHẬT SẢN PHẨM</h6>

                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <!-- <th scope="col"><input class="form-check-input" type="checkbox"></th> -->
                                    <th scope="col">HÌNH</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">TÊN</th>
                                    <th scope="col">MÃ</th>

                                    <th scope="col">GIÁ NHẬP</th>
                                    <th scope="col">GIÁ BÁN</th>
                                    <th scope="col">SỐ LƯỢNG</th>
                                    <th scope="col">TRẠNG THÁI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                    <td><img src="bootstrap-admin-template-free.jpg" width="auto" height="50px" alt=""></td>
                                    <td style="width: 25%;"><input type="text"></td>
                                    <td style="width: 25%;"><input type="text"></td>

                                    <td style="width: 25%;"><input type="text" ></td>
                                    <td style="width: 25%;"><input type="text" ></td>
                                    <td style="width: 25%;"><input type="text" ></td>
                                    <td style="width: 25%;"><input type="text" ></td>
                                    <td style="width: 25%;"><input type="text" ></td>



                                </tr>

                            </tbody>

                        </table>

                    </div>
                    <td><a class="btn btn-sm btn-primary" style="margin: 15px 0 0 0;" href="#">CẬP NHẬT</a></td>
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

                    <a href="{{ Route('tai-khoan.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-regular fa-user me-2"></i>TÀI KHOẢN</a>
                    <a href="{{ Route('slideshow.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-laptop me-2"></i>SLIDESHOW</a>
@endsection
