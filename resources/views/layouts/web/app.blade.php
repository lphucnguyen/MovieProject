<!DOCTYPE html>

<html class="no-js" lang="en">
    <head>
        <!-- Basic need -->
        <title>{{ __('Xem Phim Online') }} | {{ __('Trực Tuyến') }}</title>
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

        <!-- CSS files -->
        <link href="{{asset('web_files/css/plugins.css')}}" rel="stylesheet">
        <link href="{{asset('web_files/css/style.css')}}" rel="stylesheet">
        @livewireStyles
        @stack('style')
    </head>
    <body>
        <!--preloading-->
        <div id="preloader">
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

        <!-- BEGIN | Header -->
        <header class="ht-header">
            <div class="container">
                <nav class="navbar navbar-default navbar-custom">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header logo">
                        <div class="navbar-toggle" data-target="#bs-example-navbar-collapse-1" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <div id="nav-icon1">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                        <a href="/">
                            <img alt="" class="logo" 
                            style="margin-top: 5px;width: 170px;" src="{{asset('web_files/images/logo1.png')}}" width="119">
                        </a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav flex-child-menu menu-left">
                            <li class="hidden">
                                <a href="#page-top"></a>
                            </li>
                            <li class="dropdown first">
                                <a class="btn btn-default lv1" href="/">
                                    {{ __('Trang chủ') }}
                                </a>

                            </li>
                            <li class="dropdown first">
                                <a class="btn btn-default lv1" href="/movies">
                                    {{ __('Phim') }}
                                </a>
                            </li>
                            <li class="dropdown first">
                                <a class="btn btn-default lv1" href="/actors">
                                    {{ __('Diễn viên') }}
                                </a>
                            </li>
                            <li class="dropdown first">
                                <a class="btn btn-default lv1" href="/contact-us">
                                    {{ __('Liên hệ') }}
                                </a>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav flex-child-menu menu-right">
                            @auth
                            <li class="dropdown first">
                                <a class="btn btn-default dropdown-toggle lv1" data-hover="dropdown" data-toggle="dropdown">
                                    <img src="{{auth()->user()->avatar}}" style="width: 30px; height: 30px; border-radius: 50px">&ensp;
                                    {{auth()->user()->username}} &ensp;<i aria-hidden="true" class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu level1" style="background-color: #020d18;">
                                    <li class="menu-hover"><a href="{{ route('user') }}">{{ __('Hồ sơ') }}</a></li>
                                    <li class="menu-hover"><a href="{{ route('user.upgrade-account') }}">{{ __('Nâng cấp tài khoản') }}</a></li>
                                    <li class="menu-hover"><a href="{{ route('user-password') }}">{{ __('Thay đổi mật khẩu') }}</a></li>
                                </ul>
                            </li>
                                <li class="p-2 signupLink"><a href="{{ route('user.logout') }}">{{ __('Đăng xuất') }}</a></li>
                            @else
                                <li class="loginLink"><a href="{{route('login')}}">{{ __('Đăng nhập') }}</a></li>
                                <li class="p-2 signupLink"><a href="{{ route('register') }}">{{ __('Đăng kí') }}</a></li>
                            @endauth

                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>

                <!-- top search form -->
                <div class="top-search">
                    <form action="/search" method="GET">
                        <select name="search_category">
                            <option {{ request()->search_category == 'film' ? 'selected' : '' }} value="film">{{ __('Phim') }}</option>
                            <option {{ request()->search_category == 'actor' ? 'selected' : '' }} value="actor">{{ __('Diễn viên') }}</option>
                        </select>
                        <input name="searchKey" value="{{ request()->search }}" placeholder="{{ __('Tìm kiếm phim, diễn viên') }}" type="text">
                        <button type="submit" style="background-color: #dd003f!important; color: white; font-weight: bold; padding: 11px 25px; white-space: nowrap;">{{ __('Tìm kiếm') }}</button>
                    </form>
                </div>
            </div>
        </header>
        <!-- END | Header -->

        @yield('content')

        <!-- footer section-->
        <footer id="contact_us">
            <div class="ft-copyright">
                <div class="ft-left">
                    <p><span style="color: orangered">{{ __('Web Phim Online 2022') }}</span></p>
                </div>
                <div class="backtotop">
                    <p><a href="#" id="back-to-top" style="color: #dd003f; font-weight: bold">{{ __('Lên đầu trang') }} <i
                                    class="ion-ios-arrow-thin-up"></i></a></p>
                </div>
            </div>
        </footer>
        <!-- end of footer section-->

        <script src="{{asset('web_files/js/jquery.js')}}"></script>
        <script src="{{asset('web_files/js/plugins.js')}}"></script>
        <script src="{{asset('web_files/js/plugins2.js')}}"></script>
        <script src="{{asset('web_files/js/custom.js')}}"></script>

        <script src="{{asset('dashboard_files/assets/plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>
        @if(session('success'))
            <script type="text/javascript">
                $(document).ready(function () {
                    var allowDismiss = true;

                    $.notify({
                            message: "{{ session('success') }}"
                        },
                        {
                            type: "alert-success",
                            allow_dismiss: allowDismiss,
                            newest_on_top: true,
                            timer: 1000,
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                            animate: {
                                enter: "animated fadeIn",
                                exit: "animated fadeOut"
                            },
                            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                                '<span data-notify="icon"></span> ' +
                                '<span data-notify="title">{1}</span> ' +
                                '<span data-notify="message">{2}</span>' +
                                '<div class="progress" data-notify="progressbar">' +
                                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                '</div>' +
                                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                '</div>'
                        });
                });
            </script>
        @endif

        @if(session('error'))
            <script type="text/javascript">
                $(document).ready(function () {
                    var allowDismiss = true;

                    $.notify({
                            message: "{{ session('error') }}"
                        },
                        {
                            type: "alert-danger",
                            allow_dismiss: allowDismiss,
                            newest_on_top: true,
                            timer: 1000,
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                            animate: {
                                enter: "animated fadeIn",
                                exit: "animated fadeOut"
                            },
                            template: '<div data-notify="container" class="bootstrap-notify-container alert alert-dismissible {0} ' + (allowDismiss ? "p-r-35" : "") + '" role="alert">' +
                                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                                '<span data-notify="icon"></span> ' +
                                '<span data-notify="title">{1}</span> ' +
                                '<span data-notify="message">{2}</span>' +
                                '<div class="progress" data-notify="progressbar">' +
                                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                '</div>' +
                                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                '</div>'
                        });
                });
            </script>
        @endif

        @livewireScripts
        <script src="http://jwpsrv.com/library/FfMxTl3oEeSEiiIACxmInQ.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        @stack('script')
    </body>
</html>
