@extends('frontend.layouts.main')

@section('title')
Chi tiết đơn hàng
@endsection

@section('page-title')
Chi tiết đơn hàng
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <h3><b>MÃ ĐƠN HÀNG</b> <span class="pull-right">#{{$order->id}}</span></h3>
        <hr />
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <address>
                        <h3>Người mua</h3>
                        <h4 class="font-bold">{{$order->user->information->fullname}}</h4>
                        <p class="text-muted">
                            Email: {{$order->user->email}} <br />
                            Số điện thoại: {{$order->user->information->phone}} <br />
                            Địa chỉ: {{$order->user->information->address}} <br />
                        </p>
                        <p class="mt-4">
                            <b>Ngày đặt hàng :</b>
                            <i class="mdi mdi-calendar"></i> {{$order->created_at}}
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
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($order->product as $product)
                                <tr>
                                    <td class="text-center">{{$product->product_code}}</td>
                                    <td class="d-flex">
                                        <img src="{{asset('/storage/products/'.$product->image[0]->path)}}" alt="" width="80">
                                        <p class="ms-2">{{$product->information->name}}</p>
                                    </td>
                                    <td class="text-end">{{$product->pivot->quantity}}</td>
                                    <td class="text-end">{{$product->price}} VNĐ</td>
                                    <td class="text-end">{{$product->pivot->quantity * $product->price}} VNĐ</td>
                                </tr>
                                @php
                                    $total += $product->pivot->quantity * $product->price;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-12">
                <div class="pull-right mt-4 text-end">
                    <p>Tổng giá: {{$total}} VNĐ</p>
                    {{-- <p>vat (10%) : {{ceil($total / 10)}} VNĐ</p> --}}
                    <hr />
                    <h3><b>Thành tiền :</b> {{$total}} VNĐ</h3>
                </div>
                <div class="clearfix"></div>
                <hr />
                {{-- <div class="text-end">
                    @if ($order->state == 0)
                        <form action="{{url('admin/orders/'.$order->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger" name="cancel" value="1">Hủy đơn hàng</button>
                            <button type="submit" class="btn btn-success" name="browse" value="1">Duyệt đơn hàng</button>
                        </form>
                    @else
                        <a href="{{url('admin/orders')}}" class="btn btn-secondary">Trở về</a>
                    @endif

                </div> --}}
            </div>
        </div>
    </div>
</div>

@endsection

