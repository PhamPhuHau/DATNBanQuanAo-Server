<div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Danh sách</h6>
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
                                    <th scope="col">TRẠNG THÁI</th>
                                </tr>
                            </thead>
                            @foreach($san_Pham as $SanPham)
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
                                    <td>{{ $SanPham->trang_thai}}</td>

                                    <td><a class="btn btn-outline-dark" href="{{ route('san-pham.chi-tiet-san-pham',['id'=>$SanPham->id]) }}">Chi tiết</a>
                                    <a class="btn btn-outline-primary" onclick="them({{ $SanPham->id }}, '{{ $SanPham->ten }}')">Cập nhật</a>
                                    <a class="btn btn-outline-danger" href="{{ route('san-pham.xoa',['id'=>$SanPham->id]) }}">Xóa</a>

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
                        {{ $san_Pham->links() }}
                        </div>
                            </div>

                        </div>



                    </div>

                </div>
</div>