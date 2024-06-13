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
                        <h6 class="mb-0">CHI TIẾT HOÁ ĐƠN</h6>
                        
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <!-- <th scope="col"><input class="form-check-input" type="checkbox"></th> -->
                                    <th scope="col">ID</th>
                                    <th scope="col">TÊN SẢN PHẨM</th>
                                    <th>MÀU</th>
                                    <th>SIZE</th>
                                    <th>SỐ LƯỢNG</th>
                                    <th>THÀNH TIỀN</th>
                                   
                            </thead>
                            @foreach($chiTietHoaDon as $HoaDon)
                            <tbody>
                                <tr>
                                    <!-- <td><input class="form-check-input" type="checkbox"></td> -->
                                  
                                    
                                    <td>{{ $HoaDon->id }}</td>
                                    <td>{{ $HoaDon->chi_tiet_san_pham->san_pham->ten }}</td>
                                    <td>{{ $HoaDon->chi_tiet_san_pham->mau->ten }}</td>
                                    <td>{{ $HoaDon->chi_tiet_san_pham->size->ten }}</td>
                                    <td> {{$HoaDon->so_luong}} </td>
                                    <td> {{$HoaDon->thanh_tien}} </td>
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