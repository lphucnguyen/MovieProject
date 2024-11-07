<div class="col-md-12 col-sm-12 col-xs-12 my-3">
    <h2>{{ __('Video phim') }}</h2>
    <div id="movies-embed"></div>
    {{-- {!! $currentEpisode->url !!} --}}
    <h3 class="mt-5">{{ __('Danh sách tập phim') }}</h3>
    <ul class="d-flex">

        @foreach($episodes as $key => $episode)
        <li 
            wire:key="{{$key}}"
            class="mx-2 py-2 px-4 text-white cursor-pointer" 
            style="background-color: #405266; border-radius: 5px; cursor: pointer;"
            wire:click="selectEpisode({{$key}})"
        >
            {{$key + 1}}
        </li>
        @endforeach

    </ul>
</div>