<?php 
use App\Models\Category;

$cats = Category::where('show', 1)
        ->orderBy('order')
        ->get()
        ->groupBy('parent_id');

$parentId = $cats[0][0]->id;
?>
@include('partials.login')
@include('partials.register')
@include('partials.forgot')
@include('partials.podcast')
<!--Footer-start-->
<footer class="footer-holder">
    <div class="footer-upper">
        <div class="container d-flex">
            <div class="footer-upper-content row">
                <div class="col-md-3">
                    <p class="footer-title">Khám phá nhiều hơn
                        các chủ đề nổi bật</p>
                </div>
                <div class="col-md-9 fix-margin">
                    <div class="row row-cols-auto">
                        @foreach($cats[$parentId] as $cat) 
                        <div class="col-4 col-md d-flex end">
                            <a href="{{ url('/category/'.$cat->slug) }}">
                                <div class="footer-content-box">
                                    <div class="footer-content-box-inner">
                                        <img class="content-box-icon material-icons"
                                             src="{{ url('/resources/img/'.$cat->image)}}">
                                        <div class="content-box-divider1"></div>
                                        <div class="content-box-divider2"></div>
                                        <p class="content-box-cat-name">{{$cat->title}}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-lower">
        <div class="container">
            <div class="social-connect">
                <span class="social-connect-text">Kết nối với chúng tôi</span>
                <div class="social-connect-icon">
                    <img src="/thecup/resources/img/icon/ic_facebook.svg" alt="">
                </div>
                <div class="social-connect-icon">
                    <img src="/thecup/resources/img/icon/ic_youtube.svg" alt="">
                </div>
                <div class="social-connect-icon">
                    <img src="/thecup/resources/img/icon/ic_instagram.svg" alt="">
                </div>
                <div class="social-connect-icon">
                    <img src="/thecup/resources/img/icon/ic_twitter.svg" alt="">
                </div>
            </div>
            <div class="divider"></div>
            <div class="the-cup-signature-holder d-flex">
                <div class="the-cup-signature-left me-auto">
                    <a href="#" class="the-cup-logo">
                        <img src="{{ url('/resources/img/logo-footer.svg')}}" alt="">
                    </a>
                    <a href="{{url('site/contact')}}" class="the-cup-footer-link">
                        <div class="text">Liên hệ</div>
                    </a>
                    <a href="#" class="the-cup-footer-link">
                        <div class="text">Điều khoản</div>
                    </a>
                    <a href="#" class="the-cup-footer-link">
                        <div class="text">Quảng cáo</div>
                    </a>
                </div>
                <div class="the-cup-signature-right ms-auto">
                    <span>© 2021. All rights reserved by The Cup.</span>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--Footer-end-->
