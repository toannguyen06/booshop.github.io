<<<<<<< HEAD
@extends('backend.layouts.table')
@section('title')
    Admin | Thêm mới khuyến mãi
@endsection
@section('page-title')
    Thêm mới khuyến mãi
@endsection
@section('content')
    <div class="container">
        <form method="POST" action="{{url('admin/promotions')}}">
            @csrf
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Description:</label>
                <input type="text" name="description" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Sale:</label>
                <input type="text" name="sale" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Date Expired:</label>
                <input type="date" class="form-control date-inputmask" name="date_expired" id="date-mask" />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
=======
@extends('backend.layouts.main')
@section('title')
    Admin | Thêm mới chương trình khuyến mãi
@endsection
@section('page-title')
Thêm mới chương trình khuyến mãi
@endsection
@section('content')
    <div class="container">
        <form method="POST" action="{{url('admin/promotions')}}" class="">
            @csrf
            <div class="form-group">
                <label>Tên chương trình:</label>
                <input type="text" name="name" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Mô tả chương trình:</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Mức giảm giá (%):</label>
                    <input type="text" name="sale" class="form-control"/>
                </div>
                <div class="form-group col-md-6">
                    <label>Ngày hết hạn:</label>
                    <input type="date" name="date_expired" class="form-control"/>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
>>>>>>> toannguyen
        </form>
    </div>
@endsection
