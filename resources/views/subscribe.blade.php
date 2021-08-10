@extends('layouts.app')
@section('body')
<body class="my-account-body">
@endsection

@section('content')
<!--Category-banner-start-->
<div class="category-banner">
  <div class="text-block">
    <p class="category">Trang</p>
    <p class="eco">Thanh toán</p>
  </div>
</div>
<!--Category-banner-end-->
@include('layouts.message')
<div id="loginBody" class="login-body fixed-top" style="visibility: visible; opacity: 1">
    <div class="logo-thecup">
        <img src="/thecup/resources/img/logo-login-register.svg" alt="">
    </div>
    <div class="register-holder">
        <div class="upper">
          <?php $user = Auth::user() ?>
          <form action="{{url('/payment/createPayment')}}" id="create_form">  
              <p class="reg-title">Thông tin thanh toán</p>
              <p class="purchase-text">Số tiền thanh toán</p>
              <p class="purchase-amount">{{number_format($plan->price)}}</p>
              <input class="form-control" id="amount" style="display:none"
                        name="amount" type="number" value="{{$plan->price}}"/>
              <div class="custom-divider"></div>
              <div class="custom-decor-left"></div>
              <div class="custom-decor-right"></div>

              <div class="purchase-information-holder">
                  <div class="line">
                      <div class="row">
                          <div class="col-md-5">
                            <input type = "hidden" value="{{$plan->id}}" name="plan_id"/>
                              <p class="title">Loại thanh toán</p>
                          </div>
                          <div class="col-md-7">
                              <select name="order_type" id="order_type" class="form-control" style="display:none">
                                  <option value="billpayment">Thanh toán gói dịch vụ</option>
                              </select>
                              <p class="value">Thanh toán gói dịch vụ</p>
                          </div>
                      </div>
                  </div>
                  <div class="line">
                      <div class="row">
                          <div class="col-md-5">
                              <p class="title">Mã hóa đơn</p>
                          </div>
                          <div class="col-md-7">
                              <input class="form-control" id="order_id" name="order_id" type="text" value="{{$order->order_code}}" style="display:none"/>
                              <p class="value">{{$order->order_code}}</p>
                          </div>
                      </div>
                  </div>
                  <div class="line">
                      <div class="row">
                          <div class="col-md-5">
                              <p class="title">Nội dung thanh toán</p>
                          </div>
                          <div class="col-md-7">
                              <textarea class="form-control" style="display:none" cols="20" id="order_desc" name="order_desc" rows="2" readonly>Thanh toan goi dich vu {{$plan->duration + $plan->added_month}} thang. Thoi han goi dich vu {{$plan->duration + $plan->added_month}} thang
                              </textarea>
                              <p class="value">Thanh toan goi dich vu {{$plan->duration + $plan->added_month}} thang. Thoi han goi dich vu {{$plan->duration + $plan->added_month}} thang</p>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="row">
                <div class="col-md-6" style="display: none">
                  <p class="input-name">Ngân hàng</p>
                  <div class="input-group">
                      <select name="bank_code" id="bank_code" class="form-control">
                          <option value="">Không chọn</option>
                          <option value="NCB"> Ngan hang NCB</option>
                          <option value="AGRIBANK"> Ngan hang Agribank</option>
                          <option value="SCB"> Ngan hang SCB</option>
                          <option value="SACOMBANK">Ngan hang SacomBank</option>
                          <option value="EXIMBANK"> Ngan hang EximBank</option>
                          <option value="MSBANK"> Ngan hang MSBANK</option>
                          <option value="NAMABANK"> Ngan hang NamABank</option>
                          <option value="VNMART"> Vi dien tu VnMart</option>
                          <option value="VIETINBANK">Ngan hang Vietinbank</option>
                          <option value="VIETCOMBANK"> Ngan hang VCB</option>
                          <option value="HDBANK">Ngan hang HDBank</option>
                          <option value="DONGABANK"> Ngan hang Dong A</option>
                          <option value="TPBANK"> Ngân hàng TPBank</option>
                          <option value="OJB"> Ngân hàng OceanBank</option>
                          <option value="BIDV"> Ngân hàng BIDV</option>
                          <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                          <option value="VPBANK"> Ngan hang VPBank</option>
                          <option value="MBBANK"> Ngan hang MBBank</option>
                          <option value="ACB"> Ngan hang ACB</option>
                          <option value="OCB"> Ngan hang OCB</option>
                          <option value="IVB"> Ngan hang IVB</option>
                          <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                      </select>
                  </div>
                </div>
                <div class="col-md-12" style="display:none">
                  <p class="input-name">Ngôn ngữ</p>
                  <div class="input-group">
                      <select name="language" id="language" class="form-control">
                          <option value="vn">Tiếng Việt</option>
                          <option value="en">English</option>
                      </select>
                  </div>
                </div>
              </div>
              
              <div class="oauth-button">
                  <button class="btn btn-outline-secondary btn-cancel-purchase" onclick="window.history.go(-1); return false;">
                      <span>Hủy bỏ</span>
                  </button>
                  <button class="btn btn-primary btn-accept-purchase">
                      <span>Xác nhận</span>
                  </button>
              </div>
            </form>
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

@section('scripts')
@parent
<link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
<script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
@endsection