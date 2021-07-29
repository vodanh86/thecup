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
<!--Contact-start-->
<div class="contact-holder">
  <div class="container">
    <div class="row">
      <div class="col-md-7 right" style="border:none; width: 60%">
        <p class="title">
          Thông tin thanh toán
        </p>
        <?php $user = Auth::user() ?>
        <form action="{{url('/payment/createPayment')}}" id="create_form">  
        <div class="row">
          <div class="col-md-12">
            <p class="input-name">Loại thanh toán</p>
            <div class="input-group">
                <input type = "hidden" value="{{$plan->id}}" name="plan_id"/>
                <select name="order_type" id="order_type" class="form-control">
                    <option value="billpayment">Thanh toán gói dịch vụ</option>
                </select>
              </div>
            <p class="input-name">Số tiền</p>
            <div class="input-group">
                <input class="form-control" id="amount"
                        name="amount" type="number" value="{{$plan->price}}"/>
            </div>
          </div>
          <div class="col-md-12">
            <p class="input-name">Mã hóa đơn</p>
            <div class="input-group">
                <input class="form-control" id="order_id" name="order_id" type="text" value="{{$order->order_code}}"/>
            </div>
            <p class="input-name">Nội dung thanh toán</p>
            <div class="input-group" style="position: relative">
                <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2" readonly>Thanh toan goi dich vu {{$plan->duration + $plan->added_month}} thang. Thoi han goi dich vu {{$plan->duration + $plan->added_month}} thang
              </textarea>
            </div>
          </div>
        </div>
        <div class="margin-top"></div>
        <p class="title">
          Thông tin thêm
        </p>
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
          <div class="col-md-12">
            <p class="input-name">Ngôn ngữ</p>
            <div class="input-group">
                <select name="language" id="language" class="form-control">
                    <option value="vn">Tiếng Việt</option>
                    <option value="en">English</option>
                </select>
             </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Thanh toán</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--Contact-end-->
@endsection

@section('scripts')
@parent
<link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
<script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
@endsection