@extends('layouts.dashboard.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{asset('dashboard_files/assets/plugins/sweetalert/sweetalert.css')}}"/>
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>{{ __('Tất cả danh mục') }}</h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    @if(auth()->guard('admin')->user()->hasPermission('create_categories'))
                        <a href="{{route('dashboard.categories.create')}}">
                            <button class="btn btn-primary btn-icon btn-round d-none d-md-inline-block float-right m-l-10"
                                    type="button">
                                <i class="zmdi zmdi-plus"></i>
                            </button>
                        </a>
                    @else
                        <button class="btn btn-primary btn-icon btn-round d-none d-md-inline-block float-right m-l-10 disabled"
                                style="cursor: no-drop"
                                type="button">
                            <i class="zmdi zmdi-plus"></i>
                        </button>
                    @endif
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">
                            <i class="zmdi zmdi-home"></i>{{ __('Phim') }}</a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">{{ __('Danh muc') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('Tất cả danh mục') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card patients-list">
                        <div class="header">
                            <h2><strong>{{ __('Danh mục') }} </strong><span>({{$categories->total()}})</span></h2>
                        </div>
                        <div class="body">
                            <div class="col-5" style="padding-left: 0px">
                                <form action="{{ route('dashboard.categories.index') }}" method="GET">
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
                                            <th>{{ __('Tên') }}</th>
                                            <th>{{ __('Các liên kết khác') }}</th>
                                            <th>{{ __('Hành động') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($categories as $category)
                                            <tr>
                                                <td><span class="list-name">{{$category->name}}</span></td>
                                                <td>
                                                    <a href="{{ route('dashboard.films.index', ['searchKeyCategory' => $category->id]) }}" class="btn btn-info btn-sm">{{ __('Phim') }}</a>
                                                </td>
                                                <td>
                                                    @if(auth()->guard('admin')->user()->hasPermission('update_categories'))
                                                        <a href="{{route('dashboard.categories.edit', $category)}}">
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

                                                    @if(auth()->guard('admin')->user()->hasPermission('delete_categories'))
                                                        <form action="{{ route('dashboard.categories.destroy', $category) }}"
                                                              method="POST" style="display: inline-block">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit"
                                                                    class="btn btn-icon btn-neutral btn-icon-mini remove_category"
                                                                    title="{{ __('Xoá') }}" value="{{$category->id}}">
                                                                <i class="zmdi zmdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <button class="btn btn-icon btn-neutral btn-icon-mini disabled"
                                                                style="cursor: no-drop"
                                                                title="{{ __('Xoá') }}">
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
                {{$categories->appends(request()->query())->links()}}
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