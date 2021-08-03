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
                <div class="podcast" onclick="playById(0)">
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
@include('layouts.script')@include('layouts.script')@include('layouts.script')<script>
    soundObj = {
        sound: [
            {
                "name": "Anh oi o lai",
                "link": "https://thecup.vn/public/music/3%20%c4%90i%20(%c4%90i.%20%c4%90i.%20%c4%90i)%20-%20K-ICM%20x%20T-ICM%20x%20Kelsey%20x%20Zickky%20-%20ICM%20TEAM%20%5bOFFICIAL%20VIDEO%5d.mp3"
            },
            {
                "name": "Bài hát số 2",
                "link": "https://thecuppodcast.s3.ap-southeast-1.amazonaws.com/files/07fb07f66f04d123460859d7f757fae2.mp3"
            },
            {
                "name": "Hết thương cạn nhớ",
                "link": "https://thecuppodcast.s3.ap-southeast-1.amazonaws.com/files/Hết Thương Cạn Nhớ - Đức Phúc [Audio Lyrics].mp3"
            }
        ]
    };
    loadPlaylist(soundObj);
    generateList();
</script>
