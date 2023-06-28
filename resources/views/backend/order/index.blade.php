@extends('backend.layouts.table')
@section('title')
Danh sách đơn hàng
@endsection

@section('page-title')
Danh sách đơn hàng
@endsection

@section('table')
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
        <td>{{$order->created_at}}</td>
        <td>{{$order->user->email}}</td>
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
            <a class="btn btn-primary" href="{{ url('admin/orders/'.$order->id)}}">Xem chi tiết</a>
            {{-- @if ($order->state == 1 || $order->state == 2)
                <form method="POST" action="{{url('admin/orders/'.$order->id)}}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            @endif --}}
        </td>
    </tr>
    @endforeach
</tbody>
@endsection
