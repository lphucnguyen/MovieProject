@extends('layouts.dashboard.app')

@section('content')

    @push('styles')
        <link rel="stylesheet" href="{{asset('web_files/css/bootstrap-fileinput.css')}}">
        <link href="{{asset('dashboard_files/assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"
              rel="stylesheet"/>
    @endpush

    <section class="content">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <h2>Sửa phim
                        {{-- <small>Welcome to Films</small> --}}
                    </h2>
                </div>
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <ul class="breadcrumb float-md-right">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i class="zmdi zmdi-home"></i>
                                Films</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Films</a></li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Sửa</strong> phim</h2>
                        </div>

                        <div class="body">
                            <form action="{{route('dashboard.films.update', $film)}}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>Thông tin</h2>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control"
                                                   placeholder="Name" value="{{ $film->name }}">
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('name') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" name="year" class="form-control"
                                                   placeholder="Year" value="{{ $film->year }}">
                                            <span style="color: red;margin-left: 10px">{{ $errors->first('year') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <select class="form-control show-tick" name="categories[]" multiple>
                                            <option selected disabled>Danh mục: </option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                {{in_array($category->id, $film->categories->pluck('id')->toArray()) ? 'selected' : ''}}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span style="color: red;margin-left: 10px">{{ $errors->first('categories') }}</span>
                                    </div>
                                </div>
                                <br>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <select class="form-control show-tick" name="actors[]" multiple>
                                            <option selected disabled>Diễn viên: </option>
                                            @foreach ($actors as $actor)
                                                <option value="{{ $actor->id }}"
                                                        {{in_array($actor->id, $film->actors->pluck('id')->toArray()) ? 'selected' : ''}}>
                                                    {{ $actor->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span style="color: red;margin-left: 10px">{{ $errors->first('actors') }}</span>
                                    </div>
                                </div>

                                <br>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <div class="header col-lg-12 col-md-12 col-sm-12">
                                            <h2>Tổng quan về phim</h2>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="overview" rows="4" class="form-control no-resize editor-summernote"
                                                      placeholder="Mô tả phim">{{ $film->overview }}</textarea>
                                            <span style="color: red; margin-left: 10px">{{ $errors->first('overview') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @livewire(
                                    'dashboard.films.add-episode',
                                    ['id' => $film->id]
                                )
                                <span style="color: red;margin-left: 10px">{{ $errors->first('api_url') }}</span>
                                <br>
                                <span style="color: red;margin-left: 10px">{{ $errors->first('url') }}</span>

                                <div class="header col-lg-12 col-md-12 col-sm-12">
                                    <h2>Hình ảnh về phim</h2>
                                </div>
                                <div class="form-group last mt-5">
                                    <img class="fileinput-preview fileinput-exists thumbnail preview-image-background_cover"
                                             style="max-width: 200px; max-height: 150px;" src="{{ old('background_cover', $film->background_cover) }}">
                                    <span class="btn btn-dark btn-file select-background_cover-file">
                                        <span class="fileinput-new"> Chọn ảnh bìa </span>
                                        <input type="hidden" name="background_cover" class="background_cover-file"
                                               value="{{ old('background_cover', $film->background_cover) }}">
                                    </span>
                                    <span style="color: red; margin-left: 10px; display: block;">{{ $errors->first('background_cover') }}</span>
                                </div>


                                <div class="form-group last">
                                    <img class="fileinput-preview fileinput-exists thumbnail preview-image-poster"
                                             style="max-width: 200px; max-height: 150px;" src="{{ old('poster', $film->poster) }}">
                                    <span class="btn btn-dark btn-file select-poster-file">
                                        <span class="fileinput-new"> Chọn ảnh poster </span>
                                        <input type="hidden" name="poster" class="poster-file"
                                               value="{{ old('poster', $film->poster) }}">
                                    </span>
                                    <span style="color: red; margin-left: 10px; display: block;">{{ $errors->first('poster') }}</span>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary btn-round">{{__('Cập nhật')}}</button>
                                        <button type="reset" class="btn btn-default btn-round btn-simple">{{__('Huỷ bỏ')}}</button>
                                        <a href={{route('dashboard.films.index')}} class="btn btn-second btn-round">{{__('Quay lại')}}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="{{asset('web_files/js/bootstrap-fileinput.js')}}"></script>
        <script>
            let file = '';

            $('.select-background_cover-file').on('click', function (event) {
                event.preventDefault();

                file = "background_cover-file";
                window.open('/file-manager/fm-button', 'FileManager', 'width=900,height=600');
            });

            $(".select-poster-file").click(function (event) {
                event.preventDefault();

                file = "poster-file";
                window.open('/file-manager/fm-button', 'FileManager', 'width=900,height=600');
            });


            function fmSetLink(url) {
                if (file === 'background_cover-file') {
                    $('.background_cover-file').attr('value', url);
                    $('.preview-image-background_cover').attr('src', url);
                } else if (file === 'poster-file') {
                    $('.poster-file').attr('value', url);
                    $('.preview-image-poster').attr('src', url);
                } else {
                    $('.editor-summernote').summernote('insertImage', url);
                }
            }
        </script>
    @endpush

@endsection