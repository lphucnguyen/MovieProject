@extends('layouts.dashboard.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{asset('dashboard_files/assets/plugins/sweetalert/sweetalert.css')}}"/>
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>{{ __('Tất cả đơn hàng') }}</h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">
                            <i class="zmdi zmdi-home"></i>{{ __('Phim') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('Danh muc') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Tất cả đơn hàng') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">
                        <div class="header">
                            <h2><strong>{{ __('Đơn hàng') }} </strong><span>({{$orders->total()}})</span></h2>
                        </div>
                        <div class="body">
                            <div class="col-5" style="padding-left: 0px">
                                <form action="{{ route('dashboard.orders.index') }}" method="GET">
                                    <div class="input-group" style="margin-bottom: 0px">
                                        <input type="text" class="form-control" placeholder="{{ __('Tìm kiếm') }}..."
                                               name="searchKey" value="{{ request()->searchKey }}">
                                        <button class="input-group-addon" type="submit">
                                            <i class="zmdi zmdi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-content m-t-10">
                                <div class="tab-pane table-responsive active">
                                    <table class="table m-b-0 table-hover">
                                        <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Tên') }}</th>
                                            <th>{{ __('Trạng thái') }}</th>
                                            <th>{{ __('Hình thức thanh toán') }}</th>
                                            <th>{{ __('Hành động') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($orders as $order)
                                            <tr>
                                                <td>
                                                    <span class="list-name">{{ $order->id }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{route('dashboard.clients.index', ['searchKey' => $order->user->username])}}">
                                                        {{ "{$order->user->first_name} {$order->user->last_name}" }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <span class="list-name">
                                                        @include('components.order-status', ['status' => $order->status])
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="list-name">{{ ucfirst($order->payment_name) }}</span>
                                                </td>
                                                <td>
                                                    @if(auth()->guard('admin')->user()->hasPermission('update_orders'))
                                                        <a href="{{route('dashboard.orders.edit', $order->id)}}">
                                                            <button class="btn btn-icon btn-neutral btn-icon-mini"
                                                                    title="{{ __('Chỉnh sửa') }}">
                                                                <i class="zmdi zmdi-eye"></i>
                                                            </button>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-icon btn-neutral btn-icon-mini disabled"
                                                                style="cursor: no-drop"
                                                                title="{{ __('Chỉnh sửa') }}">
                                                            <i class="zmdi zmdi-eye"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="text-center">
                                                <td colspan="5">{{ __('Không có dữ liệu') }}...</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{$orders->appends(request()->query())->links()}}
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{asset('dashboard_files/assets/plugins/sweetalert/sweetalert.min.js')}}"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $(".remove_category").click(function (e) {
                    var that = $(this);
                    e.preventDefault();

                    var id = $(this).val();
                    swal({
                        title: "Xác nhận?",
                        text: "Bạn sẽ không thể khôi phục lại!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Xoá",
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