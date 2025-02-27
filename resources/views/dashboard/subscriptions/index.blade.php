@extends('layouts.dashboard.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{asset('dashboard_files/assets/plugins/sweetalert/sweetalert.css')}}"/>
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>{{ __('Tất cả Plan') }}</h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">
                            <i class="zmdi zmdi-home"></i>{{ __('Subscription') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('Subscription') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Tất cả Subscription') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">
                        <div class="header">
                            <h2><strong>{{ __('Plan') }}</h2>
                        </div>
                        <div class="body">
                            <div class="col-5" style="padding-left: 0px">
                                <form action="{{ route('dashboard.subscriptions.index') }}" method="GET">
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
                                            <th>{{ __('Username') }}</th>
                                            <th>{{ __('Plan') }}</th>
                                            <th>{{ __('Hạn sử dụng') }}</th>
                                            <th>{{ __('Hành động') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($subscriptions as $subscription)
                                            <tr>
                                                <td>
                                                    <span class="list-name">{{ $subscription->id }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.clients.index', ['searchKey' => $subscription->user->username]) }}">
                                                        {{ $subscription->user->username }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.plans.index', ['searchKey' => $subscription->plan->slug]) }}">
                                                        {{ $subscription->plan->slug }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <span class="list-name">{{ $subscription->active_until }}</span>
                                                </td>
                                                <td>
                                                    @if(auth()->guard('admin')->user()->hasPermission('update_subscriptions'))
                                                        <a href="{{ route('dashboard.subscriptions.edit', $subscription->id) }}">
                                                            <button class="btn btn-icon btn-neutral btn-icon-mini"
                                                                    title="{{ __('Chỉnh sửa') }}">
                                                                <i class="zmdi zmdi-edit"></i>
                                                            </button>
                                                        </a>
                                                    @else
                                                        <button class="btn btn-icon btn-neutral btn-icon-mini disabled"
                                                                style="cursor: no-drop"
                                                                title="{{ __('Chỉnh sửa') }}">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(auth()->guard('admin')->user()->hasPermission('delete_subscriptions'))
                                                        <form action="{{ route('dashboard.subscriptions.destroy', $subscription->id) }}"
                                                              method="POST" style="display: inline-block">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                    class="btn btn-icon btn-neutral btn-icon-mini remove_rate"
                                                                    title="Delete" value="{{ $subscription->id }}">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-icon btn-neutral btn-icon-mini disabled"
                                                                style="cursor: no-drop"
                                                                title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
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
                {{$subscriptions->appends(request()->query())->links()}}
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