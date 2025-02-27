@extends('layouts.dashboard.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{asset('web_files/css/bootstrap-fileinput.css')}}">
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>{{ __('Chỉnh sửa thông tin ban quản trị') }}</h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">
                            <i class="zmdi zmdi-home"></i>{{ __('Phim') }}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('Ban quản trị') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Chỉnh sửa') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>{{ __('Chỉnh sửa ban quản trị') }}</strong></h2>
                        </div>

                        <div class="body">
                            <form action="{{route('dashboard.admins.update', $admin->id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>{{ __('Thông tin chính') }}</h2>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="{{ __('Tên') }}" value="{{ $admin->name }}">
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control"
                                                   placeholder="{{ __('Email') }}" value="{{ $admin->email }}">
                                            <span style="color: red;margin-left: 10px">{{ $errors->first('email') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group last mt-5">
                                    <img class="fileinput-preview fileinput-exists thumbnail preview-image-avatar"
                                             style="max-width: 200px; max-height: 150px;" src="{{ old('background_cover', $admin->avatar) }}">
                                    <span class="btn btn-dark btn-file select-avatar-file">
                                        <span class="fileinput-new">{{ __('Chọn Avatar') }}</span>
                                        <input type="hidden" name="avatar" class="avatar-file"
                                               value="{{ old('avatar', $admin->avatar) }}">
                                    </span>
                                    <span style="color: red; margin-left: 10px; display: block;">{{ $errors->first('avatar') }}</span>
                                </div>
                                <hr>
                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>{{ __('Thông tin đăng nhập') }}</h2>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control"
                                                   placeholder="{{ __('Mật khẩu') }}">
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('password') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation" class="form-control"
                                                   placeholder="{{ __('Xác nhận mật khẩu') }}">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-round">{{ __('Chỉnh sửa') }}</button>
                                    </div>
                                </div>
                            </form>

                            <form action="{{route('dashboard.admins.updatePermissions', $admin->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <hr>
                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>{{ __('Thông tin quyền truy cập') }}</h2>
                                </div>
                                <div class="row clearfix">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        @foreach($models as $table => $permissions)
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab"
                                                   href="#{{ $table }}"
                                                   role="tab" aria-controls="home" aria-selected="true">{{ $table }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="row clearfix" style="margin-left: 10px">
                                    <div class="tab-content">
                                        @foreach($models as $table => $permissions)
                                            <div class="tab-pane fade show"
                                                 id="{{ $table }}">
                                                <div class="checkbox">
                                                    @foreach($permissions as $permission)
                                                        <input {{ $modelsAdmin->contains($permission . '_' . $table) ? 'checked' : '' }}
                                                            id="{{ $permission . '_' . $table }}" type="checkbox"
                                                            name="permissions[]" value="{{ $permission . '_' . $table }}">
                                                        <label style="margin-left: 10px"
                                                            for="{{$permission . '_' . $table }}">
                                                            {{$permission}}
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-round">{{ __('Chỉnh sửa') }}</button>
                                        <button type="reset" class="btn btn-default btn-round btn-simple">{{__('Huỷ bỏ')}}</button>
                                        <a href={{route('dashboard.admins.index')}} class="btn btn-second btn-round">{{ __('Quay lại') }}</a>
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