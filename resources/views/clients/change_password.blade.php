@extends('layouts.web.app')
@section('content')

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
                        <a href="#"><img alt="" src="{{$user->avatar}}" style="width: 150px; height: 150px; border-radius: 50%"><br></a>
                    </div>
                    <div class="user-fav">
                        <p>{{ __('Chi tiết tài khoản') }}</p>
                        <ul>
                            <li><a href="{{url('user/profile')}}">{{ __('Hồ sơ') }}</a></li>
                            <li><a href="{{url('user/favorites')}}">{{ __('Phim yêu thích') }}</a></li>
                            <li><a href="{{url('user/ratings')}}">{{ __('Phim đã đánh giá') }}</a></li>
                            <li><a href="{{url('user/reviews')}}">{{ __('Phim đã bình luận') }}</a></li>
                            <li><a href="{{url('user/transactions')}}">{{ __('Lịch sử giao dịch') }}</a></li>
                        </ul>
                    </div>
                    <div class="user-fav">
                        <p>{{ __('Cài đặt') }}</p>
                        <ul>
                            <li class="active"><a href="{{url('user/change_password/')}}">Thay đổi mật khẩu</a></li>
                            <li><a href="{{route('logout')}}">{{ __('Đăng xuất') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <div action="#" class="form-style-1 user-pro">
                    <form action="{{url('user/change_password/' . $user->id)}}" method="POST" class="password">
                        @csrf
                        @method('PUT')
                        <h4>{{ __('Thay đổi mật khẩu') }}</h4>
                        <div class="row">
                            <div class="col-md-12 form-it">
                                <label>{{ __('Mật khẩu mới') }}</label>
                                <input name="password" min="6" placeholder="{{ __('Mật khẩu mới') }}" type="password" required>
                                @error('password')
                                <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-it">
                                <label>{{ __('Xác nhận mật khẩu mới') }}</label>
                                <input name="password_confirmation" min="6" placeholder="{{ __('Xác nhận mật khẩu mới') }}" type="password" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <input class="submit" type="submit" value="{{ __('Thay đổi') }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection