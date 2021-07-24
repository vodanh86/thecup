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