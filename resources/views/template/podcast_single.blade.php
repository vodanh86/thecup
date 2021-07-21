<?php
use Illuminate\Http\Request;
use App\Models\Category;
use App\Admin\Controllers\Util;

?>
@include('layouts.header')
<body class="podcast-single-body">
@include('layouts.nav')
<!--Podcast-holder"-start-->
<div class="podcast-holder">
    <div class="container podcast-player-inner">
        <div class="row">
            <div class="col-md-4 podcast-image"></div>
            <div class="col-md-8 podcast-play">
                <p class="category">{{$cat->title}}</p>
                <p class="title">{{$song->title}}</p>
                <div class="podcast-infor">
                    <span class="infor">8 phần</span>
                    <div class="dot-seperator"></div>
                    <span class="infor">86 phút</span>
                    <div class="dot-seperator"></div>
                    <span class="infor">3 bình luận</span>
                    <div class="dot-seperator"></div>
                    <div class="rating-holder">
            <span class="material-icons material-icons-outlined">
            star
            </span>
                        <span class="material-icons material-icons-outlined">
            star
            </span>
                        <span class="material-icons material-icons-outlined">
            star
            </span>
                        <span class="material-icons material-icons-outlined">
            star
            </span>
                        <span class="material-icons material-icons-outlined">
            star_half
            </span>
                        <span class="quantity">(23)</span>
                    </div>
                </div>
                <div class="play-and-sharing">
                    <div class="row">
                        <div class="col-md-4">
                            <button class="btn btn-primary play-button d-flex align-items-center">
                                <i class="fas fa-play"></i>
                                <span class="ms-auto">Nghe tất cả</span>
                            </button>
                        </div>
                        <div class="col-md-6 sharing">
                            <span>Chia sẻ</span>
                            <div class="social">
                                <i class="fab fa-facebook-f"></i>
                            </div>
                            <div class="social">
                                <i class="fab fa-twitter"></i>
                            </div>
                            <div class="social">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <div class="social">
                                <i class="fab fa-youtube"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Podcast-holder"-end-->
<!--Post-start-->
<div class="news-holder">
    <div class="container">
        <div class="news-main">
            <div class="podcast-caption">
                <p>{!!$song->description!!}</p>
            </div>
            <div class="divider"></div>
            <div class="rating-holder">
                <div class="text">
                    <span>Đánh giá Podcast</span>
                </div>
                <div class="star">
                    <span class="material-icons material-icons-outlined">
                        star
                    </span>
                    <span class="material-icons material-icons-outlined">
                        star
                    </span>
                    <span class="material-icons material-icons-outlined">
                        star
                    </span>
                    <span class="material-icons material-icons-outlined">
                        star_half
                    </span>
                    <span class="material-icons material-icons-outlined">
                        star_outline
                    </span>
                    <p>Bài viết tạm ổn</p>
                </div>
                <button class="btn btn-outline-primary send-rating">Gửi đánh giá</button>
            </div>
            <div class="divider"></div>
            <div class="news-ads-banner">
                <img src="../resources/img/ads-banner/banner-1.png" alt="">
            </div>
            <div class="comment">
                <div class="title">
                    <p>Bình luận</p>
                </div>
                <div class="comment-block">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="user-avatar"></div>
                        </div>
                        <div class="col-md-11">
                            <p class="user-name">tranvanan122</p>
                            <p class="comment-text">“Bài viết hay, bổ ích mới chỉ áp dụng được một phần thôi đã thấy
                                hiệu quả hẳn ra. Nếu áp dụng được hết chắc chắn sẽ thành công”</p>
                            <p class="comment-date-time">12/05/2021 20:12</p>
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
                        <div class="col-md-1">
                            <div class="user-avatar"></div>
                        </div>
                        <div class="col-md-11">
                            <p class="user-name">phanvantai123</p>
                            <p class="comment-text">Đã từng là quản lý và đã thất bại. Thật sự là không hề dễ. Cảm ơn
                                tác giá đã có một bài viết rất ý nghĩa và sâu sắc</p>
                            <p class="comment-date-time">12/05/2021 20:12</p>
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
                <div class="post-comment">
                    <div class="row">
                        <div class="col-md-1">
                            <div class="user-avatar"></div>
                        </div>
                        <div class="col-md-11">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here"
                                          id="floatingTextarea"></textarea>
                                <label for="floatingTextarea">Để lại bình luận của bạn</label>
                            </div>
                            <button class="btn btn-primary">Đăng bình luận</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Post-end-->
<!--Podcast-player-start-->
<div class="podcast-player-holder">
    <div class="upper">
        <span class="podcast-title">Hài lòng với nhưng thứ đã có sẽ làm bạn hạnh phúc hơn</span>
        <div class="dot-seperator"></div>
        <span class="podcast-name" id="track">Phần 2: Quẳng gánh lo đi mà sống</span>
    </div>
    <div class="divider"></div>
    <div class="lower">
        <div class="container">
            <div class="row">
                <div class="col-md-6 button-holder">
                    <span class="material-icons smaterial-icons-outlined">playlist_play</span>
                    <span class="play-speed">1X</span>
                    <div class="volume-holder">
                        <span class="material-icons material-icons-outlined">volume_up</span>
                        <div class="progress" id="volumeProgressWrapper">
                            <div id="volProgress" class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="25"
                                 aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <button class="btn" id="prevBtn">
                        <span class="material-icons material-icons-outlined">skip_previous</span>
                    </button>
                    <button id="replay10s" class="btn">
                        <span class="material-icons material-icons-outlined">replay_10</span>
                    </button>
                    <button class="play-button" id="playBtn">
                       <span class="material-icons material-icons-outlined">
                        play_arrow
                        </span>
                    </button>
                    <button id="forward10s" class="btn">
                        <span class="material-icons material-icons-outlined">forward_10</span>
                    </button>
                    <button class="btn" id="nextBtn">
                        <span class="material-icons material-icons-outlined">skip_next</span>
                    </button>
                </div>
                <div class="col-md-6 progress-holder">
                    <span id="timer" class="time-played">0:00</span>
                    <div class="progress" id="durationProgressWrapper">
                        <div id="progress" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span id="duration" class="total-time">0:00</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Podcast-player-end-->
@include('layouts.footer')
@include('layouts.script')