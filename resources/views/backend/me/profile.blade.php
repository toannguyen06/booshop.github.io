@extends('backend.me.main')

@section('title')
Admin | Hồ sơ cá nhân
@endsection


@section('page-title')
Hồ sơ cá nhân
@endsection



@section('me-content')

<!-- Column -->
<div class="col-lg-8 col-xlg-9 col-md-7">
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal form-material mx-2" method="POST" action="{{url('admin/profile')}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="col-md-12 mb-0">Họ và tên</label>
                    <div class="col-md-12">
                        <input type="text" value="{{Auth::user()->information->fullname}}" name="fullname" class="form-control ps-0 form-control-line" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="example-email" class="col-md-12 mb-0">Email</label>
                    <div class="col-md-12">
                        <input type="text" disabled value="{{Auth::user()->email}}" class="form-control ps-0 form-control-line" name="email" id="example-email" />
                    </div>
                </div>
                <div class="form-group d-flex">
                    <div class="col-md-4" style="margin-right: 50px">
                        <label class=" mb-0">Ngày sinh </label> 
                        <input type="date" class="form-control date-inputmask" name="date_of_birth" id="date-mask" value="{{Auth::user()->information->date_of_birth}}" />
                    </div>
                    <div class="col-md-4">
                        <label for="example-email" class="col-md-12 mb-0">Giới tính</label>
                        <div class="d-flex">
                            <div class="form-check" style="margin-right: 30px">
                                <input type="radio" class="form-check-input" id="male" name="gender" value="1" {{Auth::user()->information->gender == 1 ? 'checked' : ''}} />
                                <label class="form-check-label mb-0" for="male">Nam</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" id="female" name="gender" value="2" {{Auth::user()->information->gender == 2 ? 'checked' : ''}}  />
                                <label class="form-check-label mb-0" for="female">Nữ</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 mb-0">Phone No</label>
                    <div class="col-md-12">
                        <input type="text" value="{{Auth::user()->information->phone}}" name="phone" id="phone-mask" class="form-control phone-inputmask form-control-line" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12 mb-0">Địa chỉ</label>
                    <div class="col-md-12">
                        <input type="text" value="{{Auth::user()->information->address}}" name="address" class="form-control ps-0 form-control-line" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12 d-flex">
                        <button class="btn btn-success mx-auto mx-md-0 text-white">
                            Cập nhật thông tin
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Column -->

@endsection
