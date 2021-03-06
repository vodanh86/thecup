<?php
use Mews\Captcha\Facades\Captcha;
?>
<div id="forgotPassBody" class="register-body fixed-top">
    <div class="logo-thecup">
        <img src="{{url('resources/img/logo-login-register.svg')}}" alt="">
    </div>
    <div class="register-holder">
        <div class="upper">
            <form method="post" action="captcha-test" id="forgetForm">
                <div id="forgot-message"></div>
                <p class="reg-title">Quên mật khẩu</p>
                <p class="username">Email bạn đã dùng để đăng ký</p>
                <div class="input-group">
                    <input type="email" class="form-control" placeholder="Email của bạn" required name="email"
                        aria-label="" onfocusout="scrollT()">
                </div>
                <div class="input-group" id="forgot-captcha">
                    {!! Captcha::img(); !!}
                </div>
                <div class="input-group">
                    <input type="text" class="form-control" name="captcha" required placeholder="captcha"  id="captcha">
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
            </form>
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
@section('scripts')
@parent

<script>
$(function () {
    $('#forgetForm').submit(function (e) {
        e.preventDefault();
        let formData = $(this).serializeArray();
        $(".invalid-feedback").children("strong").text("");
        $("#registerForm input").removeClass("is-invalid");

        $.ajax({
            method: "POST",
            headers: {
                Accept: "application/json"
            },
            url: "{{ url('user/forgot') }}",
            data: formData,
            success: (data) => {
                $("#forgot-captcha").html(data.data);
                $("#captcha").val('');
                $("#forgot-message").html('    <div class="alert ' + (data.status == 1 ? 'alert-success' : 'alert-danger') + ' alert-block">' + 
                                    '<strong id="success-message">' + data.message + '</strong>'+
                                    '<button type="button" class="close" style="float:right" data-dismiss="alert">×</button>	'+
                                '</div>' );
            },
            error: (response) => {
                if(response.status === 422) {
                    let errors = response.responseJSON.errors;

                    Object.keys(errors).forEach(function (key) {
                        $("#" + key + "Input").addClass("is-invalid");
                        $("#" + key + "Error").children("strong").text(errors[key][0]);
                    });
                } 

            }
        })
    });
})
</script>
@endsection