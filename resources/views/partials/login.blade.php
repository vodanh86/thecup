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