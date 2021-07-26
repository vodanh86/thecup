@extends('layouts.app')
@section('body')
<body class="purchase-body">
@endsection
@section('content')
<!--Category-banner-start-->
<div class="category-banner">
    <div class="text-block">
        <p class="category">Trang</p>
        <p class="eco">Mua gói</p>
    </div>
</div>
<!--Category-banner-end-->
<!--Contact-start-->
<div class="purchase-holder">
    <div class="container">
        <div class="row">
            @foreach($plans as $plan)
            <div class="col-md-3">
                <div class="package-box" style="background-color: {{$plan->color}}">
                    <p class="package-title" style="color: white">{{$plan->name}}</p>
                    <p class="pricing" style="color: white">{{number_format($plan->price)}} VND</p>
                    <p class="package-info" style="color: white">Giới hạn truy cập bài viết: {{$plan->duration}} tháng</p>
                    <p class="package-info" style="color: white">Số tháng cộng thêm: {{$plan->added_month}} tháng</p>
                    <button class="btn select-package button-blue">
                        <a href="{{url('user/subscribe')}}">Chọn gói</a>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="contact">Cần hỗ trợ xin vui lòng liên hệ 1800 1243</div>
    </div>
</div>
<!--Contact-end-->
</div>
@endsection