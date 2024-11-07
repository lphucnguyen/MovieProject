<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" href="/"><i
                        class="zmdi zmdi-home m-r-5"></i>Trang chủ</a></li>
        <li class="nav-item"><a class="nav-link active" href="{{route('dashboard.admins.edit', auth()->guard('admin')->user())}}"><i class="zmdi zmdi-account-box m-r-5"></i>Hồ sơ</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane stretchRight active">
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info">
                            <div class="image"><a href=""><img
                                            src="{{auth()->guard('admin')->user()->avatar}}"
                                            alt="User"></a></div>
                            <div class="detail">
                                <h4>{{auth()->guard('admin')->user()->name}}</h4>
                                <small>Roles: {{implode(',', auth()->guard('admin')->user()->getRoles())}}</small>
                            </div>
                        </div>
                    </li>
                    {{-- {{request()->routeIs('dashboard.admins.*')}} --}}
                    <li class="{{request()->is('dashboard.home.*') ? "active": ""}}">
                        <a href="{{route('dashboard.home')}}"><i class="zmdi zmdi-home"></i><span>{{ __('Bảng điều khiển') }}</span></a>
                    </li>

                    @if(auth()->guard('admin')->user()->hasPermission('read_admins'))
                        <li class="{{request()->is('dashboard/admins*') ? "active": ""}}">
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account"></i><span>{{ __('Admin') }}</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.admins.index')}}">{{ __('Tất cả Admin') }}</a></li>
                                @if(auth()->guard('admin')->user()->hasPermission('create_admins'))
                                    <li><a href="{{route('dashboard.admins.create')}}">{{ __('Thêm Admin') }}</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_clients'))
                        <li class="{{request()->is('dashboard/clients*') ? "active": ""}}">
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-circle"></i><span>{{ __('Khách hàng') }}</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.clients.index')}}">{{ __('Tất cả khách hàng') }}</a></li>
                                @if(auth()->guard('admin')->user()->hasPermission('create_clients'))
                                    <li><a href="{{route('dashboard.clients.create')}}">{{ __('Thêm khách hàng') }}</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_categories'))
                        <li class="open {{request()->route()->uri == 'dashboard/categories' ? "active": ""}}">
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-view-list"></i><span>{{ __('Danh mục') }}</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.categories.index')}}">{{ __('Tất cả danh mục') }}</a></li>
                                @if(auth()->guard('admin')->user()->hasPermission('create_categories'))
                                    <li><a href="{{route('dashboard.categories.create')}}">{{ __('Thêm danh mục') }}</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_films'))
                        <li class="{{request()->is('dashboard/films*') ? "active": ""}}">
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-movie"></i><span>{{ __('Phim') }}</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.films.index')}}">{{ __('Tất cả phim') }}</a></li>
                                @if(auth()->guard('admin')->user()->hasPermission('create_films'))
                                    <li><a href="{{route('dashboard.films.create')}}">{{ __('Thêm phim') }}</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_actors'))
                        <li class="{{request()->is('dashboard/actors*') ? "active": ""}}">
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-male"></i><span>{{ __('Diễn viên') }}</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.actors.index')}}">{{ __('Tất cả diễn viên') }}</a></li>
                                @if(auth()->guard('admin')->user()->hasPermission('create_actors'))
                                    <li><a href="{{route('dashboard.actors.create')}}">{{ __('Thêm diễn viên') }}</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_ratings'))
                        <li class="{{request()->is('dashboard/ratings*') ? "active": ""}}">
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-star"></i><span>{{ __('Đánh giá') }}</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.ratings.index')}}">{{ __('Tất cả đánh giá') }}</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_reviews'))
                        <li class="{{request()->is('dashboard/reviews*') ? "active": ""}}">
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-comment-list"></i><span>{{ __('Bình luận') }}</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.reviews.index')}}">{{ __('Tất cả bình luận') }}</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_messages'))
                        <li class="{{request()->is('dashboard/messages*') ? "active": ""}}">
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-email"></i><span>{{ __('Tin nhắn') }}</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.messages.index')}}">{{ __('Tất cả tin nhắn') }}</a></li>
                            </ul>
                        </li>
                    @endif

                    <br>

                </ul>
            </div>
        </div>
    </div>
</aside>