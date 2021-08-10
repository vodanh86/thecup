<div id="registerBody" class="register-body fixed-top">
    <div class="logo-thecup">
        <img src="{{url('resources/img/logo-login-register.svg')}}" alt="">
    </div>
    <div class="register-holder">
        <div class="upper">
            <form method="POST" id="registerForm">
                @csrf
                <p class="reg-title">Đăng ký</p>
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
                <div class="divider"></div>
                <p class="username">Họ và tên</p>
                <div class="input-group">
                <input id="nameInput" type="text" class="form-control" name="name" onfocusout="scrollT()"
                value="{{ old('name') }}"  autocomplete="name" autofocus>

                <span class="invalid-feedback" role="alert" id="nameError">
                    <strong></strong>
                </span>
                </div>
                <p class="email">Email</p>
                <div class="input-group">
                <input id="emailInput" type="email" class="form-control" placeholder="email@gmail.com" onfocusout="scrollT()"
                name="email" value="{{ old('email') }}" required autocomplete="email">
                <span class="invalid-feedback" role="alert" id="emailError">
                    <strong></strong>
                </span>
                </div>
                <p class="password">Mật khẩu</p>
                <div class="input-group">
                    <input id="passwordInput" type="password" class="form-control" placeholder="Mật khẩu của bạn" onfocusout="scrollT()"
                    name="password" required autocomplete="new-password">

                    <span class="invalid-feedback" role="alert" id="passwordError">
                        <strong></strong>
                    </span>
                </div>
                <p class="password">Nhập lại mật khẩu</p>
                <div class="input-group">
                    <input id="password-confirm" type="password" class="form-control" placeholder="Mật khẩu của bạn" onfocusout="scrollT()"
                    name="password_confirmation" required autocomplete="new-password">
                </div>
                <button type="submit" class="btn btn-primary btn-reg">
                    Đăng ký
                </button>
            </form>
        </div>
        <div class="lower">
            <div class="login-block">
                <span class="text">Bạn đã có tài khoản?</span>
                <button class="btn btn-switchto-login" id="switchToLoginBtn">
                    <span class="login">Đăng nhập ngay</span>
                </button>
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
@section('scripts')
@parent

<script>
$(function () {
    $('#registerForm').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        $(".invalid-feedback").children("strong").text("");
        $("#registerForm input").removeClass("is-invalid");

        $.ajax({
            method: "POST",
            headers: {
                Accept: "application/json"
            },
            url: "{{ route('register') }}",
            data: formData,
            success: () => window.location.assign("{{ route('home') }}"),
            error: (response) => {
                if(response.status === 422) {
                    let errors = response.responseJSON.errors;

                    Object.keys(errors).forEach(function (key) {
                        $("#" + key + "Input").addClass("is-invalid");
                        $("#" + key + "Error").children("strong").text(errors[key][0]);
                    });
                } else {
                    window.location.reload();
                }

            }
        })
    });
})
</script>
@endsection