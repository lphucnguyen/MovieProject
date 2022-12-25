{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    {{--<div class="container">--}}
        {{--<div class="row justify-content-center">--}}
            {{--<div class="col-md-8">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-header">{{ __('Register') }}</div>--}}

                    {{--<div class="card-body">--}}
                        {{--<form method="POST" action="{{ route('register') }}">--}}
                            {{--@csrf--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="name" type="text"--}}
                                           {{--class="form-control @error('name') is-invalid @enderror" name="name"--}}
                                           {{--value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

                                    {{--@error('name')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@enderror--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="email"--}}
                                       {{--class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="email" type="email"--}}
                                           {{--class="form-control @error('email') is-invalid @enderror" name="email"--}}
                                           {{--value="{{ old('email') }}" required autocomplete="email">--}}

                                    {{--@error('email')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@enderror--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="password"--}}
                                       {{--class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password" type="password"--}}
                                           {{--class="form-control @error('password') is-invalid @enderror" name="password"--}}
                                           {{--required autocomplete="new-password">--}}

                                    {{--@error('password')--}}
                                    {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@enderror--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="password-confirm"--}}
                                       {{--class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password-confirm" type="password" class="form-control"--}}
                                           {{--name="password_confirmation" required autocomplete="new-password">--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row mb-0">--}}
                                {{--<div class="col-md-6 offset-md-4">--}}
                                    {{--<button type="submit" class="btn btn-primary">--}}
                                        {{--{{ __('Register') }}--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7 no-js" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js" lang="en-US">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html class="no-js" lang="en">

<!-- landing14:04-->
<head>
    <!-- Basic need -->
    <title>:: Người dùng :: Đăng kí</title>
    <meta charset="UTF-8">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta content="" name="author">
    <link href="#" rel="profile">

    <!--Google Font-->
    <link href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' rel="stylesheet"/>
    <!-- Mobile specific meta -->
    <meta content="width=device-width, initial-scale=1" name=viewport>
    <meta content="telephone-no" name="format-detection">

    <!-- CSS files -->
    <link href="{{asset('web_files/css/plugins.css')}}" rel="stylesheet">
    <link href="{{asset('web_files/css/style.css')}}" rel="stylesheet">

</head>
<body>
<!--preloading-->
<!--preloading-->
<div id="preloader">
    {{-- <div id="status">
        <span></span>
        <span></span>
    </div> --}}
    <div id="load">
        <div>G</div>
        <div>N</div>
        <div>I</div>
        <div>D</div>
        <div>A</div>
        <div>O</div>
        <div>L</div>
      </div>
</div>

<div class="landing-hero" style="padding-top: 50px">

    <div style="margin-bottom: 50px">
        <img style="width: 420px;" alt="Logo" src="{{asset('web_files/images/logo1.png')}}">
    </div>
    <div class="container">
        <div class="login-content">
            <h3>Đăng kí</h3>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="row">
                    <label for="username">
                        Username:
                        <input id="username" name="username"
                               placeholder="UserName"
                               required="required" type="text"/>
                        @error('username')
                            <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                </div>
                <div class="row">
                    <div class="col-md-6" style="padding-left: 0px;">
                        <label for="first_name">
                            Họ:
                            <input id="first_name" name="first_name"
                                   placeholder="Họ"
                                   required="required" type="text"/>
                            @error('first_name')
                                <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </label>
                    </div>
                    <div class="col-md-6" style="padding-right: 0px;">
                        <label for="last_name">
                            Tên:
                            <input id="last_name" name="last_name"
                                   placeholder="Tên"
                                   required="required" type="text"/>
                            @error('last_name')
                                <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </label>
                    </div>
                </div>

                <div class="row">
                    <label for="email">
                        Địa chỉ email:
                        <input id="email" name="email"
                               placeholder="Email"
                               required="required"
                               type="email"/>
                        @error('email')
                            <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                </div>
                <div class="row">
                    <label for="password">
                        Mật khẩu:
                        <input id="password" name="password"
                               placeholder="Mật khẩu"
                               required="required"
                               type="password"/>
                        @error('password')
                            <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </label>
                </div>
                <div class="row">
                    <label for="repassword">
                        Nhập lại mật khẩu:
                        <input id="repassword" name="password_confirmation"
                               placeholder="Nhập lại mật khẩu"
                               required="required"
                               type="password"/>
                    </label>
                </div>
                <div class="row">
                    <button type="submit">Đăng kí</button>
                </div>
            </form>
        </div>

    </div>

</div>
<!-- end of footer v3 section-->

<script src="{{asset('web_files/js/jquery.js')}}"></script>
<script src="{{asset('web_files/js/plugins.js')}}"></script>
<script src="{{asset('web_files/js/plugins2.js')}}"></script>
<script src="{{asset('web_files/js/custom.js')}}"></script>
</body>

<!-- landing14:38-->
</html>
