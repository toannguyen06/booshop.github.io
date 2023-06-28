@extends('backend.layouts.table')

@section('title')
Admin | Quản lý danh mục con
@endsection

@section('page-title')
Quản lý danh mục con
@endsection
@section('create')
<a href="{{url('admin/sub_categories/create')}}" style="margin-bottom: 16px" class="btn btn-primary">Thêm mới danh mục con</a>
@endsection
@section('table')
    <thead>
        <tr>
            <th>Id</th>
            <th>Tên danh mục</th>
            <th>Danh mục cha</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sub_categories as $sub_category)
            <tr>
                <td>{{$sub_category->id}}</td>
                <td>{{$sub_category->name}}</td>
                <td>{{$sub_category->category->name}}</td>
                <td>
                    <a class="btn btn-primary" href="{{ url('admin/sub_categories/'.$sub_category->id.'/edit')}}">Edit</a>
                    <form method="POST" action="{{url('admin/sub_categories/'.$sub_category->id)}}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
@endsection
