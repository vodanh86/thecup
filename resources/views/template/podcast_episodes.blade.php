<?php
use Illuminate\Http\Request;
use App\Models\Category;
use App\Admin\Controllers\Util;

?>
@include('layouts.header')
<body class="podcast-episodes-body">
@include('layouts.nav')
<!--Podcast-holder"-start-->
<div class="podcast-holder">
    <div class="container podcast-player-inner">
        <div class="row">
            <div class="col-md-4">
                <img class="podcast-image" src="{{url(env('AWS_URL')).$page->image}}" alt="">
            </div>
            <div class="col-md-8 podcast-play">
                <p class="category">{{$cat->title}}</p>
                <p class="title">{{$page->title}}</p>
                <div class="podcast-infor">
                    <span class="infor">{{count($songs)}} phần</span>
                    <div class="dot-seperator"></div>
                    <span class="infor">86 phút</span>
                    <div class="dot-seperator"></div>
                    <span class="infor">3 bình luận</span>
                    <div class="dot-seperator"></div>
                    @include('layouts.rating', ["rating" => $rating, "show" => 0])
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
        <div class="search-result">
            <div class="total-post">
                <span>Danh sách podcast</span>
            </div>
            <div class="sorting-post">
                <span>Sắp xếp: </span>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        Theo ngày đăng
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="#">Theo giờ</a></li>
                        <li><a class="dropdown-item" href="#">Theo tháng</a></li>
                        <li><a class="dropdown-item" href="#">Theo năm</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="news-main">
            <div class="news-other-post">
                @foreach($songs as $song)
                <div class="podcast">
                    <a href="{{ url('/episode/'.$song->slug) }}">
                        <div class="row">
                            <div class="col-md-3 podcast-play">
                                <div class="play-icon">
                                    <i class="fas fa-play"></i>
                                </div>
                                <p class="podcast-time">34 phút</p>
                            </div>
                            <div class="col-md-9">
                                <p class="post-date">{{Util::dateFormat($song->created_at)}}</p>
                                <p class="podcast-title">{{$song->title}}</p>
                                <p class="podcast-description">{{$song->description}}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="divider"></div>
            <div class="rating-holder">
                <div class="text">
                    <span>Đánh giá bài viết</span>
                </div>
                @include('layouts.start', ["rate" => $rate, "page" => $page])
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
        <span class="podcast-name">Phần 2: Quẳng gánh lo đi mà sống</span>
    </div>
    <div class="divider"></div>
    <div class="lower">
        <div class="container">
           <div class="row">
               <div class="col-md-4 button-holder">
                   <span class="material-icons smaterial-icons-outlined">playlist_play</span>
                   <span class="material-icons material-icons-outlined">1x_mobiledata</span>
                   <span class="material-icons material-icons-outlined">volume_up</span>
                   <span class="material-icons material-icons-outlined">skip_previous</span>
                   <span class="material-icons material-icons-outlined">replay_10</span>
                   <div class="play-button">
                       <span class="material-icons material-icons-outlined">
                        play_arrow
                        </span>
                   </div>
                   <span class="material-icons material-icons-outlined">forward_10</span>
                   <span class="material-icons material-icons-outlined">skip_next</span>
               </div>
               <div class="col-md-8 progress-holder">
                    <span class="time-played">18:42</span>
                    <div class="progress">
                       <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                   <span class="total-time">34:43</span>
               </div>
           </div>
        </div>
    </div>
</div>
<!--Podcast-player-end-->
@if($trial)
@include('layouts.restrict')
@endif
@include('layouts.footer')
@include('layouts.script')