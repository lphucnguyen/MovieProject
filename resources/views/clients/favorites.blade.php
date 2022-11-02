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
                            <li class="active"><a href="#">Trang chủ</a></li>
                            <li><span class="ion-ios-arrow-right"></span>Hồ sơ</li>
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
                            <p>Chi tiết tài khoản</p>
                            <ul>
                                <li><a href="{{url('user/profile')}}">Hồ sơ</a></li>
                                <li class="active"><a href="{{url('user/favorites')}}">Phim yêu thích</a></li>
                                <li><a href="{{url('user/ratings')}}">Phim đã đánh giá</a></li>
                                <li><a href="{{url('user/reviews')}}">Phim đã bình luận</a></li>
                                <li><a href="{{url('user/transactions')}}">Lịch sử giao dịch</a></li>
                            </ul>
                        </div>
                        <div class="user-fav">
                            <p>Cài đặt</p>
                            <ul>
                                <li><a href="{{url('user/change_password/')}}">Thay đổi mật khẩu</a></li>
                                <li><a href="{{route('logout')}}">Đăng xuất</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="topbar-filter user">
                        <p>Tìm thấy <span>{{$favorites->count()}}</span> phim</p>
                    </div>
                    <div class="flex-wrap-movielist grid-fav">
                        @foreach($favorites as $favorite)
                            <div class="movie-item-style-2 movie-item-style-1 style-3">
                            <img src="{{$favorite->film->poster}}" alt="" style="height: 245px">
                            <div class="hvr-inner">
                                <a href="{{url('movies/' . $favorite->film->id)}}"> Chi tiết </a>
                            </div>
                            <div class="mv-item-infor">
                                <h6><a href="{{url('movies/' . $favorite->film->id)}}">{{$favorite->film->aname}}</a></h6>
                                <p class="rate"><i class="ion-android-star"></i><span>{{$favorite->film->ratings->avg('rating') ?? 0}}</span> /5</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    {{$favorites->appends(request()->query())->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection