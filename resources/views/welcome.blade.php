<?php
use App\Admin\Controllers\Util;
use App\Models\Category;

?>
@include('layouts.header')
<body class="homepage-body" id="homePageBody">
@include('layouts.nav')
@include('layouts.carousel')
<!--Radio-start-->
<div class="radio-holder">
    <div class="radio-title-frame">
        <div class="d-flex">
            <div class="radio-title me-auto">
                <span>Podcast được nghe nhiều</span>
            </div>
            <div class="radio-seemore ms-auto">
                <a href="{{url('')}}">
                    <span>Xem tất cả</span>
                </a>
            </div>
        </div>
    </div>
    <div class="radio-frame container">
        <div class="radio-frame-main">
            <div class="row">
                <div class="col-md-3 radio-img">
                    <img src="/thecup/resources/img/radio-frame.png" alt="">
                </div>
                <div class="col-md-9 radio-controller">
                    <p class="title" id="track">Bí mật đằng sau thành công của cuộc cách mạng tháng 8</p>
                    <p class="author">Nguyễn Thành Văn</p>
                    <div class="button-holder">
                        <button class="play-button" id="playBtn">
                            <span class="material-icons material-icons-outlined">play_arrow</span>
                        </button>
                        <button id="replay10s" class="btn">
                            <span class="material-icons material-icons-outlined">replay_10</span>
                        </button>
                        <button id="forward10s" class="btn">
                            <span class="material-icons material-icons-outlined">forward_10</span>
                        </button>
<!--                        <div class="prog" id="durationProgressWrapper">-->
<!--                            <input type="range" id="progress" min="1" max="100" value="50" class="progress-bar">-->
<!--                        </div>-->
                        <div class="prog" id="durationProgressWrapper">
                            <input type="range" min="0" max="100" value="0" class="slider" id="progress">
                        </div>
                        <div class="timer-holder">
                            <span id="timer" class="time-played">0:00</span>
                            <span> / </span>
                            <span id="duration" class="total-time">0:00</span>
                        </div>
                        <div class="volume-holder">
                            <span class="material-icons material-icons-outlined">volume_up</span>
                            <div class="progress" id="volumeProgressWrapper" style="visibility: hidden">
                                <div id="volProgress" class="progress-bar" role="progressbar" style="width: 80%;"
                                     aria-valuenow="25"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="radio-frame-behind1"></div>
        <div class="radio-frame-behind2"></div>
        <div class="radio-nav">
            <button class="btn btn-radio-prev" id="prevBtn">
                <span class="material-icons material-icons-outlined">
                chevron_left
                </span>
            </button>
            <button class="btn btn-radio-next" id="nextBtn">
                <span class="material-icons material-icons-outlined">
                chevron_right
                </span>
            </button>
        </div>
    </div>
</div>
<!--Radio-end-->
<div class="news-holder">
    <div class="container">
        <div class="row">
            <div class="news-main col-md-8">
                <div class="news-hightlight-article">
                    <div class="hightlight-upper d-flex">
                        <div class="upper-left me-auto">
                            <div class="hightlight-large-block">
                                <a href="{{ url('/page/'.$topPages[0]->slug) }}">
                                    <div class="hightlight-arcticle">
                                        <p>{{$cats[$topPages[0]->category_id]}}</p>
                                        <img src="{{url(env('AWS_URL')).$topPages[0]->image}}" alt="{{$topPages[0]->title}}">
                                    </div>
                                    <p class="article-datetime">{{Util::vnDateFormat($topPages[0]->created_at)}}</p>
                                    <p class="article-title">{{$topPages[0]->title}}</p>
                                </a>
                            </div>
                        </div>
                        <div class="upper-right ms-auto">
                            <div class="hightlight-small-block">
                                <a href="{{ url('/page/'.$topPages[1]->slug) }}">
                                    <div class="hightlight-arcticle">
                                        <p>{{$cats[$topPages[1]->category_id]}}</p>
                                        <img src="{{url(env('AWS_URL')).$topPages[1]->image}}" alt="{{$topPages[1]->title}}">
                                    </div>
                                    <p class="article-datetime">{{Util::vnDateFormat($topPages[1]->created_at)}}</p>
                                    <p class="article-title">{{$topPages[1]->title}}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="hightlight-lower d-flex">
                        <div class="lower-left me-auto">
                            <div class="hightlight-small-block">
                                <a href="{{ url('/page/'.$topPages[2]->slug) }}">
                                    <div class="hightlight-arcticle">
                                        <p>{{$cats[$topPages[2]->category_id]}}</p>
                                        <img src="{{url(env('AWS_URL')).$topPages[2]->image}}" alt="{{$topPages[2]->title}}">
                                    </div>
                                    <p class="article-datetime">{{Util::vnDateFormat($topPages[2]->created_at)}}</p>
                                    <p class="article-title">{{$topPages[2]->title}}</p>
                                </a>
                            </div>
                        </div>
                        <div class="lower-right ms-auto">
                            <div class="hightlight-large-block">
                                <a href="{{ url('/page/'.$topPages[3]->slug) }}">
                                    <div class="hightlight-arcticle">
                                        <p>{{$cats[$topPages[3]->category_id]}}</p>
                                        <img src="{{url(env('AWS_URL')).$topPages[3]->image}}" alt="{{$topPages[3]->title}}">
                                    </div>
                                    <p class="article-datetime">{{Util::vnDateFormat($topPages[3]->created_at)}}</p>
                                    <p class="article-title">{{$topPages[3]->title}}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="news-ads-banner">
                    <img src="resources/img/ads-banner/banner-1.png" alt="">
                </div>
                <div class="news-divider"></div>
                <div class="news-other-post">
                    @foreach($pages as $page)
                    <div class="other-post" style="min-height:250px">
                        <div class="row">
                            <div class="col-5">
                                <a href="{{ url('/page/'.$page->slug) }}">
                                    <img src="{{url(env('AWS_URL')).$page->image}}" alt="">
                                    @if($page->type == 1)
                                    <div class="listenable-box">
                                        <img width="32" height="32" class="listenable-icon"
                                            src="/thecup/resources/img/icon/ic_playlist.svg" alt="">
                                    </div>
                                    @endif
                                    @if($page->type == 2)
                                    <div class="listenable-box">
                                        <img width="14" height="18" class="listenable-icon play-icon"
                                            src="/thecup/resources/img/icon/ic_play.svg" alt="">
                                    </div>
                                    @endif
                                </a>
                            </div>
                            <div class="col-7">
                                <p class="other-post-category">{{Category::find($page->category_id)->title}}</p>
                                <p class="other-post-title"><a href="{{ url('/page/'.$page->slug) }}">{{$page->title}}</a></p>
                                <div class="other-post-information">
                                    <span class="other-post-date-info">{{Util::vnDateFormat($page->published_at)}}</span>
                                    <div class="info-seperator"></div>
                                    <span class="other-post-comment-info">3 bình luận</span>
                                </div>
                                <p class="other-post-description"><a href="{{ url('/page/'.$page->slug) }}">{!!$page->description!!}</a></p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="paging-sector">
                    {{ $pages->links() }}
                </div>
            </div>
            <div class="news-newest col-md-4">
                @include('layouts.newPages')
                @include('layouts.newPodcasts')
                <div class="comment">
                    <div class="title">
                        <p>Bình luận mới nhất</p>
                    </div>
                    <div class="comment-block">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="user-avatar"></div>
                            </div>
                            <div class="col-md-10">
                                <p class="user-name">tranvanan122</p>
                                <p class="comment-text">“Bài viết hay, bổ ích mới chỉ áp dụng được một phần thôi đã thấy
                                    hiệu quả hẳn ra. Nếu áp dụng được hết chắc chắn sẽ thành công”</p>
                                <a href="">
                                    <p class="post">Kĩ năng sống trong công sở</p>
                                </a>
                            </div>
                        </div>
                        <button class="btn btn-outline-secondary dropdown-toggle comment-block-button fas fa-ellipsis-v"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Thích</a></li>
                            <li><a class="dropdown-item" href="#">Không thích</a></li>
                            <li><a class="dropdown-item" href="#">Báo cáo</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Ẩn</a></li>
                        </ul>
                    </div>
                    <div class="comment-block">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="user-avatar"></div>
                            </div>
                            <div class="col-md-10">
                                <p class="user-name">nguyenquan</p>
                                <p class="comment-text">“Bài viết hay, bổ ích mới chỉ áp dụng được một phần thôi đã thấy
                                    hiệu quả hẳn ra. Nếu áp dụng được hết chắc chắn sẽ thành công”</p>
                                <a href="">
                                    <p class="post">Giá trị thật sự của tiền ảo</p>
                                </a>
                            </div>
                        </div>
                        <button class="btn btn-outline-secondary dropdown-toggle comment-block-button fas fa-ellipsis-v"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Thích</a></li>
                            <li><a class="dropdown-item" href="#">Không thích</a></li>
                            <li><a class="dropdown-item" href="#">Báo cáo</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Ẩn</a></li>
                        </ul>
                    </div>
                    <div class="comment-block">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="user-avatar"></div>
                            </div>
                            <div class="col-md-10">
                                <p class="user-name">nguyenquan</p>
                                <p class="comment-text">“Bài viết hay, bổ ích mới chỉ áp dụng được một phần thôi đã thấy
                                    hiệu quả hẳn ra. Nếu áp dụng được hết chắc chắn sẽ thành công”</p>
                                <a href="">
                                    <p class="post">Giá trị thật sự của tiền ảo</p>
                                </a>
                            </div>
                        </div>
                        <button class="btn btn-outline-secondary dropdown-toggle comment-block-button fas fa-ellipsis-v"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Thích</a></li>
                            <li><a class="dropdown-item" href="#">Không thích</a></li>
                            <li><a class="dropdown-item" href="#">Báo cáo</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Ẩn</a></li>
                        </ul>
                    </div>
                    <div class="comment-block">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="user-avatar"></div>
                            </div>
                            <div class="col-md-10">
                                <p class="user-name">nguyenquan</p>
                                <p class="comment-text">“Bài viết hay, bổ ích mới chỉ áp dụng được một phần thôi đã thấy
                                    hiệu quả hẳn ra. Nếu áp dụng được hết chắc chắn sẽ thành công”</p>
                                <a href="">
                                    <p class="post">Giá trị thật sự của tiền ảo</p>
                                </a>
                            </div>
                        </div>
                        <button class="btn btn-outline-secondary dropdown-toggle comment-block-button fas fa-ellipsis-v"
                                type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Thích</a></li>
                            <li><a class="dropdown-item" href="#">Không thích</a></li>
                            <li><a class="dropdown-item" href="#">Báo cáo</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Ẩn</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--News-end-->
<!--Login-start-->
<div id="loginBody" class="login-body fixed-top">
    <div class="logo-thecup">
        <img src="/thecup/resources/img/logo-login-register.svg" alt="">
    </div>
    <div class="register-holder">
        <div class="upper">
            <p class="reg-title">Đăng nhập</p>
            <div class="oauth-button">
                <button class="btn btn-primary btn-facebook">
                    <img src="/thecup/resources/img/Button/facebook.svg" alt="">
                    <span>Facebook</span>
                </button>
                <button class="btn btn-outline-success btn-google">
                    <img src="/thecup/resources/img/Button/google.svg" alt="">
                    <span>Google</span>
                </button>
            </div>
            <div class="divider"></div>
            <p class="username">Email hoặc tên đăng nhập</p>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Email hoặc tên đăng nhập"
                       aria-label="Recipient's username with two button addons">
            </div>
            <p class="password">Mật khẩu</p>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Mật khẩu của bạn"
                       aria-label="Recipient's username with two button addons">
            </div>
            <a href="/thecup/template/my_account.html">
                <button class="btn btn-primary btn-reg">Đăng nhập</button>
            </a>
            <a href="">
                <p class="forgot-password">Bạn quên mật khẩu?</p>
            </a>
        </div>
        <div class="lower">
            <div class="login-block">
                <span class="text">Bạn chưa có tài khoản?</span>
                <a href="/thecup/template/register.html">
                    <span class="login">Đăng ký ngay</span>
                </a>
            </div>
        </div>
    </div>
    <div class="exit-button">
        <button class="btn" id="exitLoginFormBtn">
            <div class="border">
        <span class="material-icons material-icons-outlined">
            close
        </span>
            </div>
            <p>Đóng</p>
        </button>
    </div>
</div>
<div id="registerBody" class="register-body fixed-top">
    <div class="logo-thecup">
        <img src="/thecup/resources/img/logo-login-register.svg" alt="">
    </div>
    <div class="register-holder">
        <div class="upper">
            <p class="reg-title">Đăng ký</p>
            <div class="oauth-button">
                <button class="btn btn-primary btn-facebook">
                    <img src="/thecup/resources/img/Button/facebook.svg" alt="">
                    <span>Facebook</span>
                </button>
                <button class="btn btn-outline-success btn-google">
                    <img src="/thecup/resources/img/Button/google.svg" alt="">
                    <span>Google</span>
                </button>
            </div>
            <div class="divider"></div>
            <p class="username">Họ và tên</p>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Họ và tên viết có dấu"
                       aria-label="Recipient's username with two button addons">
            </div>
            <p class="email">Email</p>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="email@gmail.com"
                       aria-label="Recipient's username with two button addons">
            </div>
            <p class="password">Mật khẩu</p>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Mật khẩu của bạn"
                       aria-label="Recipient's username with two button addons">
            </div>
            <button class="btn btn-primary btn-reg">Đăng ký</button>
        </div>
        <div class="lower">
            <div class="login-block">
                <span class="text">Bạn đã có tài khoản?</span>
                <a href="/thecup/template/login.html">
                    <span class="login">Đăng nhập ngay</span>
                </a>
            </div>
        </div>
    </div>
    <div class="exit-button">
        <button class="btn" id="exitRegFormBtn">
            <div class="border">
        <span class="material-icons material-icons-outlined">
            close
        </span>
            </div>
            <p>Đóng</p>
        </button>
    </div>
</div>
<div class="search-popup-body" id="searchPopupBody">
    <div class="search-popup-holder">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Tìm kiếm theo từ khóa, chủ đề, tên bài viết"
                   aria-label="Recipient's username with two button addons">
        </div>
        <button class="btn">
            <a href="/thecup/template/search.html">
                <i class="fas fa-search"></i>
            </a>
        </button>
    </div>
</div>
@include('layouts.footer')
@include('layouts.homeScript')