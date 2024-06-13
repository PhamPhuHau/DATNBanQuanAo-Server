<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{asset('img/favicon.ico')}}" rel="icon">

    <!-- Google Web Fonts -->
    

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">DANH SÁCH HOÁ ĐƠN</h6>
                        <select onchange="window.location.href=this.value">
                        <option></option>
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
                                    <th>TRẠNG THÁI</th>
                                </tr>
                            </thead>
                            @foreach($hoaDon as $HoaDon)
                            <tbody>
                                <tr>
                                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                    <td style="width: 25%;">{{ $HoaDon->id }}</td>
                                    
                                    <td>{{ $HoaDon->khach_hang->ho_ten }}</td>
                                    <td>{{ $HoaDon->tong_tien }}</td>
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