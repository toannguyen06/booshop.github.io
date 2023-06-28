@extends('frontend.layouts.nosidebar')

@push('link-css')
{{-- <link rel="stylesheet" href="{{asset('dist/css/style_profile.min.css')}}"> --}}
@endpush
@push('css')
    <style>
        .scroll-sidebar{
            padding-top: 0;
        }
        .avatar-container{
            position: relative;
            width: 150px;
            margin: auto;
            overflow: hidden;
        }

        #upload-form{
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            display: none;
            background-color: white;

        }
        .avatar-container:hover #upload-form{
            display: flex;
            background-color: rgba(129, 236, 236, .5);
        }
        .upload-icon{
            font-size: 30px;
            color: rgb(9, 132, 227);
        }
        #upload{
            display: none;
        }
        .nav-pills .nav-link{
            background: none;
            border: 0;
            outline: none;
        }
    </style>
@endpush
@section('title')
    Hồ sơ người dùng
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="content">
            <div class="avatar-container rounded-circle my-4">
                @if (Auth::user()->information->avatar)
                <img src="{{asset('storage/avatars/'.Auth::user()->information->avatar)}}" class="rounded-circle" width="150" height="150" />

                @else
                <img src="{{asset('assets/images/users/user.jpg')}}" class="rounded-circle" width="150" />
                @endif
                <form action="{{url('admin/avatar/'.Auth::user()->id)}}" id="upload-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="upload" id="upload-label">
                        <i class="fas fa-upload upload-icon"></i>
                    </label>
                    <input type="file" name="avatar" id="upload">
                </form>
            </div>
            <h4 class="text-center mt-2">{{Auth::user()->information->fullname}}</h4>
            <div class="d-flex justify-content-center mb-4">
                <div class="mx-4">
                    <i class="mdi mdi-coin" aria-hidden="true"></i>
                    <span class="font-normal">{{Auth::user()->point}} Point</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="content p-2">
            <div class="d-flex justify-content-between mt-3">
                <h4 style="margin: 0">Hồ sơ người dùng</h4>
                <ul class="nav nav-pills" id="pills-tab" role="tablist" >
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-detail-tab" data-bs-toggle="pill" data-bs-target="#pills-detail" type="button" role="tab" aria-controls="pills-detail" aria-selected="true">Thông tin cá nhân</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-change-tab" data-bs-toggle="pill" data-bs-target="#pills-change" type="button" role="tab" aria-controls="pills-change" aria-selected="false">Đổi mật khẩu</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-orders-tab" data-bs-toggle="pill" data-bs-target="#pills-orders" type="button" role="tab" aria-controls="pills-orders" aria-selected="false">Lịch sử đặt hàng</button>
                    </li>
                </ul>
            </div>
            <hr>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-detail" role="tabpanel" aria-labelledby="pills-detail-tab">
                    <form class="mx-4 my-4" method="POST" action="{{url('profile')}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-2">
                            <label class="">Họ và tên:</label>
                            <input type="text" value="{{Auth::user()->information->fullname}}" name="fullname" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <label for="example-email" class="">Email:</label>
                            <input type="text" disabled value="{{Auth::user()->email}}" class="form-control" name="email" id="example-email" />
                        </div>
                        <div class="form-group mb-2 d-flex">
                            <div class="col-md-4">
                                <label for="example-email" class="col-md-12 mb-0">Giới tính:</label>
                                <div class="d-flex">
                                    <div class="form-check" style="margin-right: 30px">
                                        <input type="radio" class="form-check-input" id="male" name="gender" value="1" {{Auth::user()->information->gender == 1 ? 'checked' : ''}} />
                                        <label class="form-check-label mb-0" for="male">Nam</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" id="female" name="gender" value="2" {{Auth::user()->information->gender == 2 ? 'checked' : ''}}  />
                                        <label class="form-check-label mb-0" for="female">Nữ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-right: 50px">
                                <label class=" mb-0">Ngày sinh: </label>
                                <input type="date" class="form-control date-inputmask" name="date_of_birth" id="date-mask" value="{{Auth::user()->information->date_of_birth}}" />
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label class="">Số điện thoại:</label>
                            <input type="text" value="{{Auth::user()->information->phone}}" name="phone" id="phone-mask" class="form-control" />
                        </div>
                        <div class="form-group mb-2">
                            <label class="">Địa chỉ:</label>
                            <input type="text" value="{{Auth::user()->information->address}}" name="address" class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-success mt-4">Cập nhật</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-change" role="tabpanel" aria-labelledby="pills-change-tab">
                    <h5 class="text-danger mx-4" id="changepass-error"></h5>
                    <div id="change-pass-form" class="mx-4">
                        <div class="form-group mb-2">
                            <label for="">Nhập mật khẩu của bạn:</label>
                            <input type="password" class="form-control" id="old_pass">
                        </div>
                        <div class="form-group mb-2">
                            <label for="">Nhập mật khẩu mới:</label>
                            <input type="password" class="form-control" id="new_pass">
                        </div>
                        <div class="form-group">
                            <label for="">Nhập lại mật khẩu mới:</label>
                            <input type="password" class="form-control" id="re_new_pass">
                        </div>
                        <button class="btn btn-success mt-4">Lưu thay đổi</button>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-orders" role="tabpanel" aria-labelledby="pills-orders-tab">
                    <table class="mx-4 table" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th>Tổng giá</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    @if ($order->state == 1)
                                        <span class="badge bg-success">Đã duyệt</span>
                                    @endif
                                    @if ($order->state == 0)
                                        <span class="badge bg-warning">Chưa duyệt</span>
                                    @endif
                                    @if ($order->state == 2)
                                        <span class="badge bg-danger">Hủy bỏ</span>
                                    @endif
                                </td>
                                <td>{{$order->price}} VNĐ</td>
                                <td>
                                    <button class="btn btn-primary" data-orderID="{{$order->id}}" data-bs-toggle="modal" data-bs-target="#orderModal">Xem chi tiết</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>

                </div>
            </div>            
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')

    <script>
        $('#upload').change(function(){
            $('#upload-form').submit();
        })
    </script>
    <script>
        $('#change-pass-form button').click(function(){
            axios.put('/changepassword', {
            old_pass: $('#old_pass').val(),
            new_pass: $('#new_pass').val(),
            re_new_pass: $('#re_new_pass').val(),
        })
            .then((res) => {
                if (res.data.state){
                    swal("Thành công!", "Mật khẩu mới đã được cập nhật!", "success")
                    window.location.reload();
                } else {
                    $('#changepass-error').text(res.data.error)
                }
            })
            .catch((res) => {
                console.log(res);
            })
        })
        
    </script>
    <script>
        function loadOrder(data){
            var html = `<h3><b>MÃ ĐƠN HÀNG</b> <span class="pull-right">#${data.order.id}</span></h3>
                        <hr />
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <address>
                                        <h3>Người mua</h3>
                                        <h4 class="font-bold">${data.user.name}</h4>
                                        <p class="text-muted">
                                            Email: ${data.user.email} <br />
                                            Số điện thoại: <br />
                                            Địa chỉ: <br />
                                        </p>
                                        <p class="mt-4">
                                            <b>Ngày đặt hàng :</b>
                                            <i class="fas fa-calendar-alt"></i> ${data.order.date}
                                        </p>
                                    </address>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive mt-5" style="clear: both;">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 120px;">Mã sản phẩm</th>
                                                <th>Tên sản phẩm</th>
                                                <th class="text-end" style="width: 100px;">Số lượng</th>
                                                <th class="text-end">Đơn giá</th>
                                                <th class="text-end">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="pull-right mt-4 text-end">
                                    <p>Tổng giá: ${data.order.price} VNĐ</p>
                                    <hr />
                                    <h3><b>Thành tiền :</b> ${data.order.price} VNĐ</h3>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        
                        </div>`
            $('.modal-body').html(html);
            var html1 = '';
            data.products.forEach((item) => {
                html1 += `<tr>
                                <td class="text-center">${item.code}</td>
                                <td class="d-flex">
                                    <img src="/storage/products/${item.img}" alt="" width="80">
                                    <p class="ms-2">${item.name}</p>
                                </td>
                                <td class="text-end">${item.quantity}</td>
                                <td class="text-end">${item.price} VNĐ</td>
                                <td class="text-end">${item.quantity * item.price} VNĐ</td>
                            </tr>`
            })
            $('.modal-body tbody').html(html1)
        }
    </script>
    <script>
        var orderModal = document.getElementById('orderModal')
        orderModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var orderID = button.getAttribute('data-orderID')
            axios.get('orders/' + orderID)
                .then((res) => {
                    console.log(res.data);
                    loadOrder(res.data)
                })
                .catch((res) => {
                    console.log(res);
                })
        })
    </script>
@endpush
