@extends('frontend.layouts.main')
@section('title')
Danh sách đơn hàng
@endsection

@section('page-title')
Danh sách đơn hàng
@endsection

@section('content')
<table style="width: 100%">
<thead>
    <tr>
        <th>Mã đơn hàng</th>
        <th>Ngày tạo</th>
        <th>Người mua</th>
        <th>Trạng thái</th>
        <th>Tổng giá</th>
        <th></th>
    </tr>
</thead>
<tbody>
    @foreach ($orders as $order)
    <tr>
        <td>{{$order->id}}</td>
        <td>{{$order->date}}</td>
        <td>{{$order->user->email}}</td>
        <td>{{$order->state_char}}</td>
        <td>{{$order->price}}</td>
        <td>
            <a class="btn btn-primary" href="{{ url('orders/'.$order->id)}}">Xem chi tiết</a>
            @if ($order->state == 1 || $order->state == 2)
                <form method="POST" action="{{url('orders/'.$order->id)}}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
</table>
@endsection
