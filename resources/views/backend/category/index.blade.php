@extends('backend.layouts.table')

@section('title')
    Quản lý danh mục
@endsection

@section('page-title')
    Danh sách danh mục
@endsection
@section('create')
    <a href="{{url('admin/categories/create')}}" class="btn btn-primary" style="margin-bottom: 16px">Thêm mới danh mục</a>
@endsection
@section('table')

<thead>
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th></th>
    </tr>
</thead>
<tbody>
    @foreach ($categories as $category)
    <tr>
        <td>{{$category->id}}</td>
        <td>{{$category->name}}</td>
        <td>
            <a class="btn btn-primary" href="{{ url('admin/categories/'.$category->id.'/edit')}}">Edit</a>
            <form method="POST" action="{{url('admin/categories/'.$category->id)}}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach

</tbody>


@endsection()


