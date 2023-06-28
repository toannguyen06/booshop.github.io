@extends('frontend.me.main')
@section('title')
Đổi mật khẩu
@endsection
@section('page-title')
Đổi mật khẩu
@endsection
@section('me-content')
<div class="col-lg-8 col-xlg-9 col-md-7">
    <div class="card">
        <div class="card-body">
            @if (Session::has('errors'))
            <h5 class="text-danger">{{Session::get('errors')}}</h5>
            @endif
            <form action="{{ url('/changepassword')}}" class="form-horizontal form-material" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Nhập mật khẩu của bạn:</label>
                    <input type="password" class="form-control form-control-line" name="old_pass" id="">
                </div>
                <div class="form-group">
                    <label for="">Nhập mật khẩu mới:</label>
                    <input type="password" class="form-control form-control-line" name="new_pass" id="">
                </div>
                <div class="form-group">
                    <label for="">Nhập lại mật khẩu mới:</label>
                    <input type="password" class="form-control form-control-line" name="re_new_pass" id="">
                </div>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </form>
        </div>
    </div>
</div>

@endsection
