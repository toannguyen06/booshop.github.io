@extends('backend.layouts.table')
@section('title')
    Admin | Thêm mới danh mục
@endsection
@section('page-title')
    Thêm mới danh mục
@endsection
@section('content')
    <div class="container">
        <form method="POST" action="{{url('admin/categories')}}" class="">
            @csrf
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"/>
                @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
