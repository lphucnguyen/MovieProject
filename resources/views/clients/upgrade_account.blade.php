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
                                <li><a href="{{url('user/profile')}}">{{ __('Hồ sơ') }}</a></li>
                                <li><a href="{{url('user/favorites')}}">{{ __('Phim yêu thích') }}</a></li>
                                <li><a href="{{url('user/ratings')}}">{{ __('Phim đã đánh giá') }}</a></li>
                                <li><a href="{{url('user/reviews')}}">{{ __('Phim đã bình luận') }}</a></li>
                                <li class="active"><a href="{{url('user/upgrade-account')}}">{{ __('Nâng cấp thành viên') }}</a></li>
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
                        <h4>{{ __('Nâng cấp thành viên') }}</h4>
                        @if ($hasActiveSubscription)
                        <p>{{ __('Chưa tới kì hạn nâng cấp') }}</p>
                        @else
                        <form id="paymentForm" action="{{ route('pay') }}" method="POST" class="upgrade-account-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 form-it">
                                    @if(request()->route('orderId'))
                                        <input type="hidden" class="form-control" name="order_id" value="{{ request()->route('orderId') }}">
                                    @endif
                                    <label>{{ __('Plan') }}</label>
                                    @if($order)
                                        <input type="hidden" class="form-control" name="plan_id" value="{{ $order->plan_id }}">
                                        <input type="text" class="form-control" value="{{ $order->plan->slug }} ({{ $order->plan->visual_price }})" disabled>
                                    @else
                                    <select name="plan_id" id="plan_id" class="form-control">
                                        @foreach ($plans as $plan)
                                        <option>Chọn gói nâng cấp</option>
                                        <option value="{{ $plan->id }}">{{ $plan->slug }} ({{ $plan->visual_price }})</option>
                                        @endforeach
                                    </select>
                                    @endif
                                </div>
                                <label>{{ __('Phương thức thanh toán') }}</label>
                                <div class="col-md-12 form-it">
                                    <div id="toggler">
                                        <label
                                            class="d-block"
                                            data-bs-target="#PaypalCollapse"
                                            data-bs-toggle="collapse"
                                        >
                                            <div class="d-block">
                                                <input class="h-auto" type="radio" id="paypal" value="paypal" name="payment_name">
                                                <label for="paypal">Paypal</label><br>
                                            </div>
                                        </label>
                                        <label
                                            class="d-block"
                                            data-bs-target="#StripeCollapse"
                                            data-bs-toggle="collapse"
                                        >
                                            <div class="d-block">
                                                <input class="h-auto" type="radio" id="stripe" value="stripe" name="payment_name">
                                                <label for="stripe">Stripe</label><br>
                                            </div>
                                        </label>
                                        <div
                                            id="PaypalCollapse"
                                            class="collapse"
                                            data-bs-parent="#toggler"
                                        >
                                        @include('components.paypal-payment')
                                        </div>
                                        <div
                                            id="StripeCollapse"
                                            class="collapse"
                                            data-bs-parent="#toggler"
                                        >
                                        @include('components.stripe-payment')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <input id="payButton" class="submit" type="submit" value="{{ __('Thanh toán') }}">
                                </div>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection