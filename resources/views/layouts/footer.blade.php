<?php 
use App\Models\Category;

$cats = Category::where('show', 1)
        ->orderBy('order')
        ->get()
        ->groupBy('parent_id');

$parentId = $cats[0][0]->id;
?>
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
</div>
<div class="search-popup-holder" id="searchInput">
    <form action="{{url('site/search')}}">
    <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Tìm kiếm theo từ khóa, chủ đề, tên bài viết"
               aria-label="">
    </div>
    <button class="btn" type="submit">
        <i class="fas fa-search"></i>
    </button>
    </form>
</div>
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
