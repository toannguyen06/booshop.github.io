@extends('backend.layouts.table')

@section('title')
<<<<<<< HEAD
    Admin | Danh sách khuyến mãi
@endsection
@section('page-title')
    Danh sách khuyến mãi
@endsection

@push('css')
    <link rel="stylesheet" href="#" />
@endpush

@section('create')
    <a href="{{url('admin/promotions/create')}}" class="btn btn-primary" style="margin-bottom: 16px">Thêm mới khuyến mãi</a>
@endsection

@push('js')

@endpush

@section('table')
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
        <th>Sale</th>
        <th>Date Expired</th>
        <th></th>
    </tr>
    @foreach ($promotions as $promotion)
        <tr>
            <td>{{$promotion->id}}</td>
            <td>{{$promotion->name}}</td>
            <td>{{$promotion->description}}</td>
            <td>{{$promotion->sale}}</td>
            <td>{{$promotion->date_expired}}</td>
            <td>
                <a class="btn btn-primary" href="{{ url('admin/promotions/'.$promotion->id)}}">Show</a>
                <a class="btn btn-primary" href="{{ url('admin/promotions/'.$promotion->id.'/edit')}}">Edit</a>
                <form method="POST" action="{{url('admin/promotions/'.$promotion->id)}}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
@endsection()
=======
Admin | Danh sách khuyến mãi
@endsection
@section('page-title')
Danh sách khuyến mãi
@endsection
@section('create')
<a href="{{url('admin/promotions/create')}}" style="margin-bottom: 16px" class="btn btn-primary">Thêm mới khuyến mãi</a>
@endsection

@section('table')
    <thead>
        <tr>
            <th>ID</th>
            <th>Tên chương trình</th>
            <th>Mô tả</th>
            <th>Mức giảm giá</th>
            <th>Ngày hết hạn</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($promotions as $promotion)
            <tr>
                <td>{{$promotion->id}}</td>
                <td>{{$promotion->name}}</td>
                <td>{{$promotion->description}}</td>
                <td>{{$promotion->sale}}</td>
                <td>{{$promotion->date_expired}}</td>
                <td>
                    <a class="btn btn-primary" href="{{ url('admin/promotions/'.$promotion->id.'/edit')}}">Edit</a>
                    <form method="POST" action="{{url('admin/promotions/'.$promotion->id)}}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        
    </tbody>
@endsection
>>>>>>> vantoan
