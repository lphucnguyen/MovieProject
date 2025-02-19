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
                            <h2><strong>Chỉnh sửa</strong> khách hàng</h2>
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
                                <div class="form-group last mt-5">
                                    <img class="fileinput-preview fileinput-exists thumbnail preview-image-avatar"
                                             style="max-width: 200px; max-height: 150px;" src="{{ $client->avatar }}">
                                    <span class="btn btn-dark btn-file select-avatar-file">
                                        <span class="fileinput-new">{{ __('Chọn Avatar') }}</span>
                                        <input type="hidden" name="avatar" class="avatar-file"
                                               value="{{ old('avatar', $client->avatar) }}">
                                    </span>
                                    <span style="color: red; margin-left: 10px; display: block;">{{ $errors->first('avatar') }}</span>
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
                                        <button type="submit" class="btn btn-primary btn-round">Sửa</button>
                                        <button type="reset" class="btn btn-default btn-round btn-simple">Huỷ bỏ
                                        </button>
                                        <a href={{route('dashboard.clients.index')}} class="btn btn-second btn-round">Quay lại</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{asset('web_files/js/bootstrap-fileinput.js')}}"></script>
        <script>
            let file = '';

            $('.select-avatar-file').on('click', function (event) {
                event.preventDefault();

                file = "avatar-file";
                window.open('/file-manager/fm-button', 'FileManager', 'width=900,height=600');
            });


            function fmSetLink(url) {
                if (file === 'avatar-file') {
                    $('.avatar-file').attr('value', url);
                    $('.preview-image-avatar').attr('src', url);
                }
            }
        </script>
    @endpush

@endsection