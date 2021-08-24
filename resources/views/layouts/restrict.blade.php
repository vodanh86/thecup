<!--Restrict-->
<div class="restrict-layer">
    <div class="restrict-layer-text fixed-bottom transition">
        <div class="wrapper">
            <p class="text1">Bài viết bị giới hạn</p>
            @guest
            <p class="text2">Vui lòng Đăng nhập hoặc Đăng ký để tiếp tục</p>
            <div class="button-holder">
                <button class="btn btn-primary button-reg" id="registerBtn">Đăng ký</button>
                <span>Hoặc</span>
                <button class="btn btn-primary button-log" id="loginBtn">Đăng nhập</button>
            </div>
            @else
            <p class="text2">Vui lòng nâp cấp gói dịch vụ để đọc bài viết này</p>
            <div class="button-holder">
                <button class="btn btn-primary button-reg">
                    <a href="{{ url('user/profile') }}">Thông tin tài khoản
                    </a>
                </button>
            </div>
            @endguest
        </div>
    </div>
</div>