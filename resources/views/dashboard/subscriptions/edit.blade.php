@extends('layouts.dashboard.app')

@section('content')

    @push('styles')
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/plugins/sweetalert/sweetalert.css')}}"/>
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>{{ __('Chỉnh sửa subscription') }}</h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">
                            <i class="zmdi zmdi-home"></i>{{ __('Subscription') }}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('Subscription') }}</a></li>
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
                            <h2><strong>{{ __('Thông tin chi tiết subscription') }}</strong></h2>
                        </div>

                        <div class="body">
                            <form action="{{route('dashboard.subscriptions.update', $subscription->id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>{{ __('Thông tin subscription') }}</h2>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <span>{{ __('Tên gói cước') }}</span>
                                            <input type="text" disabled class="form-control" value="{{ $subscription->plan->slug }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <span>{{ __('Username') }}</span>
                                            <input type="text" disabled class="form-control" value="{{ $subscription->user->username }}">
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
                                        <button type="submit" class="btn btn-primary btn-round">{{__('Cập nhật')}}</button>
                                        <button type="reset" class="btn btn-default btn-round btn-simple">{{__('Huỷ bỏ')}}</button>
                                        <a href={{route('dashboard.subscriptions.index')}} class="btn btn-second btn-round">{{ __('Quay lại') }}</a>
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