<div id="forgotPassBody" class="register-body fixed-top">
    <div class="logo-thecup">
        <img src="{{url('resources/img/logo-login-register.svg')}}" alt="">
    </div>
    <div class="register-holder">
        <div class="upper">
            <p class="reg-title">Quên mật khẩu</p>
            <p class="username">Email bạn đã dùng để đăng ký</p>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Email của bạn"
                       aria-label="">
            </div>
            <button class="btn btn-primary btn-reg">Gửi thông tin</button>
            <div class="divider"></div>
            <div class="oauth-button">
                <button class="btn btn-primary btn-facebook">
                    <img src="{{url('resources/img/Button/facebook.svg')}}" alt="">
                    <span>Facebook</span>
                </button>
                <button class="btn btn-outline-success btn-google">
                    <img src="{{url('resources/img/Button/google.svg')}}" alt="">
                    <span>Google</span>
                </button>
            </div>
        </div>
        <div class="lower">
            <div class="login-block">
                <span class="text">Bỏ qua bước này?</span>
                <a href="{{url('')}}">
                    <span class="login">Về trang chủ</span>
                </a>
            </div>
        </div>
    </div>
    <div class="exit-button">
        <button class="btn" id="exitForgotPwFormBtn">
            <div class="border">
        <span class="material-icons material-icons-outlined">
            close
        </span>
            </div>
            <p>Đóng</p>
        </button>
    </div>
</div>