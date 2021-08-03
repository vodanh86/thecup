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
                @include('layouts.podcastInfor')
                <div class="play-and-sharing">
                    <div class="row">
                        <div class="col-md-4">
                            <button class="btn btn-primary play-button d-flex align-items-center"
                                    id="playAllBtn">
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
                <div class="podcast" onclick="playById({{$loop->index}})">
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
        </div>
    </div>
</div>
<!--Post-end-->
@include('partials.podcast', ["podcast" => $page, "songs" => $songs])
<!--Podcast-player-end-->
@if($trial)
@include('layouts.restrict')
@endif
@include('layouts.footer')
@include('layouts.script')@include('layouts.script')@include('layouts.script')
<script>
    <?php 
    $sound = array();
    foreach($songs as $song){
        $sound[] = array("name" => $song->title, "link" => env('AWS_URL').$song->link);
    }
    ?>
    soundObj = {
        sound: {!!json_encode($sound)!!}
    };
    loadPlaylist(soundObj);
    generateList();
</script>