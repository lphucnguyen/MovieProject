@extends('layouts.dashboard.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{asset('web_files/css/bootstrap-fileinput.css')}}">
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>Chỉnh sửa diễn viên
                        {{-- <small>Welcome to Films</small> --}}
                    </h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="zmdi zmdi-home"></i>
                                Films</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Diễn viên</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Chỉnh sửa</strong> diễn viên</h2>
                        </div>

                        <div class="body">
                            <form action="{{route('dashboard.actors.update', $actor)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>Thông tin chính</h2>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="Tên" value="{{ $actor->name }}">
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="dob" class="form-control"
                                                   placeholder="Ngày sinh" value="{{ $actor->dob }}"
                                                   onfocus="(this.type='date')"
                                                   onblur="(this.type='text')"
                                                   style="text-align: left">
                                            <span style="color: red;margin-left: 10px">{{ $errors->first('dob') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea name="overview" rows="4" class="form-control no-resize"
                                                      placeholder="Giới thiệu">{{ $actor->overview }}</textarea>
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('overview') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea name="biography" rows="4" class="form-control no-resize"
                                                      placeholder="Tiểu sử">{{ $actor->biography }}</textarea>
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('biography') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group last">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail"
                                             style="width: 200px; height: 150px;">
                                            <img src="{{$actor->avatar}}"
                                                 alt=""/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                             style="max-width: 200px; max-height: 150px;">
                                        </div>
                                        <div>
                                                <span class="btn btn-dark btn-file">
                                                    <span class="fileinput-new"> Chọn ảnh đại diện </span>
                                                    <span class="fileinput-exists"> Thay đổi </span>
                                                    <input type="file" name="avatar"
                                                           value="{{$actor->avatar}}">
                                                </span>
                                            <a href="" class="btn btn-danger fileinput-exists"
                                               data-dismiss="fileinput">
                                                Xoá </a>
                                        </div>
                                        <span style="color: red; margin-left: 10px">{{ $errors->first('avatar') }}</span>
                                    </div>
                                </div>

                                <div class="form-group last">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail"
                                             style="width: 200px; height: 150px;">
                                            <img src="{{$actor->background_cover}}"
                                                 alt=""/>
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                             style="max-width: 200px; max-height: 150px;">
                                        </div>
                                        <div>
                                                <span class="btn btn-dark btn-file">
                                                    <span class="fileinput-new"> Chọn ảnh nền </span>
                                                    <span class="fileinput-exists"> Thay đổi </span>
                                                    <input type="file" name="background_cover"
                                                           value="{{$actor->background_cover}}">
                                                </span>
                                            <a href="" class="btn btn-danger fileinput-exists"
                                               data-dismiss="fileinput">
                                                Xoá </a>
                                        </div>
                                        <span style="color: red; margin-left: 10px">{{ $errors->first('background_cover') }}</span>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-round">Chỉnh sửa</button>
                                        <button type="reset" class="btn btn-default btn-round btn-simple">Huỷ bỏ
                                        </button>
                                        <a href={{route('dashboard.actors.index')}} class="btn btn-second btn-round">Quay lại</a>
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
    @endpush

@endsection