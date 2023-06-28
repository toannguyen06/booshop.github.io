@extends('backend.layouts.main')

@section('title')
    Admin | Thêm hồ sơ người dùng
@endsection
@section('page-title')
    Thêm hồ sơ người dùng
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{url('admin/users/'.$userId.'/information')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Họ và tên</label>
                    <input type="text" name="fullname" id="" class="form-control">
                </div>
                <div class="form-group d-flex">
                    <div class="col-md-4" style="margin-right: 50px">
                        <label>Ngày sinh </label> 
                        <input type="date" class="form-control date-inputmask" name="date_of_birth" id="date-mask"  />
                    </div>
                    <div class="col-md-4">
                        <label for="example-email" class="col-md-12">Giới tính</label>
                        <div class="d-flex">
                            <div class="form-check" style="margin-right: 30px">
                                <input type="radio" class="form-check-input" id="male" name="gender" value="1" />
                                <label class="form-check-label mb-0" for="male">Nam</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="female" name="gender" value="2" />
                                <label class="form-check-label mb-0" for="female">Nữ</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 mb-0">Phone No</label>
                    <div class="col-md-12">
                        <input type="text"  name="phone" id="phone-mask" class="form-control phone-inputmask form-control-line" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 mb-0">Địa chỉ</label>
                    <div class="col-md-12">
                        <input type="text"  name="address" class="form-control ps-0 form-control-line" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 mb-0">Avatar</label>
                    <div class="col-md-12">
                        <input type="file"  name="avatar" class="form-control ps-0 form-control-line" />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thêm thông tin</button>
                <a href="{{url('admin/users')}}" class="btn btn-secondary">Bỏ qua</a>
            </form>
        </div>
    </div>
@endsection