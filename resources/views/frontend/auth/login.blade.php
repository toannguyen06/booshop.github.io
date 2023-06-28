@extends('frontend.layouts.main')

@section('title')
Đăng nhập
@endsection

@section('content')
<div class="content">
    <div class="account_grid">
        <div class="login-right">
            <h3>ĐĂNG NHẬP</h3>
            @if (Session::has('fail'))
                <div class="text-danger">{{Session::get('fail')}} </div>
            @endif
            <form action="{{url('/login')}}" method="POST">
                @csrf
                <div class="form-group">
                    <span>Email<label>*</label></span>
                    <input type="text" name="email" class="" />
                    @error('email')
                        <div class="text-danger" >{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <span>Mật khẩu<label>*</label></span>
                    <input type="password" name="password" class="" />
                    @error('password')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                {{-- <a class="forgot" href="#">Quên mậy khẩu?</a> <br> <br> --}}
                <input type="submit" value="ĐĂNG NHẬP" />
            </form>
        </div>
        <div class="login-left">
            <h3>TẠO TÀI KHOẢN NGƯỜI DÙNG MỚI</h3>
            <p>Tạo tài khoản giúp bạn có thể thanh toán nhanh và dễ dàng hơn, ngoài ra giúp bạn kiểm tra các đơn hàng đã mua</p>
            <a class="acount-btn" href="{{url('/register')}}">ĐĂNG KÝ</a>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection