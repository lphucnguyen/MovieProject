@extends('layouts.dashboard.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{asset('web_files/css/bootstrap-fileinput.css')}}">
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>Sửa khách hàng
                        {{-- <small>Chào mừng đến với phim</small> --}}
                    </h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="zmdi zmdi-home"></i>
                                Bảng điều khiển</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Khách hàng</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa khách hàng</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>{{ __('Chỉnh sửa khách hàng') }}</h2>
                        </div>

                        <div class="body">
                            <form action="{{route('dashboard.clients.update', $client)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>Thông tin chính</h2>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control"
                                                   placeholder="UserName" disabled value="{{ $client->username }}">
                                                   <input type="hidden" name="username" class="form-control"
                                                   placeholder="UserName" value="{{ $client->username }}">
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('username') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control"
                                                   placeholder="Email" disabled value="{{ $client->email }}">
                                            <input type="hidden" name="email" class="form-control"
                                                   placeholder="Email" value="{{ $client->email }}">
                                            <span style="color: red;margin-left: 10px">{{ $errors->first('email') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="first_name" class="form-control"
                                                   placeholder="Họ" value="{{ $client->first_name }}">
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('first_name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="last_name" class="form-control"
                                                   placeholder="Tên" value="{{ $client->last_name }}">
                                            <span style="color: red;margin-left: 10px">{{ $errors->first('last_name') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group last">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail"
                                             style="width: 200px; height: 150px;">
                                            <img src="{{$client->avatar}}"
                                                 alt=""/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                             style="max-width: 200px; max-height: 150px;">
                                        </div>
                                        <div>
                                                <span class="btn btn-dark btn-file">
                                                    <span class="fileinput-new"> Chọn Avatar </span>
                                                    <span class="fileinput-exists"> Thay đổi </span>
                                                    <input type="file" name="avatar"
                                                           value="{{ $client->avatar }}">
                                                </span>
                                            <a href="" class="btn btn-danger fileinput-exists"
                                               data-dismiss="fileinput">
                                                Xoá </a>
                                        </div>
                                        <span style="color: red; margin-left: 10px">{{ $errors->first('avatar') }}</span>
                                    </div>
                                </div>

                                <hr>
                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>Thông tin đăng nhập</h2>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control"
                                                   placeholder="Mật khẩu">
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('password') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                   placeholder="Xác nhận mật khẩu">
                                        </div>
                                    </div>
                                </div>

                                <br>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-round">{{__('Cập nhật')}}</button>
                                        <button type="reset" class="btn btn-default btn-round btn-simple">{{__('Huỷ bỏ')}}</button>
                                        <a href={{route('dashboard.clients.index')}} class="btn btn-second btn-round">{{__('Quay lại')}}</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="header">
                            <h2>{{ __('Đăng kí thành viên') }}</h2>
                        </div>
                        <div class="body">
                            @if($subscription)
                            <form action="{{route('dashboard.subscriptions.update', $subscription->id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row clearfix">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <span>{{ __('Tên gói cước') }}</span>
                                            <input type="text" disabled class="form-control" value="{{ $subscription->plan->slug }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <span>{{ __('Ngày hết hạn') }}</span>
                                            <input type="datetime-local" name="active_until" class="form-control" value="{{ $subscription->active_until }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-round">{{__('Cập nhật') }}</button>
                                        <a href={{ route('dashboard.subscriptions.index') }} class="btn btn-second btn-round">{{ __('Quay lại') }}</a>
                                    </div>
                                </div>
                            </form>
                            @else
                            <div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <span>{{ __('Hiện tại chưa đăng kí thành viên') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{asset('web_files/js/bootstrap-fileinput.js')}}"></script>
    @endpush

@endsection