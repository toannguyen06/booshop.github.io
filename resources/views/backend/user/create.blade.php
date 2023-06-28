@extends('backend.layouts.main')
@section('title')
    Admin | Thêm mới người dùng
@endsection
@section('page-title')
    Thêm mới người dùng
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{url('admin/users')}}" class="">
                @csrf
                <div class="form-group">
                    <label>Email:</label>
                    <input type="text" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror"/>
                    @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Mật khẩu:</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"/>
                    @error('password')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Vai trò:</label>
                    <select name="role" id="" class="form-select @error('role') is-invalid @enderror">
                        <option value="2" {{old('role') == 2 ? 'selected' : ''}} {{Auth::user()->role == 'Admin' ? 'disabled' : ''}}>Admin</option>
                        <option value="3" {{old('role') == 3 ? 'selected' : ''}} >User</option>
                    </select>
                    @error('role')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Point:</label>
                    <input type="text" name="point" value="{{old('point') ? old('point') : 0}}" class="form-control @error('point') is-invalid @enderror"/>
                    @error('point')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
@endsection
