@extends('backend.layouts.table')

@section('title')
Admin | Quản lý sản phẩm
@endsection
@section('page-title')
Danh sách sản phẩm
@endsection
@section('create')
<a href="{{url('admin/products/create')}}" class="btn btn-primary" style="margin-bottom: 16px">Thêm mới sản phẩm</a>
@endsection
@section('table')
    <thead>
        <tr>
            <th>Mã sản phẩm</th>
            <th style="max-width: 400px">Tên sản phẩm</th>
            <th>Số lượng hàng</th>
            <th>Giá</th>
            {{-- <th>Chương trình khuyến mãi</th> --}}
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{$product->product_code}}</td>
                <td class="d-flex"> 
                    <img src="{{asset('storage/products/'.$product->image[0]->path)}}" style="width: 60px; margin-right: 6px;" alt="">
                    {{$product->information->name}}
                </td>
                <td>{{$product->quantity}}</td>
                @if ($product->price_sale)
                    <td>
                        <span class="text-success">{{$product->price_sale_format}} đ</span>
                        <span style="text-decoration-line: line-through">{{$product->price_format}} đ</span>
                    </td>
                @else
                    <td>{{$product->price_format}} đ</td>
                @endif
                <td>
                    <a class="btn btn-primary" href="{{ url('admin/products/'.$product->id.'/edit')}}">Edit</a>
                    <form method="POST" action="{{url('admin/products/'.$product->id)}}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
@endsection
