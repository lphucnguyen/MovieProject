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
                                <small>{{auth()->guard('admin')->user()->getRoles()[0]}}</small>
                            </div>
                        </div>
                    </li>
                    <li class="active open">
                        <a href="{{route('dashboard.home')}}"><i class="zmdi zmdi-home"></i><span>Bảng điều khiển</span></a>
                    </li>

                    @if(auth()->guard('admin')->user()->hasPermission('read_admins'))
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account"></i><span>Admins</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.admins.index')}}">Tất cả Admin</a></li>
                                @if(auth()->guard('admin')->user()->hasPermission('create_admins'))
                                    <li><a href="{{route('dashboard.admins.create')}}">Thêm Admins</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_clients'))
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-circle"></i><span>Khách hàng</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.clients.index')}}">Tất cả khách hàng</a></li>
                                @if(auth()->guard('admin')->user()->hasPermission('create_clients'))
                                    <li><a href="{{route('dashboard.clients.create')}}">Thêm khách hàng</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_categories'))
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-view-list"></i><span>Danh mục</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.categories.index')}}">Tất cả danh mục</a></li>
                                @if(auth()->guard('admin')->user()->hasPermission('create_categories'))
                                    <li><a href="{{route('dashboard.categories.create')}}">Thêm danh mục</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_films'))
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-movie"></i><span>Phim</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.films.index')}}">Tất cả phim</a></li>
                                @if(auth()->guard('admin')->user()->hasPermission('create_films'))
                                    <li><a href="{{route('dashboard.films.create')}}">Thêm phim</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_actors'))
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-male"></i><span>Diễn viên</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.actors.index')}}">Tất cả diễn viên</a></li>
                                @if(auth()->guard('admin')->user()->hasPermission('create_actors'))
                                    <li><a href="{{route('dashboard.actors.create')}}">Thêm diễn viên</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_memberships'))
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-circle"></i><span>Gói thành viên</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.memberships.index')}}">Tất cả gói thành viên</a></li>
                                @if(auth()->guard('admin')->user()->hasPermission('create_actors'))
                                    <li><a href="{{route('dashboard.memberships.create')}}">Thêm gói thành viên</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_ratings'))
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-star"></i><span>Ratings</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.ratings.index')}}">Tất cả rating</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_reviews'))
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-comment-list"></i><span>Reviews</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.reviews.index')}}">Tất cả review</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(auth()->guard('admin')->user()->hasPermission('read_messages'))
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-email"></i><span>Messages</span>
                            </a>
                            <ul class="ml-menu">
                                <li><a href="{{route('dashboard.messages.index')}}">Tất cả tin nhắn</a></li>
                            </ul>
                        </li>
                    @endif

                    <br>

                </ul>
            </div>
        </div>
    </div>
</aside>