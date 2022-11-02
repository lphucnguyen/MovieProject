<div>
    <div class="row clearfix">
        <div class="col-sm-12">
            <div class="header col-lg-12 col-md-12 col-sm-12">
                <h2>Video phim</h2>
            </div>
        </div>
        <div class="col-sm-12">
            @foreach($episodes as $key => $episode)

            <p>Tập {{$key + 1}}:</p>
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="form-group">
                        <textarea name="url[]" wire:model.defer="episodes.{{$key}}.url" rows="4" class="form-control no-resize"
                                  placeholder="Embed Code From JWPlayer Server"></textarea>
                        @error('episodes.'.$key.'.url') <span style="color: red; margin-left: 10px">{{ $message }}</span>  @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-5">
                    <div class="form-group">
                        <textarea name="api_url[]" wire:model.defer="episodes.{{$key}}.api_url" rows="4" class="form-control no-resize"
                                  placeholder="API URL"></textarea>
                        @error('episodes.'.$key.'.url') <span style="color: red; margin-left: 10px">{{ $message }}</span>  @enderror
                    </div>
                </div>
                <div class="col-sm-12 col-md-1">
                    <button wire:click="removeEpisode({{$key}})" type="button" class="btn btn-danger btn-round">Xoá</button>
                </div>
            </div>
        
            @endforeach
        </div>
        @if($typeFilm == 1)
        <button wire:click="addEpisode()" type="button" class="btn btn-primary btn-round">Thêm tập phim</button>
        @endif
    </div>
    <div class="row clearfix">
        <div class="col-sm-12">
            <div class="header col-lg-12 col-md-12 col-sm-12">
                <h2>Loại phim</h2>
            </div>
        </div>
        <div class="col-sm-12">
            <div style="margin-top: 10px">
                <input type="radio" value="1" {{$typeFilm == 1 ? 'checked' : ''}} wire:model="typeFilm" name="type_film" id="phim_bo">
                <label class="form-check-label" for="phim_bo">
                  Phim bộ
                </label>
            </div>
            <div style="margin-top: 10px">
                <input type="radio" value="2" {{$typeFilm == 2 ? 'checked' : ''}} wire:model="typeFilm" name="type_film" id="phim_le">
                <label class="form-check-label" for="phim_le">
                  Phim lẻ
                </label>
            </div>
        </div>
    </div>
</div>


