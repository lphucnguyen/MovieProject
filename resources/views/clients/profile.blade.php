@extends('layouts.web.app')
@section('content')
    @push('style')
        <link href="{{asset('web_files/css/bootstrap-fileinput.css')}}" rel="stylesheet">
    @endpush

    <div class="hero common-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>{{$user->first_name . ' ' . $user->last_name}}</h1>
                        <ul class="breadcumb">
                            <li class="active"><a href="#">Trang chủ</a></li>
                            <li><span class="ion-ios-arrow-right"></span>Hồ sơ</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-single">
        <div class="container">
            <div class="row ipad-width">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="user-information">
                        <div style="margin: 0" class="user-img">
                            <a href="#"><img alt="" src="{{$user->avatar}}"
                                             style="width: 150px; height: 150px; border-radius: 50%"><br></a>
                        </div>
                        <div class="user-fav">
                            <p>Chi tiết tài khoản</p>
                            <ul>
                                <li class="active"><a href="{{url('user/profile')}}">Hồ sơ</a></li>
                                <li><a href="{{url('user/favorites')}}">Phim yêu thích</a></li>
                                <li><a href="{{url('user/ratings')}}">Phim đã đánh giá</a></li>
                                <li><a href="{{url('user/reviews')}}">Phim đã bình luận</a></li>
                                <li><a href="{{url('user/transactions')}}">Lịch sử giao dịch</a></li>
                            </ul>
                        </div>
                        <div class="user-fav">
                            <p>Cài đặt</p>
                            <ul>
                                <li><a href="{{url('user/change_password/')}}">Thay đổi mật khẩu</a></li>
                                <li><a href="{{route('logout')}}">Đăng xuất</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div action="#" class="form-style-1 user-pro">
                        <h4>Thông tin chi tiết</h4>
                        <div class="col-md-12 form-it p-0">
                            <label>Loại thành viên: 
                                <strong style="color: white; font-size: 20px;">
                                    {{ $membershipOfUser }}
                                </strong>

                                @if(count($memberships) > 0)
                                <a 
                                    style="color: rgb(255, 253, 115); font-size: 15px;" 
                                    data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"
                                >(Nâng cấp)</a>
                                @endif
                            </label>
                            <p>
                                {{ $desciptionOfMembership }}
                            </p>
                            @if(count($memberships) > 0)
                            <div class="collapse w-100" id="collapseExample">
                                <div class="card card-body" style="background-color: transparent;">
                                    <form action="{{url('user/upgrade')}}" method="POST">
                                        @csrf

                                        <input type="hidden" value="{{$user->id}}" name="idUser" />
                                        <label class="flex-grow-1 m-0 mx-2">
                                            Lựa chọn membership:
                                        </label>
                                        <select name="idMembership" class="form-control mt-2">
                                            @foreach($memberships as $membership)
                                            @if($membership->title != $membershipOfUser)
                                            <option value="{{$membership->id}}">{{$membership->title}}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                        <div class="row mt-3">
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="d-flex align-items-center p-2 shadow-lg bg-white rounded">
                                                <input id="momo" name="payment" type="radio" value="momo">
                                                <label for="momo" class="flex-grow-1 m-0 mx-2">
                                                    <img src="/web_files/images/momo.png" class="mx-2" style="width: 40px; height: 40px;" /> Momo
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-12">
                                            <div class="d-flex align-items-center p-2 shadow-lg bg-white rounded">
                                                <input id="vnpay" name="payment" type="radio" value="vnpay">
                                                <label for="vnpay" class="flex-grow-1 m-0 mx-2">
                                                    <img src="/web_files/images/vnpay.png" class="mx-2" style="width: 40px; height: 40px;" />VNPay
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <input style="border-radius: 0px !important;" class="submit mt-4" type="submit" value="Thanh toán">
                                        </div>
                                    </form>
                                  </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <form action="{{url('user/profile/' . $user->id)}}" method="POST" class="user"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6 form-it">
                                    <label>Tài khoản</label>
                                    <input name="username" value="{{$user->username}}" placeholder="UserName"
                                           type="text" disabled>
                                    @error('username')
                                    <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-it">
                                    <label>Địa chỉ email</label>
                                    <input name="email" value="{{$user->email}}" placeholder="Email" type="email" disabled>
                                    @error('email')
                                    <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-it">
                                    <label>Họ</label>
                                    <input name="first_name" value="{{$user->first_name}}" placeholder="First Name"
                                           type="text">
                                    @error('first_name')
                                    <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-it">
                                    <label>Tên</label>
                                    <input name="last_name" value="{{$user->last_name}}" placeholder="Last Name"
                                           type="text">
                                    @error('last_name')
                                    <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-it">
                                    <label>Thay đổi Avatar</label>
                                    <div class="row">
                                        <div style="margin-left: 15px" class="form-group last">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail"
                                                     style="width: 200px; height: 150px;">
                                                    <img alt="" src="{{$user->avatar}}"/>
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail"
                                                     style="max-width: 200px; max-height: 150px;">
                                                </div>
                                                <div>
												<span class="btn btn-dark btn-file">
													<span class="fileinput-new"
                                                          style="color: white; border: thin solid white; border-radius: 5px; padding: 6px;"> Chọn hình ảnh </span>
													<span class="fileinput-exists"
                                                          style="color: dodgerblue; border: thin solid dodgerblue;border-radius: 5px; padding: 6px; margin-right: 6px; margin-top: 6px"> Change </span>
													<input name="avatar" value="{{$user->avatar}}" type="file">
												</span>
                                                    <a class="btn btn-red fileinput-exists" data-dismiss="fileinput"
                                                       style="color: red; border: thin solid red;border-radius: 5px; padding: 6px;">Remove </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @error('avatar')
                                    <span class="invalid-feedback" style="color: red; font-size: 12px" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <input class="submit" type="submit" value="Lưu">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="{{asset('web_files/js/bootstrap-fileinput.js')}}"></script>
    @endpush

@endsection