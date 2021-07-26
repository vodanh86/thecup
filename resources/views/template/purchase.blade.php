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
            <div class="col-md-3">
                <div class="package-box">
                    <p class="package-title">Dùng thử 7 ngày</p>
                    <p class="pricing">Miễn phí</p>
                    <p class="package-info">Giới hạn truy cập bài viết</p>
                    <p class="package-info">Giới hạn thời gian nghe Podcast</p>
                    <button class="btn select-package">Chọn gói</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="package-box orange-box">
                    <p class="package-title" style="color: white">3 tháng</p>
                    <p class="pricing" style="color: white">300.000đ</p>
                    <p class="package-info" style="color: white">Giới hạn truy cập bài viết</p>
                    <p class="package-info" style="color: white">Giới hạn thời gian nghe Podcast</p>
                    <button class="btn select-package button-orange">Chọn gói</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="package-box blue-box">
                    <p class="package-title" style="color: white">6 tháng</p>
                    <p class="pricing" style="color: white">500.000đ</p>
                    <p class="package-info" style="color: white">Giới hạn truy cập bài viết</p>
                    <p class="package-info" style="color: white">Giới hạn thời gian nghe Podcast</p>
                    <button class="btn select-package button-blue">Chọn gói</button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="package-box">
                    <p class="package-title">12 tháng</p>
                    <p class="pricing">900.000đ</p>
                    <p class="package-info">Giới hạn truy cập bài viết</p>
                    <p class="package-info">Giới hạn thời gian nghe Podcast</p>
                    <button class="btn select-package">Chọn gói</button>
                </div>
            </div>
        </div>
        <div class="contact">Cần hỗ trợ xin vui lòng liên hệ 1800 1243</div>
    </div>
</div>
<!--Contact-end-->
</div>
@endsection