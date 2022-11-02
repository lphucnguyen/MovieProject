<!doctype html>
<html class="no-js " lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
    <title>Xem Phim Online | Trực Tuyến</title>
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon"> <!-- Favicon-->

    @stack('styles')

    <link rel="stylesheet" href="{{asset('dashboard_files/assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('dashboard_files/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/plugins/morrisjs/morris.min.css')}}"/>
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('dashboard_files/light/assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_files/light/assets/css/color_skins.css')}}">

    @livewireStyles

    <style>
        .sp {
            width: 32px;
            height: 32px;
            clear: both;
            margin: 20px auto;
        }
        .sp-sphere {
            border-radius: 50%;
            border-left: 0px #fff solid;
            border-right: 0px #fff solid;
            -webkit-animation: spSphere 1s infinite linear;
            animation: spSphere 1s infinite linear;
        }

        @-webkit-keyframes spSphere {
            0% {
                border-left: 0px #fff solid;
                border-right: 0px #fff solid;
            }
            33% {
                border-left: 32px #fff solid;
                border-right: 0px #fff solid;
            }
            34% {
                border-left: 0px #fff solid;
                border-right: 32px #fff solid;
            }
            66% {
                border-left: 0px #fff solid;
                border-right: 0px #fff solid;
            }
        }
        @keyframes spSphere {
            0% {
                border-left: 0px #fff solid;
                border-right: 0px #fff solid;
            }
            33% {
                border-left: 32px #fff solid;
                border-right: 0px #fff solid;
            }
            34% {
                border-left: 0px #fff solid;
                border-right: 32px #fff solid;
            }
            66% {
                border-left: 0px #fff solid;
                border-right: 0px #fff solid;
            }
        }
    </style>
</head>
<body class="theme-cyan">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        {{-- <div class="m-t-30"><img class="zmdi-hc-spin" src="{{asset('favicon.ico')}}" width="48" height="48" alt="Oreo">
        </div> --}}
        <div class="col-sm-2 m-auto">
            <div class="sp sp-sphere"></div>
          </div>
        <p>Đợi trong giây lát...</p>
    </div>
</div>
<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<!-- Top Bar -->
<nav class="navbar p-l-5 p-r-5">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" style="line-height: 50px;" href="">
                    {{-- <img src="{{asset('favicon.ico')}}" width="30"
                                                     alt="Oreo"><span class="m-l-10">Movies</span> --}}
                    <img 
                        alt="" 
                        class="logo" 
                        style="margin-top: 5px;width: 170px;" 
                        src="{{asset('web_files/images/logo1.png')}}" 
                    >
                </a>
            </div>
        </li>
        <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a>
        </li>

        <li class="float-right">
            <a href="{{route('dashboard.logout')}}" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"></i>
                Đăng xuất</a>
        </li>
    </ul>
</nav>

@include('layouts.dashboard._aside')

@yield('content')

<!-- Jquery Core Js -->
<script src="{{asset('dashboard_files/light/assets/bundles/libscripts.bundle.js')}}"></script>
<!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
<script src="{{asset('dashboard_files/light/assets/bundles/vendorscripts.bundle.js')}}"></script>
<!-- slimscroll, waves Scripts Plugin Js -->

<script src="{{asset('dashboard_files/assets/plugins/bootstrap-notify/bootstrap-notify.js')}}"></script>
<!-- Bootstrap Notify Plugin Js -->


<script src="{{asset('dashboard_files/light/assets/bundles/morrisscripts.bundle.js')}}"></script>
<!-- Morris Plugin Js -->
<script src="{{asset('dashboard_files/light/assets/bundles/jvectormap.bundle.js')}}"></script>
<!-- JVectorMap Plugin Js -->
<script src="{{asset('dashboard_files/light/assets/bundles/knob.bundle.js')}}"></script>
<!-- Jquery Knob, Count To, Sparkline Js -->

<script src="{{asset('dashboard_files/light/assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{asset('dashboard_files/light/assets/js/pages/ui/notifications.js')}}"></script> <!-- Custom Js -->
<script src="{{asset('dashboard_files/light/assets/js/pages/index.js')}}"></script>

{{--<script src="http://unpkg.com/turbolinks"></script>--}}

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

@stack('scripts')
@livewireScripts

</body>
</html>