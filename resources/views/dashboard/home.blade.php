@extends('layouts.dashboard.app')

@section('content')
    <section class="content home">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Bảng điều khiển
                        <small>Chào mừng đến với Web Phim V1.0</small>
                    </h2>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12 text-right">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href=""><i class="zmdi zmdi-home"></i> Films</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <ul class="row profile_state list-unstyled">
                            <li class="col-lg-3 col-md-3 col-6">
                                <div class="body">
                                    <i class="zmdi zmdi-account col-green"></i>
                                    <h4>{{$admins}}</h4>
                                    <span>Ban quản trị</span>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-3 col-6">
                                <div class="body">
                                    <i class="zmdi zmdi-account-circle col-blue"></i>
                                    <h4>{{$clients}}</h4>
                                    <span>Người dùng</span>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-3 col-6">
                                <div class="body">
                                    <i class="zmdi zmdi-view-list col-brown"></i>
                                    <h4>{{$categories}}</h4>
                                    <span>Danh mục</span>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-3 col-6">
                                <div class="body">
                                    <i class="zmdi zmdi-movie col-red"></i>
                                    <h4>{{$films}}</h4>
                                    <span>Phim</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <ul class="row profile_state list-unstyled">
                            <li class="col-lg-3 col-md-3 col-6">
                                <div class="body">
                                    <i class="zmdi zmdi-star col-amber"></i>
                                    <h4>{{$ratings}}</h4>
                                    <span>Đánh giá</span>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-3 col-6">
                                <div class="body">
                                    <i class="zmdi zmdi-comment-list col-blush"></i>
                                    <h4>{{$reviews}}</h4>
                                    <span>Bình luận</span>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-3 col-6">
                                <div class="body">
                                    <i class="zmdi zmdi-male col-grey"></i>
                                    <h4>{{$actors}}</h4>
                                    <span>Diễn viên</span>
                                </div>
                            </li>
                            <li class="col-lg-3 col-md-3 col-6">
                                <div class="body">
                                    <i class="zmdi zmdi-email col-deep-purple"></i>
                                    <h4>{{$messages}}</h4>
                                    <span>Tin nhắn</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection