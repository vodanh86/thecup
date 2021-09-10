<?php
use App\Admin\Controllers\Constant;?>
@extends('layouts.app')
@section('body')
<body class="my-account-body">
@endsection

@section('content')
<!--Category-banner-start-->
<div class="category-banner">
  <div class="text-block">
    <p class="category">Trang</p>
    <p class="eco">Tài khoản của tôi</p>
  </div>
</div>
<!--Category-banner-end-->
@include('layouts.message')
<!--Contact-start-->
<div class="contact-holder">
  <div class="container">
    <div class="row">
      <div class="col-md-7 right">
        <p class="title">
          Thông tin cá nhân
        </p>
        <?php $user = Auth::user() ?>
        <form method="POST" enctype="multipart/form-data" id="laravel-ajax-file-upload" action="/" >
          <div class="upload-avatar">
            <p class="text">Ảnh đại diện</p>
            <div class="upload-button">
              <img src="<?=$user->avatar ? (substr( $user->avatar, 0, 4 ) === "http" ? $user->avatar : env('AWS_URL').$user->avatar) : '../resources/img/user-img/avatar-icon.svg'?>" id="imgAvatar" alt="">
            </div>
            <input type="file" class="input" accept="image/*" onchange="submitImage()" name="avatar" >
          </div>
        </form>
        <form method="POST" id="updateForm" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-6">
            <p class="input-name">Họ và tên</p>
            <div class="input-group">
                <input id="nameInput" type="text" class="form-control" name="name" placeholder="Họ và tên của bạn" value="{{$user->name}}"
                  value="{{ old('name') }}"  autocomplete="name" autofocus>
                <input type="hidden" name="id" value="{{$user->id}}"/>
                <input type="hidden" name="avatar" value="{{$user->avatar}}" id="avatar"/>
                <span class="invalid-feedback" role="alert" id="nameError">
                    <strong></strong>
                </span>
              </div>
            <p class="input-name">Số điện thoại</p>
            <div class="input-group">
              <input type="tel" id="phone" name="phone" pattern="0[0-9]{9}" class="form-control" 
              value="{{$user->phone}}"
              placeholder="Số điện thoại liên hệ" aria-label="Recipient's username with two button addons">
            </div>
          </div>
          <div class="col-md-6">
            <p class="input-name">Email</p>
            <div class="input-group">
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$user->email}}" readonly required>
            </div>
            <p class="input-name">Ngày sinh</p>
            <div class="input-group date" data-provide="datepicker" class="date-picker">
              <input type="text" class="form-control" name="birthdate" value="{{date('d-m-Y', strtotime($user->birthdate))}}"  >
              <div class="input-group-addon">
                <span class="material-icons">today</span>
              </div>

            </div>
          </div>
        </div>
        <div class="margin-top"></div>
        <p class="title">
          Thông tin tài khoản
        </p>
        <div class="row">
          <div class="col-md-6">
            <p class="input-name">Mật khẩu</p>
            <div class="input-group">
              <input id="passwordInput" type="password" class="form-control" value="******"
                      name="password" required autocomplete="new-password">

              <span class="invalid-feedback" role="alert" id="passwordError">
                  <strong></strong>
              </span>
             </div>
          </div>
          <div class="col-md-6">
            <p class="input-name">Nhập lại mật khẩu</p>
            <div class="input-group">
              <input id="password-confirm" type="password" class="form-control" value="******"
                      name="password_confirmation" required autocomplete="new-password">
             </div>
          </div>
        </div>
        <button class="btn btn-primary">Cập nhật thông tin</button>
        </form>
      </div>
      <div class="col-md-5 left">
        <div class="text-head">
          <p class="text">thông tin gói sử dụng</p>
          <button class="btn" id="purchaseHistory">
            <p class="history">Lịch sử mua gói</p>
          </button>
        </div>
        @if($user->package_type == 1)
        <div class="sixmonth-card">
        <img src="{{url('resources/img/sixmonth-card.svg')}}" alt="">
          <div class="card-inner">
            <p class="card-title white">Thành viên</p>
            <p class="card-scope">Trạng thái: <?php 
            if ($user->package_type == 1 || $user->package_type == 0){
              echo("Còn hạn");
            } else {
              echo("Hết hạn");
            }
            ?></p>
            <div class="expire">
              <span class="text white">Thời hạn sử dụng</span>
              <span class="date">              <?php 
              $expire_time = strtotime($user->expire_time);
              echo(date('H:i:s d/m/Y',$expire_time));
              ?> </span>
            </div>
          </div>
        </div>
        <a href="{{url('user/purchase')}}">
          <button class="btn btn-primary">
              Nâng cấp gói
          </button>
        </a>
        @else
        <div class="trial-card">
          <img src="{{url('resources/img/trial-card.svg')}}" alt="">
          <div class="card-inner">
            <p class="card-title">Dùng thử</p>
            <p class="card-scope">Trạng thái: <?php 
            if ($user->package_type == 1 || $user->package_type == 0){
              echo("Còn hạn");
            } else {
              echo("Hết hạn");
            }
            ?></p>
            <div class="expire">
              <span class="text">Thời hạn sử dụng</span>
              <span class="date">
              <?php 
              $expire_time = strtotime($user->expire_time);
              echo(date('H:i:s d/m/Y',$expire_time));
              ?> </span>
            </div>
          </div>
        </div>
        <a href="{{url('user/purchase')}}">
          <button class="btn btn-primary">
              Nâng cấp gói
          </button>
        </a>
      @endif
      </div>
    </div>
  </div>
</div>
<!--Contact-end-->
<div class="popup-purchase" id="popupPurchase">
  <div class="holder">
    <div class="upper">
      <span>Lịch sử mua gói</span>
      <button class="btn" id="purchaseHisCloseBtn">
        <img src="{{url('resources/img/icon/ic_x.svg')}}" width="16" height="16" alt="">
      </button>
    </div>
    <div class="lower table-responsive">
      <table class="table table-hover table-bordered">
        <thead>
        <tr>
          <th scope="col">Ngày</th>
          <th scope="col">Gói mua</th>
          <th scope="col">Hình thức thanh toán</th>
          <th scope="col">Thành tiền</th>
          <th scope="col">Thành bắt đầu dịch vụ</th>
          <th scope="col">Thành kết thúc dịch vụ</th>
          <th scope="col">Trạng thái</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
        <tr>
          <th scope="row">{{$order->created_at}}</th>
          <td>{{$order->plan->name}}</td>
          <td>{{$order->payment_type}}</td>
          <td>{{number_format($order->price)}} VND</td>
          <td>{{$order->start_date}}</td>
          <td>{{$order->end_date}}</td>
          <td>{{Constant::ORDER_STATUS[$order->status]}}</td>
        </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('scripts')
@parent

<script>
$(function () {
  submitImage = function(e) {
    var form = $('#laravel-ajax-file-upload');
    var formData = new FormData(form[0]);
    $.ajax({
      type:'POST',
      url: "{{ url('user/updateAvatar')}}",
      data: formData,
      cache:false,
      contentType: false,
      processData: false,
      success: (data) => {
        $("#imgAvatar").prop("src", data.file);
        $("#avatar").val(data.path);
    },
    error: function(data){
      console.log(data);
      }
    });
  }; 
  $('#updateForm').submit(function (e) {
      e.preventDefault();
      let formData = $(this).serializeArray();
      $(".invalid-feedback").children("strong").text("");
      $("#registerForm input").removeClass("is-invalid");
      
      $.ajax({
          method: "POST",
          headers: {
              Accept: "application/json"
          },
          url: "{{ url('user/update') }}",
          data: formData,
          success: (data) => {
            $(".messages").html('    <div class="alert alert-success alert-block">' + 
                                    '<strong id="success-message">Cập nhật thành công</strong>'+
                                    (data.verify == 1 ? "<br/><strong id='success-message'>Bạn được tặng thêm 3 tháng thành viên do cập nhật đầy đủ thông tin cá nhân.</strong>" : "") +
                                    '<button type="button" class="close" style="float:right" data-dismiss="alert">×</button>	'+
                                '</div>' );
            //window.location.assign("{{ route('home') }}")
          },
          error: (response) => {
              if(response.status === 401) {
                  //window.location.reload();
              } else if(response.status === 422) {
                  let errors = response.responseJSON.errors;

                  Object.keys(errors).forEach(function (key) {
                      $("#" + key + "Input").addClass("is-invalid");
                      $("#" + key + "Error").children("strong").text(errors[key][0]);
                  });
              } else {
                  //window.location.reload();
              }

          }
      })
  });
})
</script>
<script src="{{url('assets/js/datepickr.js')}}"></script>
@endsection