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
<!--Contact-start-->
<div class="contact-holder">
  <div class="container">
    <div class="row">
      <div class="col-md-7 right" style="border:none; width: 60%">
        <p class="title">
          Thông tin thanh toán
        </p>
        <div class="row">
            <div class="col-md-12">
                <p class="input-name">Mã đơn hàng</p>
                <div class="input-group">
                    <input class="form-control" id="amount"
                            name="amount" type="number" value="{{$payment->txn_ref}}" readonly/>
                </div>
                <p class="input-name">Số tiền</p>
                <div class="input-group">
                    <input class="form-control" id="amount"
                            name="amount"  value="<?=number_format($payment->amount). " VND"?>" readonly/>
                </div>
            </div>
            <div class="col-md-12">
                <p class="input-name">Nội dung thanh toán</p>
                <div class="input-group"  style="position: relative">
                    <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2" readonly><?php echo $payment->order_info ?>
                    </textarea>
                </div>
                <p class="input-name">Thời gian thanh toán</p>
                <div class="input-group" style="position: relative">
                    <input class="form-control" id="amount"
                            name="amount"  value="<?php echo $payment->paydate  ?>" readonly/>
                </div>
            </div>
            <div class="col-md-12">
                <p class="input-name">Mã GD Tại VNPAY</p>
                <div class="input-group"  style="position: relative">
                    <input class="form-control" id="amount"
                            name="amount"  value="<?php echo $payment->transaction_no ?>" readonly/>
                </div>
                <p class="input-name">Kết quả giao dịch</p>
                <div class="input-group" style="position: relative">
                    <input class="form-control" id="amount"
                            name="amount"  value="<?php
                                            if ($payment->vnp_checkhash) {
                                                if ($payment->response_code == '00') {
                                                    echo "GD Thanh cong";
                                                } else {
                                                    echo "GD Khong thanh cong";
                                                }
                                            } else {
                                                echo "Chu ky khong hop le";
                                            }
                                            ?>" readonly/>
                </div>
            </div>
        </div>
        <div class="margin-top"></div>
        <a href="{{url('user/profile')}}">
            <button type="submit" class="btn btn-primary">Đồng ý</button>
        </a>
      </div>
    </div>
  </div>
</div>
@endsection