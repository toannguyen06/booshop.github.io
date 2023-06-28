@extends('frontend.layouts.nosidebar')
@section('title')
    Thanh toán
@endsection
@push('css')
    <style>
        .product-name{
            font-size: 14px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3; /* number of lines to show */
            line-height: 16px;        /* fallback */
            height: 48px;
        }
    </style>
@endpush
@section('content')
<div class="content">
    <h3 class="mt-2 fw-bold">THANH TOÁN ĐƠN HÀNG</h3>
    <hr>
    <div class="row">
        <div class="col-md-3" style="border-right: 2px solid #f0f0f0">
            <div style="padding: 0 6px">
                <h5 class="fw-bold">Thông tin khách hàng</h5>
                <small>*Để tránh giao hàng không mong muôn,khách hàng nhập chính xác thông tin.</small>
                <div class="form-group mt-4">
                    <label for="">Họ và tên:</label>
                    <input type="text" name="fullname" id="" value="{{Auth::user()->information->fullname}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại:</label>
                    <input type="text" name="phone" id="" value="{{Auth::user()->information->phone}}" class="form-control">
                </div>
                <div class="form-group mb-4">
                    <label for="">Địa chỉ nhận hàng:</label>
                    <input type="text" name="address" id="" value="{{Auth::user()->information->address}}" class="form-control">
                </div>
            </div>
            
        </div>
        <div class="col-md-3" style="border-right: 2px solid #f0f0f0">
            <div style="padding: 0 6px">
                <h5 class="fw-bold">Phương thức thanh toán</h5>
                <select name="" id="" class="form-control mt-4">
                    <option value="">Thanh toán trực tiếp</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <h5 class="fw-bold mb-4">Kiểm tra đơn hàng</h5>
            <table class="table">
                <thead>
                    <tr style="font-size: 14px">
                        <th>Tên sản phẩm</th>
                        <th style="width: 80px">Số lượng</th>
                        <th style="width: 100px">Đơn giá</th>
                        <th style="width: 100px">Thành tiền</th>
                    </tr>
                </thead>
                <tbody style="font-size: 14px;">
                    @foreach ($cart->products as $product)
                        <tr>
                            <td class="d-flex">
                                <img src="{{asset('storage/products/'.$product['img'])}}" alt="" width="50px">
                                <p class="product-name ms-2">{{$product['name']}}</p>
                            </td>
                            <td>{{$product['quantity']}}</td>
                            <td>{{number_format($product['price'], 0, ",", ".")}} đ</td>
                            <td>{{number_format($product['price'] * $product['quantity'], 0, ",", ".")}} đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <p style="text-align: right">Tổng tiền: {{number_format($totalPrice, 0, ",", ".")}} đ</p> 
        </div>
    </div>
</div>
<div  style="text-align: center">
    <a id="payment" class="btn btn-success mt-4 btn-lg">Xác nhận thanh toán</a>
</div>

@endsection
@push('link-js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@push('js')
    <script>
        $('#payment').click(function(){
            axios.get('/order')
                .then(function(res){
                    swal("Thành công!", "Đơn hàng đang được phê duyệt!", "success")
                        .then((value) => {
                            window.location.assign("/")
                        })
                })
                .catch(function(res){
                    console.log(res);
                })
        })
    </script>
@endpush