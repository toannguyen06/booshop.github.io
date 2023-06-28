@extends('backend.layouts.main')
@section('title')
Admin | Chỉnh sửa thông tin người dùng
@endsection
@section('page-title')
Chỉnh sửa thông tin người dùng
@endsection

@section('content')
<form action="{{url('admin/users/'.$user->id)}}" method="post" id="user-form" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Thông tin tài khoản
                </div>
                
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" disabled name="email" class="form-control" value="{{$user->email}}"/>
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu mới:</label>
                        <input type="password" name="password" class="form-control" value=""/>
                    </div>
                    <div class="form-group">
                        <label>Vai trò:</label>
                        <select name="role" id="" class="form-select">
                            <option value="2" {{Auth::user()->role == 'Admin' ? 'disabled' : ''}} {{$user->role == 'Admin' ? 'checked' : ''}}>Admin</option>
                            <option value="3" {{$user->role == 'User' ? 'checked' : ''}} >User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Point:</label>
                        <input type="text" name="point" class="form-control @error('point') is-invalid @enderror" value="{{old('point') ? old('point') : $user->point}}"/>
                        @error('point')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Thông tin hồ sơ người dùng
                </div>
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" name="fullname" id="" value="{{$user->information->fullname}}" class="form-control">
                </div>
                <div class="form-group d-flex">
                    <div class="col-md-4" style="margin-right: 50px">
                        <label>Ngày sinh </label> 
                        <input type="date" class="form-control date-inputmask" value="{{$user->information->date_of_birth}}" name="date_of_birth" id="date-mask"  />
                    </div>
                    <div class="col-md-4">
                        <label for="example-email" class="col-md-12">Giới tính</label>
                        <div class="d-flex">
                            <div class="form-check" style="margin-right: 30px">
                                <input type="radio" class="form-check-input" id="male" name="gender" value="1" {{$user->information->gender == 1 ? 'checked' : ''}}  />
                                <label class="form-check-label mb-0" for="male">Nam</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="female" name="gender" value="2" {{$user->information->gender == 2 ? 'checked' : ''}} />
                                <label class="form-check-label mb-0" for="female">Nữ</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 mb-0">Phone No</label>
                    <div class="col-md-12">
                        <input type="text"  name="phone" id="phone-mask" value="{{$user->information->phone}}" class="form-control phone-inputmask form-control-line" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 mb-0">Địa chỉ</label>
                    <div class="col-md-12">
                        <input type="text"  name="address" value="{{$user->information->address}}" class="form-control" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="">Avatar</label>
                    <input type="file" name="avatar" onchange="load(this)" id="upload" class="form-control">
                </div>
                <div class="file-upload-content">
                    @if ($user->information->avatar)
                        <img src="{{asset('storage/avatars/'.$user->information->avatar)}}" width="80" alt="">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-primary" type="submit" id="submit">Lưu thay đổi</button>
</form>
@endsection
@push('js')

<script>
    $(".select2").select2();

    function load(input){
        $('.file-upload-content').html('');
        
        var reader = []
        var html = ""
        for (i = 0; i < input.files.length; i++){

            reader[i] = new FileReader()
            reader[i].onload = function(e){
            html = `<img src="${e.target.result}" alt="" class="file-upload-image" style="margin-right: 8px" width="80px">`
            $('.file-upload-content').append(html);
            }
            reader[i].readAsDataURL(input.files[i]);
        }
        
    }
    
</script>
@endpush
