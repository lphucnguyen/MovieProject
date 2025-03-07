@extends('layouts.web.app')
@section('content')
    @push('style')
        <link href="{{asset('web_files/css/bootstrap-fileinput.css')}}" rel="stylesheet">
    @endpush

    <div class="hero common-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>{{$user->first_name . ' ' . $user->last_name}}</h1>
                        <ul class="breadcumb">
                            <li class="active"><a href="#">{{ __('Trang chủ') }}</a></li>
                            <li><span class="ion-ios-arrow-right"></span>{{ __('Hồ sơ') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-single">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="user-information">
                        <div style="margin: 0" class="user-img">
                            <a href="#"><img alt="" src="{{$user->avatar}}"
                                             style="width: 150px; height: 150px; border-radius: 50%"><br></a>
                        </div>
                        <div class="user-fav">
                            <p>{{ __('Chi tiết tài khoản') }}</p>
                            <ul>
                                <li class="active"><a href="{{url('user/profile')}}">{{ __('Hồ sơ') }}</a></li>
                                <li><a href="{{url('user/favorites')}}">{{ __('Phim yêu thích') }}</a></li>
                                <li><a href="{{url('user/ratings')}}">{{ __('Phim đã đánh giá') }}</a></li>
                                <li><a href="{{url('user/reviews')}}">{{ __('Phim đã bình luận') }}</a></li>
                                <li><a href="{{url('user/upgrade-account')}}">{{ __('Nâng cấp thành viên') }}</a></li>
                                <li><a href="{{url('user/orders')}}">{{ __('Lịch sử giao dịch') }}</a></li>
                            </ul>
                        </div>
                        <div class="user-fav">
                            <p>{{ __('Cài đặt') }}</p>
                            <ul>
                                <li><a href="{{url('user/change_password/')}}">{{ __('Thay đổi mật khẩu') }}</a></li>
                                <li><a href="{{route('logout')}}">{{ __('Đăng xuất') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div action="#" class="form-style-1 user-pro">
                        <h4>{{ __('Thông tin chi tiết') }}</h4>
                        <form action="{{url('user/profile/' . $user->id)}}" method="POST" class="user"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 form-it">
                                    <label>{{ __('Username') }}</label>
                                    <input name="username" value="{{$user->username}}" placeholder="UserName"
                                           type="text" disabled>
                                    @error('username')
                                    <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-it">
                                    <label>{{ __('Địa chỉ email') }}</label>
                                    <input name="email" value="{{$user->email}}" placeholder="Email" type="email" disabled>
                                    @error('email')
                                    <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-it">
                                    <label>{{ __('Họ') }}</label>
                                    <input name="first_name" value="{{$user->first_name}}" placeholder="{{ __('First Name') }}"
                                           type="text">
                                    @error('first_name')
                                    <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-it">
                                    <label>{{ __('Tên') }}</label>
                                    <input name="last_name" value="{{$user->last_name}}" placeholder="{{ __('Last Name')}}"
                                           type="text">
                                    @error('last_name')
                                    <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-it">
                                    <label>{{ __('Thay đổi Avatar') }}</label>
                                    <div class="row">
                                        <div style="margin-left: 15px" class="form-group last">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail"
                                                     style="width: 200px; height: 150px;">
                                                    <img alt="" src="{{$user->avatar}}"/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                     style="max-width: 200px; max-height: 150px;">
                                                </div>
                                                <div>
												<span class="btn btn-dark btn-file">
													<span class="fileinput-new"
                                                          style="color: white; border: thin solid white; border-radius: 5px; padding: 6px;"> {{ __('Chọn hình ảnh') }} </span>
													<span class="fileinput-exists"
                                                          style="color: dodgerblue; border: thin solid dodgerblue;border-radius: 5px; padding: 6px; margin-right: 6px; margin-top: 6px"> {{ __('Thay đổi') }} </span>
													<input name="avatar" value="{{$user->avatar}}" type="file">
												</span>
                                                    <a class="btn btn-red fileinput-exists" data-dismiss="fileinput"
                                                       style="color: red; border: thin solid red;border-radius: 5px; padding: 6px;">{{ __('Xoá') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('avatar')
                                    <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <input class="submit" type="submit" value="{{ __('Lưu') }}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{asset('web_files/js/bootstrap-fileinput.js')}}"></script>
    @endpush

@endsection