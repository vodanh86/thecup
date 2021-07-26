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
              <img src="<?=$user->avatar ? env('AWS_URL').$user->avatar : '../resources/img/user-img/avatar-icon.svg'?>" id="imgAvatar" alt="">
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
          <div class="card-inner">
            <p class="card-title white">Thành viên</p>
            <p class="card-scope white">Truy cập không giới hạn</p>
            <div class="expire">
              <span class="text white">Thời hạn sử dụng</span>
              <span class="date">{{$user->expire_time}}</span>
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
          <div class="card-inner">
            <p class="card-title">Dùng thử</p>
            <p class="card-scope">Truy cập giới hạn</p>
            <div class="expire">
              <span class="text">Thời hạn sử dụng</span>
              <span class="date">
              <?php 
              $expire_time = strtotime($user->expire_time);
              echo(date('d/m/Y H:i:s',$expire_time));
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
          success: () => {
            $(".messages").html('    <div class="alert alert-success alert-block">' + 
                                    '<strong id="success-message">Cập nhật thành công</strong>'+
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
@endsection