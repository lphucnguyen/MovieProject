@extends('layouts.web.app')
@section('content')
    @push('style')
        <style rel="stylesheet">
            li.active{
                color: yellow;
            }
        </style>
    @endpush
    <div class="hero common-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1> {{ __('Phim') }} <span> {{ request()->search ? ' : " ' . request()->search . ' "' : ''}} {{request()->category ? ' : " ' . request()->category . ' "' : ''}}</span></h1>
                        <ul class="breadcumb">
                            <li class="active"><a href="/"><b>{{ __('Trang chủ') }}</b></a></li>
                            <li><span class="ion-ios-arrow-right"></span><b>{{ __('Danh sách phim') }}</b></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-single">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="topbar-filter">
                        <p>{{ __('Tìm thấy') }} <span>{{ $films->count() }}</span> {{ __('phim') }}</p>
                    </div>
                    <div class="flex-wrap-movielist">
                        @foreach($films as $film)
                            <div class="movie-item-style-2 movie-item-style-1">
                                <img src="{{ $film->poster }}" style="height: 260px" alt="">
                                <div class="hvr-inner">
                                    <a href="{{url('movies/'.$film->id)}}"> {{ __('Chi tiết') }} </a>
                                </div>
                                <div class="mv-item-infor">
                                    <h6><a href="#">{{$film->name}}</a></h6>
                                    <p class="rate"><i class="ion-android-star"></i><span>{{round($film->ratings->avg('rating'), 2) ?? 0}}</span> /5</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $films->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection