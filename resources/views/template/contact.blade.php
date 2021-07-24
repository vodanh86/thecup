@extends('layouts.app')
<body class="contact-body">
@section('body')
@endsection

@section('content')
<!--Category-banner-start-->
<div class="category-banner">
  <div class="text-block">
    <p class="category">Chuyên mục</p>
    <p class="eco">Liên hệ</p>
  </div>
</div>
<!--Category-banner-end-->
<!--Contact-start-->
<div class="contact-holder">
  <div class="container">
    <div class="row">
      <div class="col-md-5 contact-left">
        <div class="phone-number">
          <p class="title">Bạn cần trợ giúp? Liên hệ chúng tôi</p>
          <p class="number">0924 563 111</p>
          <p class="text phone-text">Thứ 2 đến thứ 7 từ 9:00 đến 18:00</p>
        </div>
        <div class="email">
          <p class="title">Chăm sóc khách hàng</p>
          <p class="mail">contact@thecup.vn</p>
          <p class="text">Nếu bạn có bất cứ câu hỏi nào!
          Hãy gửi email và chúng tôi sẽ phản hồi nó sớm nhất có thể</p>
        </div>
        <div class="address">
          <p class="title">Địa chỉ tòa soạn</p>
          <p class="addr">132 Trung Kính, Trung Hoà, Cầu Giấy, Hà Nội</p>
          <p class="text">Nếu bạn có bất cứ câu hỏi nào!
          Hãy gửi email và chúng tôi sẽ phản hồi nó sớm nhất có thể</p>
        </div>
      </div>
      <div class="col-md-7 contact-right">
        <p class="title">
          Hãy liên hệ với chúng tôi!
        </p>
        <div class="row">
          <div class="col-md-6">
            <p class="input-name">Họ và tên</p>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Họ và tên của bạn" aria-label="Recipient's username with two button addons">
            </div>
            <p class="input-name">Điện thoại</p>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Số điện thoại liên hệ" aria-label="Recipient's username with two button addons">
            </div>
          </div>
          <div class="col-md-6">
            <p class="input-name">Email liên hệ</p>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Email của bạn" aria-label="Recipient's username with two button addons">
            </div>
            <p class="input-name">Chủ đề</p>
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Chủ đề" aria-label="Recipient's username with two button addons"/>
            </div>
          </div>
        </div>
        <p class="input-name">Nội dung</p>
        <div class="form-floating">
          <textarea class="form-control" placeholder="Leave a comment here" id="commentTextarea" style="height: 200px"></textarea>
          <label for="commentTextarea">Nhập nội dung</label>
        </div>
        <button class="btn btn-primary">Gửi</button>
      </div>
    </div>
  </div>
</div>
<!--Contact-end-->
</div>
@endsection