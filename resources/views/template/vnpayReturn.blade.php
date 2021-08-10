@extends('layouts.app')
@section('body')
<body class="my-account-body">
@endsection

@section('content')
<div class="success-purchase-body fixed-top" style="visibility: visible; opacity: 1">
  <div class="logo-thecup">
    <img src="/thecup/resources/img/logo-login-register.svg" alt="">
  </div>
  <div class="register-holder">
    <div class="upper failed">
      @if ($payment->vnp_checkhash && $payment->response_code == "00")
        <img class="success-purchase-img" src="/thecup/resources/img/success-ic.svg" alt="">
        <p class="reg-title success">Thanh toán thành công</p>
      @else
        <img class="failed-purchase-img" src="/thecup/resources/img/failed-ic.svg" alt="">
         <p class="reg-title failed">Thanh toán thất bại</p>
      @endif
      <p class="purchase-text">Số tiền thanh toán</p>
      <p class="purchase-amount"><?=number_format($payment->amount/100). " VND"?></p>

      <div class="custom-divider"></div>
      <div class="custom-decor-left"></div>
      <div class="custom-decor-right"></div>

      <div class="purchase-information-holder">
        <div class="line">
          <div class="row">
            <div class="col-md-5">
              <p class="title">Mã đơn hàng</p>
            </div>
            <div class="col-md-7">
              <p class="value">{{$payment->txn_ref}}</p>
            </div>
          </div>
        </div>
        <div class="line">
          <div class="row">
            <div class="col-md-5">
              <p class="title">Thời gian thành toán</p>
            </div>
            <div class="col-md-7">
              <p class="value">{{$payment->paydate}}</p>
            </div>
          </div>
        </div>
        <div class="line">
          <div class="row">
            <div class="col-md-5">
              <p class="title">Nội dung thanh toán</p>
            </div>
            <div class="col-md-7">
              <p class="value"><?= $payment->order_info ?></p>
            </div>
          </div>
        </div>
        <div class="line">
          <div class="row">
            <div class="col-md-5">
              <p class="title">Mã giao dịch VN Pay</p>
            </div>
            <div class="col-md-7">
              <p class="value">{{$payment->transaction_no}}</p>
            </div>
          </div>
        </div>
      </div>

      <div class="oauth-button">
        <a href="{{url('user/profile')}}">
          <button class="btn btn-primary btn-accept-purchase">
            <span>Về trang chủ</span>
          </button>
        </a>
      </div>

    </div>
    <div class="lower">
      <div class="login-block">
        <span class="text">Mọi vấn đề phát sinh vui lòng liên hệ</span>
        <button class="btn btn-purchase-contact">
          <span class="login">1800 9990</span>
        </button>
      </div>
    </div>
  </div>
</div>
@endsection