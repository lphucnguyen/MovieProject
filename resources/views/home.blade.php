{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--<div class="row justify-content-center">--}}
{{--<div class="col-md-8">--}}
{{--<div class="card">--}}
{{--<div class="card-header">Dashboard</div>--}}

{{--<div class="card-body">--}}
{{--@if (session('status'))--}}
{{--<div class="alert alert-success" role="alert">--}}
{{--{{ session('status') }}--}}
{{--</div>--}}
{{--@endif--}}

{{--You are logged in!--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endsection--}}

@extends('layouts.web.app')
@section('content')

    <div class="slider movie-items">
        <div class="container">
            <div class="row">
                <div class="slick-singleItem">
                    @foreach($data->sliderFilms as $film)
                        <div class="movie-item">
                            <div class="mv-img">
                                <a href="#">
                                    <img alt=""
                                    height="437"
                                    style="height: 400px;"
                                    src="{{$film->poster}}"
                                    width="285">
                                </a>
                            </div>
                            <div class="title-in">
                                <div class="cate">
                                    @foreach($film->categories as $category)
                                        <span class="blue"><a href="#">{{$category->name}}</a></span>
                                    @endforeach
                                </div>
                                <h6><a href="{{url('movies/'.$film->id)}}">{{$film->name}}</a></h6>
                                <p><i class="ion-android-star"></i><span>{{round($film->ratings->avg('rating'), 2) ?? 0}}</span>
                                    /5
                                </p>
                                <a 
                                    style="background-color: #dd003f!important; color: white; font-weight: bold; padding: 11px 25px; white-space: nowrap;" 
                                    href="{{url('movies/'.$film->id)}}"
                                >
                                {{ __('Xem Phim') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="slick-multiItemSlider">
                    @foreach($data->sliderFilms as $film)
                        <div class="movie-item">
                            <div class="mv-img">
                                <a href="#">
                                    <img alt=""
                                    height="437"
                                    style="height: 400px;"
                                    src="{{$film->poster}}"
                                    width="285">
                                </a>
                            </div>
                            <div class="hvr-inner">
                                <a href="{{url('movies/'.$film->id)}}"> {{ __('Chi tiết') }} </a>
                            </div>
                            <div class="title-in">
                                <div class="cate">
                                    @foreach($film->categories as $category)
                                        <span class="blue"><a href="#">{{$category->name}}</a></span>
                                    @endforeach
                                </div>
                                <h6><a href="{{url('movies/'.$film->id)}}">{{$film->name}}</a></h6>
                                <p><i class="ion-android-star"></i><span>{{round($film->ratings->avg('rating'), 2) ?? 0}}</span>
                                    /5</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="movie-items">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-12">
                    @if(count($data->suggestedFilms) > 0)
                    <div class="title-hd">
                        <h2>{{ __('Phim đề xuất cho bạn') }}</h2>
                        {{-- <a class="viewall" href="{{url('movies?category=' . $category->name)}}">Tất cả <i
                                    class="ion-ios-arrow-right"></i></a> --}}
                    </div>
                    <div class="tabs">
                        <div class="tab-content" style="margin-top: 15px;">
                            <div class="tab active">
                                <div class="row">
                                    <div class="slick-multiItem" style="margin-top: 10px">
                                        @foreach($data->suggestedFilms as $key => $film)
                                            <div class="slide-it">
                                                <div class="movie-item">
                                                    <div class="mv-img">
                                                        <img alt="" src="storage/{{$film->poster}}" style="height: 280px">
                                                    </div>
                                                    <div class="hvr-inner">
                                                        <a href="{{url('movies/'.$film->id)}}"> {{ __('Chi tiết') }} </a>
                                                    </div>
                                                    <div class="title-in">
                                                        <h6><a href="#">{{$film->name}}</a></h6>
                                                        <p>
                                                            <i class="ion-android-star"></i><span>{{$data->ratings[$key]}}</span>
                                                            /5</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @foreach($data->categoryFilms as $category)
                        {{$category->films->count()}}
                        <div class="title-hd">
                            <h2>{{$category->name}}</h2>
                            <a class="viewall" href="{{url('movies?category=' . $category->name)}}">{{ __('Tất cả') }} <i
                                        class="ion-ios-arrow-right"></i></a>
                        </div>
                        <div class="tabs">
                            <ul class="tab-links">
                                <li><span style="color: lightslategray"> {{$category->films->count()}} {{ __('Phim') }}</span>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab active">
                                    <div class="row">
                                        <div class="slick-multiItem" style="margin-top: 10px">
                                            @foreach($category->films as $film)
                                                <div class="slide-it">
                                                    <div class="movie-item">
                                                        <div class="mv-img">
                                                            <img alt="" src="{{$film->poster}}" style="height: 280px">
                                                        </div>
                                                        <div class="hvr-inner">
                                                            <a href="{{url('movies/'.$film->id)}}"> {{ __('Chi tiết') }} </a>
                                                        </div>
                                                        <div class="title-in">
                                                            <h6><a href="#">{{$film->name}}</a></h6>
                                                            <p>
                                                                <i class="ion-android-star"></i><span>{{round($film->ratings->avg('rating'), 2) ?? 0}}</span>
                                                                /5</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

