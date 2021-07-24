@extends('layouts.app')
<body class="my-account-body">
@section('body')
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
<!--Contact-start-->
<div class="contact-holder">
  <div class="container">
    <div class="row">
      <div class="col-md-7 right">
        <p class="title">
          Thông tin cá nhân
        </p>
        <div class="upload-avatar">
          <p class="text">Ảnh đại diện</p>
          <div class="upload-button">
            <img src="../resources/img/user-img/avatar-icon.svg" alt="">
          </div>
          <input type="file" class="input" accept="image/*">
        </div>
        <div class="row">
          <div class="col-md-6">
            <p class="input-name">Họ và tên</p>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Họ và tên của bạn" aria-label="Recipient's username with two button addons">
            </div>
            <p class="input-name">Số điện thoại</p>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Số điện thoại liên hệ" aria-label="Recipient's username with two button addons">
            </div>
          </div>
          <div class="col-md-6">
            <p class="input-name">Email</p>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Email của bạn" aria-label="Recipient's username with two button addons">
            </div>
            <p class="input-name">Ngày sinh</p>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Chủ đề" aria-label="Recipient's username with two button addons"/>
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
              <input type="text" class="form-control" placeholder="Mật khẩu mới phải bao gồm chữ cái đầu viết hoa" aria-label="Recipient's username with two button addons">
            </div>
          </div>
          <div class="col-md-6">
            <p class="input-name">Nhập lại mật khẩu</p>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Nhập lại mật khẩu mới" aria-label="Recipient's username with two button addons">
            </div>
          </div>
        </div>
        <button class="btn btn-primary">Cập nhật thông tin</button>
      </div>
      <div class="col-md-5 left">
        <div class="text-head">
          <p class="text">thông tin gói sử dụng</p>
          <button class="btn" id="purchaseHistory">
            <p class="history">Lịch sử mua gói</p>
          </button>
        </div>
        <div class="trial-card">
          <div class="card-inner">
            <p class="card-title">Dùng thử</p>
            <p class="card-scope">Truy cập giới hạn</p>
            <div class="expire">
              <span class="text">Thời hạn sử dụng</span>
              <span class="date">24:00 19/07/2021</span>
            </div>
          </div>
        </div>
        <button class="btn btn-primary">
          <a href="/thecup/template/purchase.html">
            Nâng cấp gói
          </a>
        </button>
        <div class="sixmonth-card">
          <div class="card-inner">
            <p class="card-title white">Dùng thử</p>
            <p class="card-scope white">Truy cập giới hạn</p>
            <div class="expire">
              <span class="text white">Thời hạn sử dụng</span>
              <span class="date">24:00 19/07/2021</span>
            </div>
          </div>
        </div>
        <button class="btn btn-primary">
          <a href="/thecup/template/purchase.html">
            Nâng cấp gói
          </a>

        </button>

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