@extends('layouts.web.app')
@section('content')
    @push('style')
        <style rel="stylesheet">
            li.active {
                color: yellow;
            }

            .page-item.active {
                margin-left: 0px !important;
            }
        </style>
    @endpush

<footer class="ht-footer" id="contact_us">
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="flex-parent-ft">
                <div class="flex-child-ft item1">
                    <div class="blog-detail-ct">
                        <div class="comment-form">
                            <h4 style="text-align: center; font-size: 30px;">Liên hệ với chúng tôi</h4>
                            <img alt="" class="logo" 
                                style="width: 100%;" 
                                src="{{asset('web_files/images/logo1.png')}}" 
                            >
                            <form action="{{url('message')}}" method="POST">
                                @csrf
                                @error('email')
                                <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input name="email" placeholder="Email" type="email" required>

                                @error('title')
                                <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <input name="title" placeholder="Tiêu đề" type="text" required>

                                @error('message')
                                <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <textarea name="message" id="" placeholder="Tin nhắn" style="margin: 0px 0px 30px; resize: none" required></textarea>

                                <button style="width: 100%;" class="submit" type="submit"> Gửi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
@endsection