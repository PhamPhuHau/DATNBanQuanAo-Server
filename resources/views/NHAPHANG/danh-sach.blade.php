@extends('ADMIN/index')
@section('content')
<form action="{{ route('san-pham.xl-nhap-hang') }}" method="post">
    @csrf
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">NHẬP HÀNG</h6>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">MÃ</th>
                            <th scope="col">TÊN</th>
                            <th scope="col">NHÀ CUNG CẤP</th>
                            <th scope="col">SỐ LƯỢNG</th>
                            <th scope="col">GIÁ NHẬP</th>
                            <th scope="col">GIÁ BÁN</th>
                            <th scope="col">LOẠI</th>
                            <th scope="col">CHI TIẾT LOẠI</th>
                            <th scope="col">MÀU</th>
                            <th scope="col">SIZE</th>
                            <th scope="col">CHẤT LIỆU</th>
                            <th scope="col">KIỂU ĐỒ</th>
                            <th scope="col">HÀNH ĐỘNG</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input name="ma[]" type="text"></td>
                            <td><input name="ten[]" type="text"></td>
                            <td>
                                <select name="nha_cung_cap[]">
                                    <option></option>
                                    @foreach($nha_Cung_Cap as $Nha_Cung_Cap)
                                        <option value="{{ $Nha_Cung_Cap->id }}">{{ $Nha_Cung_Cap->ten }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input name="so_Luong[]" type="number"></td>
                            <td><input name="gia_Nhap[]" type="number"></td>
                            <td><input name="gia_Ban[]" type="number"></td>
                            <td>
                                <select name="loai[]" class="loai-select">
                                    <option></option>
                                    @foreach($loai as $Loai)
                                        <option value="{{ $Loai->id }}">{{ $Loai->ten }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="chi_tiet_loai[]" class="chi-tiet-loai-select">
                                    <option></option>
                                    @foreach($chi_tiet_loai as $ChiTietLoai)
                                        <option value="{{ $ChiTietLoai->id }}" data-loai-id="{{ $ChiTietLoai->loai_id }}">{{ $ChiTietLoai->ten }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="mau[]">
                                    <option></option>
                                    @foreach($mau as $Mau)
                                        <option value="{{ $Mau->id }}">{{ $Mau->ten }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="size[]">
                                    <option></option>
                                    @foreach($size as $Size)
                                        <option value="{{ $Size->id }}">{{ $Size->ten }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="chat_lieu[]">
                                    <option></option>
                                    @foreach($chat_lieu as $ChatLieu)
                                        <option value="{{ $ChatLieu->id }}">{{ $ChatLieu->ten }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="kieu_do[]">
                                    <option></option>
                                    @foreach($kieu_do as $KieuDo)
                                        <option value="{{ $KieuDo->id }}">{{ $KieuDo->ten }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <!-- <td><textarea rows="4" cols="50" name="Thong_Tin[]"></textarea></td> -->
                            <td><button class="btn btn-outline-danger" type="button" onclick="removeRow(this)">Xoá</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row mt-3">
                <div class="col-sm-10"></div>
                <div class="col-sm-2">
                    <div class="phantrang"></div>
                </div>
            </div>
            <button class="btn btn-outline-primary mt-3" type="button" onclick="add()">THÊM HÀNG</button>
            <button class="btn btn-outline-success mt-3" type="submit">LƯU</button>
        </div>
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    function add() {
        const row = `
            <tr>
                <td><input name="ma[]" type="text"></td>
                <td><input name="ten[]" type="text"></td>
                <td>
                    <select name="nha_cung_cap[]">
                        <option></option>
                        @foreach($nha_Cung_Cap as $Nha_Cung_Cap)
                            <option value="{{ $Nha_Cung_Cap->id }}">{{ $Nha_Cung_Cap->ten }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input name="so_Luong[]" type="number"></td>
                <td><input name="gia_Nhap[]" type="number"></td>
                <td><input name="gia_Ban[]" type="number"></td>
                <td>
                    <select name="loai[]" class="loai-select">
                        <option></option>
                        @foreach($loai as $Loai)
                            <option value="{{ $Loai->id }}">{{ $Loai->ten }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="chi_tiet_loai[]" class="chi-tiet-loai-select">
                        <option></option>
                        @foreach($chi_tiet_loai as $ChiTietLoai)
                            <option value="{{ $ChiTietLoai->id }}" data-loai-id="{{ $ChiTietLoai->loai_id }}">{{ $ChiTietLoai->ten }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="mau[]">
                        <option></option>
                        @foreach($mau as $Mau)
                            <option value="{{ $Mau->id }}">{{ $Mau->ten }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="size[]">
                        <option></option>
                        @foreach($size as $Size)
                            <option value="{{ $Size->id }}">{{ $Size->ten }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="chat_lieu[]">
                        <option></option>
                        @foreach($chat_lieu as $ChatLieu)
                            <option value="{{ $ChatLieu->id }}">{{ $ChatLieu->ten }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="kieu_do[]">
                        <option></option>
                        @foreach($kieu_do as $KieuDo)
                            <option value="{{ $KieuDo->id }}">{{ $KieuDo->ten }}</option>
                        @endforeach
                    </select>
                </td>
                <td><button class="btn btn-outline-danger" type="button" onclick="removeRow(this)">Xoá</button></td>
            </tr>
        `;
        $('table tbody').append(row);
        bindLoaiChangeEvent();
    }

    function removeRow(button) {
        $(button).closest('tr').remove();
    }

    function bindLoaiChangeEvent() {
        $('.loai-select').off('change').on('change', function() {
            const loaiId = $(this).val();
            const chiTietLoaiSelect = $(this).closest('tr').find('.chi-tiet-loai-select');
            chiTietLoaiSelect.find('option').hide();
            chiTietLoaiSelect.find('option[data-loai-id="' + loaiId + '"], option[value=""]').show();
            chiTietLoaiSelect.val('');
        });
    }

    $(document).ready(function() {
        bindLoaiChangeEvent();
    });
</script>

@if(session('thong_bao'))
    <script src="{{ asset('sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script>
        Swal.fire({
            icon: "error",
            title: "THÔNG BÁO",
            text: "{{ session('thong_bao') }}",
        });
    </script>
@endif
@endsection

@section('chon')
<a href="/" class="nav-item nav-link "><i class="fa fa-tachometer-alt me-2"></i>THỐNG KÊ</a>
<a href="{{ Route('san-pham.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-laptop me-2"></i>SẢN PHẨM</a>
<a href="{{ Route('loai.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>LOẠI</a>
                    <a href="{{ Route('mau.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>MÀU</a>
                    <a href="{{ Route('size.danh-sach') }}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>SIZE</a>
                    <a href="{{ Route('chat-lieu.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-chart-bar me-2"></i>CHẤT LIỆU</a>
                    <a href="{{ Route('kieu-do.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-chart-bar me-2"></i>KIỂU ĐỒ</a>

                    <a href="{{ Route('nha-cung-cap.danh-sach') }}" class="nav-item nav-link "><i class="fa fa-home me-2"></i>NHÀ CUNG CẤP</a>


                    <div class="nav-item dropdown ">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="fa fa-th me-2"></i>NHẬP HÀNG</a>
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
