<!--Login-start-->
<div id="loginBody" class="login-body fixed-top">
    <div class="logo-thecup">
        <img src="{{url('resources/img/logo-login-register.svg')}}" alt="">
    </div>
    <div class="register-holder">
        <div class="upper">
            <form method="POST" action="{{ route('login') }}">
                        @csrf
                <p class="reg-title">Đăng nhập</p>
                <div class="oauth-button">
                    <a href="{{ url('/auth/redirect/facebook') }}">
                        <div class="btn btn-primary btn-facebook">
                            <img src="{{url('resources/img/Button/facebook.svg')}}" alt="">
                            <span>Facebook</span>
                        </div>
                    </a>
                    <a href="{{ url('/auth/redirect/google') }}">
                        <div class="btn btn-outline-success btn-google">
                            <img src="{{url('resources/img/Button/google.svg')}}" alt="">
                            <span>Google</span>
                        </div>
                    </a>
                </div>
                <div class="divider"></div>
                <p class="username">Email hoặc tên đăng nhập</p>
                <div class="input-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email hoặc tên đăng nhập"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <p class="password">Mật khẩu</p>
                <div class="input-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mật khẩu của bạn"
                    name="password" required autocomplete="current-password">

                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-reg">
                    Đăng nhập
                </button>
                <button class="btn btn-forgot-password" id="forgotPwBtn">
                    <p class="forgot-password">Bạn quên mật khẩu?</p>
                </button>
             </form>
        </div>
        <div class="lower">
            <div class="login-block">
                <span class="text">Bạn chưa có tài khoản?</span>
                <button class="btn btn-switchto-reg" id="switchToRegBtn">
                    <span class="login">Đăng ký ngay</span>
                </button>
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
@section('scripts')
@parent

@if($errors->has('email') || $errors->has('password'))
    <script>
$(function() {
        loginBody.style.visibility = 'visible';
        loginBody.style.opacity= '1';
    });
    </script>
@endif
@endsection