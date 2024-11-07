@extends('layouts.web.app')
@section('content')
    @push('style')
        <style rel="stylesheet">
            li.active {
                color: yellow;
            }
        </style>
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
            <div class="row ipad-width2">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="user-information">
                        <div style="margin: 0" class="user-img">
                            <a href="#"><img alt="" src="{{$user->avatar}}"
                                             style="width: 150px; height: 150px; border-radius: 50%"><br></a>
                        </div>
                        <div class="user-fav">
                            <p>{{ __('Chi tiết tài khoản') }}</p>
                            <ul>
                                <li ><a href="{{url('user/profile')}}">{{ __('Hồ sơ') }}</a></li>
                                <li><a href="{{url('user/favorites')}}">{{ __('Phim yêu thích') }}</a></li>
                                <li class="active"><a href="{{url('user/ratings')}}">{{ __('Phim đã đánh giá') }}</a></li>
                                <li><a href="{{url('user/reviews')}}">{{ __('Phim đã bình luận') }}</a></li>
                                <li><a href="{{url('user/transactions')}}">{{ __('Lịch sử giao dịch') }}</a></li>
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
                    <div class="topbar-filter">
                        <p>{{ __('Tìm thấy') }} <span>{{$ratings->count()}}</span> {{ __('đánh giá') }}</p>
                    </div>
                    @foreach($ratings as $rating)
                        <div class="movie-item-style-2 userrate">
                        <img src="{{$rating->film->poster}}" alt="" style="height: 150px">
                        <div class="mv-item-infor">
                            <h6><a href="{{url('movies/' . $rating->film->id)}}">{{$rating->film->name}} <span>({{$rating->film->year}})</span></a></h6>
                            {{-- <p class="time sm-text" style="margin-bottom: 10px">Đánh giá của bạn: </p> --}}
                            <p class="rate">{{ __('Đánh giá của bạn') }}: <i class="ion-android-star"></i><span>{{$rating->rating }}</span> /5</p>
                        </div>
                    </div>
                    @endforeach
                    {{$ratings->appends(request()->query())->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection