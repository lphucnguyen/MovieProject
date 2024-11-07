@extends('layouts.web.app')
@section('content')

<div class="hero hero3" style="background: url('{{$actor->background_cover}}') no-repeat">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
</div>
<!-- celebrity single section-->

<div class="page-single movie-single cebleb-single">
    <div class="container">
        <div class="row ipad-width">
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="mv-ceb">
                    <img alt="" src="{{$actor->avatar}}" style="height: 475px">
                </div>
            </div>
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="movie-single-ct">
                    <h1 class="bd-hd">{{$actor->name}}</h1>
                    <p class="ceb-single">{{ __('Diễn viên') }}</p>
                    <div class="social-link cebsingle-socail">
                        <a href="#"><i class="ion-social-facebook"></i></a>
                        <a href="#"><i class="ion-social-twitter"></i></a>
                        <a href="#"><i class="ion-social-googleplus"></i></a>
                        <a href="#"><i class="ion-social-linkedin"></i></a>
                    </div>
                    <div class="movie-tabs">
                        <div class="tabs">
                            <ul class="tab-links tabs-mv">
                                <li class="active"><a href="#overviewceb">{{ __('Giới thiệu') }}</a></li>
                                <li><a href="#biography">{{ __('Tiểu sử')}}</a></li>
                                {{-- <li><a href="#filmography">Bộ phim</a></li> --}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab active" id="overviewceb">
                                    <div class="row">
                                        <div class="col-md-8 col-sm-12 col-xs-12">
                                            <div class="rv-hd">
                                                <div>
                                                    <h3>{{ __('Giới thiệu về') }}</h3>
                                                    <h2>{{$actor->name}}</h2>
                                                </div>
                                            </div>
                                            <p style="word-break: break-all">{{$actor->overview}}</p>

                                        </div>
                                        <div class="col-md-4 col-xs-12 col-sm-12">
                                            <div class="sb-it">
                                                <h6>{{ __('Tên đầy đủ') }}: </h6>
                                                <p>{{$actor->name}}</p>
                                            </div>
                                            <div class="sb-it">
                                                <h6>{{ __('Ngày sinh') }}: </h6>
                                                <p>{{date('F d, Y',strtotime($actor->dob))}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="rv-hd mt-5">
                                            <div>
                                                <h3>{{ __('Các bộ phim đã diễn của') }}</h3>
                                                <h2>{{$actor->name}}</h2>
                                            </div>

                                        </div>
                                        <div class="topbar-filter">
                                            <p>{{ __('Tìm thấy') }} <span>{{$actor->films->count()}}</span> {{ __('phim') }}</p>
                                        </div>
                                        <!-- movie cast -->
                                        <div class="mvcast-item">
                                            @foreach($films as $film)
                                                <div class="cast-it">
                                                    <div class="cast-left cebleb-film">
                                                        <img alt="" src="{{$film->poster}}" style="height: 75px">
                                                        <div>
                                                            <a href="{{url('movies/' . $film->id)}}">{{$film->name}} </a>
                                                        </div>

                                                    </div>
                                                    <p>... {{$film->year}}</p>
                                                </div>
                                            @endforeach
                                            {{$films->appends(request()->query())->links()}}
                                        </div>
                                    </div>
                                </div>
                                <div class="tab" id="biography">
                                    <div class="row">
                                        <div class="rv-hd">
                                            <div>
                                                <h3>{{ __('Tiểu sử của') }}</h3>
                                                <h2>{{$actor->name}}</h2>
                                            </div>
                                        </div>
                                        <p style="word-break: break-all">{{$actor->biography}}</p>
                                    </div>
                                </div>
                                {{-- <div class="tab" id="filmography">
                                    <div class="row">
                                        <div class="rv-hd">
                                            <div>
                                                <h3>Các bộ phim đã diễn của</h3>
                                                <h2>{{$actor->name}}</h2>
                                            </div>

                                        </div>
                                        <div class="topbar-filter">
                                            <p>Tìm thấy <span>{{$actor->films->count()}}</span> phim</p>
                                        </div>
                                        <!-- movie cast -->
                                        <div class="mvcast-item">
                                            @foreach($films as $film)
                                                <div class="cast-it">
                                                    <div class="cast-left cebleb-film">
                                                        <img alt="" src="{{$film->poster}}" style="height: 75px">
                                                        <div>
                                                            <a href="{{url('movies/' . $film->id)}}">{{$film->name}} </a>
                                                        </div>

                                                    </div>
                                                    <p>... {{$film->year}}</p>
                                                </div>
                                            @endforeach
                                            {{$films->appends(request()->query())->links()}}
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- celebrity single section-->

@endsection