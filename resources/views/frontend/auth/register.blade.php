@extends('frontend.layouts.main')

@section('title')
Đăng ký
@endsection
@push('css')
    <style>
        div.text-danger{
            margin-bottom: 8px;
        }
    </style>
@endpush
@section('content')
<div class="content">
    <div class="register">
        <form action="{{url('/register')}}" method="POST">
            @csrf
            <div class="register-top-grid">
                <h3>Thông tin tài khoản *</h3>
                <div class="mation">
                    <span>Email<label>*</label></span>
                    <input type="text" name="email" value="{{old('email')}}" />
                    @error('email')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    <span>Mật khẩu<label>*</label></span>
                    <input type="password" name="password" />
                    @error('password')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                    <span>Nhập lại mật khẩu<label>*</label></span>
                    <input type="password" name="re-password" />
                    @error('re-password')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="register-bottom-grid">
                <h3>Thông tin cá nhân</h3>
                <div class="mation">
                    <span>Họ và tên</span>
                    <input type="text" name="fullname" value="{{old('fullname')}}"/>
                    <div class="row" style="width: 85%">
                        <div class="form-group col-md-6">
                            <span>Giới tính</span>
                            <input type="radio" class="" name="gender" id="male" value="1" {{old('gender') == 1 ? 'checked' : ''}}/>
                            <label for="male" style="font-size: 14px; font-weight: normal; margin-right: 4px">Nam</label>
                            <input type="radio" class="" name="gender" id="female" value="2" {{old('gender') == 2 ? 'checked' : ''}} />
                            <label for="female" style="font-size: 14px; font-weight: normal">Nữ</label>
                        </div>
    
                        <div class="form-group col-md-6">
                            <span>Ngày sinh</span>
                            <input type="date" class="form-control" name="date_of_birth" id="" value="{{old('date_of_birth')}}" >
                        </div>
                    </div>
                    <span>Địa chỉ</span>
                    <input type="text" name="address" value="{{old('address')}}" />
                    <span>Số điện thoại</span>
                    <input type="text" name="phone" value="{{old('phone')}}"/>
    
                </div>
                <div class="clearfix"></div>
                <button type="submit" class="btn-primary">ĐĂNG KÝ</button>
                {{-- <a class="news-letter" href="#">
                    <label class="checkbox"><input type="checkbox" name="checkbox" checked="" /><i> </i>Sign Up</label>
                </a> --}}
            </div>
        </form>
        
    </div>
</div>

@endsection