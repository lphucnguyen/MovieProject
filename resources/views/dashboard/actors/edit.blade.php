@extends('layouts.dashboard.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{asset('web_files/css/bootstrap-fileinput.css')}}">
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>{{ __('Chỉnh sửa diễn viên') }}</h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">
                            <i class="zmdi zmdi-home"></i>{{ __('Phim') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('Diễn viên') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Chỉnh sửa') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>{{ __('Chỉnh sửa diễn viên') }}</strong></h2>
                        </div>

                        <div class="body">
                            <form action="{{route('dashboard.actors.update', $actor)}}" method="POST"
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
                                                   placeholder="{{ __('Tên') }}" value="{{ $actor->name }}">
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="dob" class="form-control"
                                                   placeholder="{{ __('Ngày sinh') }}" value="{{ $actor->dob }}"
                                                   onfocus="(this.type='date')"
                                                   onblur="(this.type='text')"
                                                   style="text-align: left">
                                            <span style="color: red;margin-left: 10px">{{ $errors->first('dob') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="header col-lg-12 col-md-12 col-sm-12">
                                        <h2>{{ __('Tổng quan về diễn viên') }}</h2>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea name="overview" rows="4" class="form-control no-resize editor-summernote"
                                                      >{{ old('overview', $actor->overview) }}</textarea>
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('overview') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="header col-lg-12 col-md-12 col-sm-12">
                                        <h2>{{ __('Tiểu sử của diễn viên') }}</h2>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea name="biography" rows="4" class="form-control no-resize editor-summernote"
                                                    >{{ old('biography', $actor->biography) }}</textarea>
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('biography') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group last mt-5">
                                    <img class="fileinput-preview fileinput-exists thumbnail preview-image-background_cover"
                                             style="max-width: 200px; max-height: 150px;" src="{{ $actor->background_cover }}">
                                    <span class="btn btn-dark btn-file select-background_cover-file">
                                        <span class="fileinput-new">{{ __('Chọn ảnh nền diễn viên')}}</span>
                                        <input type="hidden" name="background_cover" class="background_cover-file"
                                               value="{{ old('background_cover', $actor->background_cover) }}">
                                    </span>
                                    <span style="color: red; margin-left: 10px; display: block;">{{ $errors->first('background_cover') }}</span>
                                </div>
                                <div class="form-group last">
                                    <img class="fileinput-preview fileinput-exists thumbnail preview-image-avatar"
                                             style="max-width: 200px; max-height: 150px;" src="{{ $actor->avatar }}">
                                    <span class="btn btn-dark btn-file select-avatar-file">
                                        <span class="fileinput-new">{{ __('Chọn ảnh nền diễn viên')}}</span>
                                        <input type="hidden" name="avatar" class="avatar-file"
                                               value="{{ old('avatar', $actor->avatar) }}">
                                    </span>
                                    <span style="color: red; margin-left: 10px; display: block;">{{ $errors->first('avatar') }}</span>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-round">{{__('Cập nhật')}}</button>
                                        <button type="reset" class="btn btn-default btn-round btn-simple">{{__('Huỷ bỏ')}}</button>
                                        <a href={{ route('dashboard.actors.index') }} class="btn btn-second btn-round">{{ __('Quay lại') }}</a>
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

            $('.select-background_cover-file').on('click', function (event) {
                event.preventDefault();

                file = "background_cover-file";
                window.open('/file-manager/fm-button', 'FileManager', 'width=900,height=600');
            });

            $(".select-avatar-file").click(function (event) {
                event.preventDefault();

                file = "avatar-file";
                window.open('/file-manager/fm-button', 'FileManager', 'width=900,height=600');
            });


            function fmSetLink(url) {
                if (file === 'background_cover-file') {
                    $('.background_cover-file').attr('value', url);
                    $('.preview-image-background_cover').attr('src', url);
                } else if (file === 'avatar-file') {
                    $('.avatar-file').attr('value', url);
                    $('.preview-image-avatar').attr('src', url);
                } else {
                    $('.editor-summernote').summernote('insertImage', url);
                }
            }
        </script>
    @endpush

@endsection