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
                    <?php
                        $totalMinutes = 0;
                        foreach($songs as $song){
                            $totalMinutes += $song->duration;
                        }
                    ?>
                    <span class="infor">{{floor($totalMinutes/60)}} phút</span>
                    <div class="dot-seperator"></div>
                    <span class="infor">{{count($comments)}} bình luận</span>
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
                        @include('layouts.social')
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
                                <p class="podcast-time">{{floor($song->duration/60)}} phút</p>
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
                <a href="{{$banner->link}}">
                    <img src="{{url(env('AWS_URL')).$banner->img}}" alt="{{$banner->name}}">
                </a>
            </div>
            @include('layouts.comment', ["comments" => $comments, "page" => $page])
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