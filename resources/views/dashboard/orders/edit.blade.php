@extends('layouts.dashboard.app')

@section('content')

    @push('styles')
    <link rel="stylesheet" href="{{asset('dashboard_files/assets/plugins/sweetalert/sweetalert.css')}}"/>
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>{{ __('Chỉnh sửa đơn hàng') }}</h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">
                            <i class="zmdi zmdi-home"></i>{{ __('Phim') }}</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('Đơn hàng') }}</a></li>
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
                            <h2><strong>{{ __('Thông tin chi tiết đơn hàng') }}</strong></h2>
                        </div>

                        <div class="body">
                            <form action="{{route('dashboard.plans.update', $order->id)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>{{ __('Thông tin đơn hàng') }}</h2>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <span>{{ __('ID') }}</span>
                                            <input type="text" disabled name="name" class="form-control" value="{{ $order->id }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <span>{{ __('Trạng thái') }}</span>
                                            <input type="text" disabled name="name" class="form-control" value="{{ ucfirst($order->status) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <span>{{ __('Thời gian khởi tạo') }}</span>
                                            <input type="text" disabled name="name" class="form-control" value="{{ $order->created_at }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>{{ __('Thông tin giao dịch') }}</h2>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <span>{{ __('Phương thức thanh toán') }}</span>
                                            <input type="text" disabled name="name" class="form-control" value="{{ ucfirst($order->payment_name) }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <span>{{ __('ID giao dịch') }}</span>
                                            <input type="text" disabled name="name" class="form-control" value="{{ $order->transaction_id }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <span>{{ __('Giá trị') }}</span>
                                            <input type="text" disabled name="name" class="form-control" value="{{ $order->amount }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <span>{{ __('Đơn vị') }}</span>
                                            <input type="text" disabled name="name" class="form-control" value="{{ $order->currency }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <span>{{ __('Thời gian giao dịch') }}</span>
                                            <input type="text" disabled name="name" class="form-control" value="{{ $order->paid_at }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-danger btn-round cancel-order">{{__('Huỷ đơn hàng') }}</button>
                                        <a href={{route('dashboard.orders.index')}} class="btn btn-second btn-round">{{ __('Quay lại') }}</a>
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
        <script src="{{asset('dashboard_files/assets/plugins/sweetalert/sweetalert.min.js')}}"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $(".cancel-order").click(function (e) {
                    var that = $(this);
                    e.preventDefault();

                    var id = $(this).val();
                    swal({
                        title: "Xác nhận?",
                        text: "Bạn không thể khôi phục sau khi huỷ đơn hàng!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Huỷ đơn hàng",
                        cancelButtonText: "Huỷ bỏ",
                        closeOnConfirm: false
                    }, function () {
                        that.closest('form').submit();
                    });
                });
            });
        </script>
    @endpush

@endsection