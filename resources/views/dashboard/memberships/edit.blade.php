@extends('layouts.dashboard.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{asset('web_files/css/bootstrap-fileinput.css')}}">
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>Sửa gói thành viên
                    </h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="zmdi zmdi-home"></i>
                                Films</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Categories</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Sửa</strong> gói thành viên</h2>
                        </div>

                        <div class="body">
                            <form action="{{route('dashboard.memberships.update', $membership)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>Thông tin chính</h2>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="title" class="form-control"
                                                   placeholder="Tên" value="{{ $membership->title }}">
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('title') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="number" name="price" class="form-control"
                                                   placeholder="Giá" value="{{ $membership->price }}">
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('price') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea type="text" name="description" class="form-control"
                                                   placeholder="Mô tả">{{ $membership->description }}</textarea>
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('description') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix align-items-center">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="number" name="time_expired" class="form-control"
                                                   placeholder="Thời gian hệt hạn" value="{{ $membership->time_expired }}">
                                            <span style="color: red;">{{ $errors->first('time_expired') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <p>Đơn vị: tháng</p>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-round">Sửa</button>
                                        <button type="reset" class="btn btn-default btn-round btn-simple">Huỷ bỏ
                                        </button>
                                        <a href={{route('dashboard.memberships.index')}} class="btn btn-second btn-round">Quay lại</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection