<?php
use App\Admin\Controllers\Util;
use App\Models\Category;
use App\Models\Author;
use App\Models\Song;
use App\Models\Rating;
use App\Models\Comment;

?>
@include('layouts.header')
<body class="homepage-body" id="homePageBody" style="touch-action: auto">
@include('layouts.nav')
@include('layouts.carousel')
<!--Radio-start-->
<div class="radio-holder">
    <div class="radio-title-frame">
        <div class="d-flex">
            <div class="radio-title me-auto">
                <span>Podcast được nghe nhiều</span>
            </div>
            <div class="radio-seemore ms-auto">
                <a href="{{url('')}}">
                    <span>Xem tất cả</span>
                </a>
            </div>
        </div>
    </div>
    <div class="radio-frame container">
        <div class="radio-frame-main">
            <div class="row">
                <div class="col-md-3 radio-img">
                    <img src="/thecup/resources/img/radio-frame.png" alt="">
                </div>
                <div class="col-md-9 radio-controller">
                    <a href="{{ url('/page/'.$podcast->slug) }}">
                        <p class="title">{{$podcast->title}}</p>
                    </a>
                    <?php 
                    $author = Author::where("admin_user_id", $podcast->author_id)->first();
                    ?>
                    <a href="{{url('author/'.$author->slug)}}">
                        <p class="author">{{$author->title}}</p>
                    </a>
                    <div class="button-holder">
                        <?php 
                            $songs = Song::where("podcast_id", $podcast->id)->orderBy("order")->get();
                            $countRating = Rating::where('page_id', $podcast->id)->count();
                            $sumRating = Rating::where('page_id', $podcast->id)->sum("rate");
                            $comments = Comment::where('page_id', $podcast->id)->get();
                            $rating = array("number" => $countRating, "total" => $sumRating)
                        ?>
                        @include('layouts.podcastInfor', ["songs" => $songs, "rating" => $rating, "comments" => $comments])
                        <div class="play-and-sharing">
                            <div class="row">
                                <div class="col-12 col-md-4">
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
        <div class="radio-frame-behind1"></div>
        <div class="radio-frame-behind2"></div>
    </div>
</div>
<!--Radio-end-->
<div class="news-holder">
    <div class="container">
        <div class="row">
            <div class="news-main col-md-8">
                <div class="news-hightlight-article">
                    <div class="hightlight-upper d-flex">
                        <div class="upper-left me-auto">
                            <div class="hightlight-large-block">
                                <a href="{{ url('/page/'.$topPages[0]->slug) }}">
                                    <div class="hightlight-arcticle">
                                        <p>{{$cats[$topPages[0]->category_id]}}</p>
                                        <img src="{{url(env('AWS_URL')).$topPages[0]->image}}" alt="{{$topPages[0]->title}}">
                                    </div>
                                    <p class="article-datetime">{{Util::vnDateFormat($topPages[0]->created_at)}}</p>
                                    <p class="article-title">{{$topPages[0]->title}}</p>
                                </a>
                            </div>
                        </div>
                        <div class="upper-right ms-auto">
                            <div class="hightlight-small-block">
                                <a href="{{ url('/page/'.$topPages[1]->slug) }}">
                                    <div class="hightlight-arcticle">
                                        <p>{{$cats[$topPages[1]->category_id]}}</p>
                                        <img src="{{url(env('AWS_URL')).$topPages[1]->image}}" alt="{{$topPages[1]->title}}">
                                    </div>
                                    <p class="article-datetime">{{Util::vnDateFormat($topPages[1]->created_at)}}</p>
                                    <p class="article-title">{{$topPages[1]->title}}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="hightlight-lower d-flex">
                        <div class="lower-left me-auto">
                            <div class="hightlight-small-block">
                                <a href="{{ url('/page/'.$topPages[2]->slug) }}">
                                    <div class="hightlight-arcticle">
                                        <p>{{$cats[$topPages[2]->category_id]}}</p>
                                        <img src="{{url(env('AWS_URL')).$topPages[2]->image}}" alt="{{$topPages[2]->title}}">
                                    </div>
                                    <p class="article-datetime">{{Util::vnDateFormat($topPages[2]->created_at)}}</p>
                                    <p class="article-title">{{$topPages[2]->title}}</p>
                                </a>
                            </div>
                        </div>
                        <div class="lower-right ms-auto">
                            <div class="hightlight-large-block">
                                <a href="{{ url('/page/'.$topPages[3]->slug) }}">
                                    <div class="hightlight-arcticle">
                                        <p>{{$cats[$topPages[3]->category_id]}}</p>
                                        <img src="{{url(env('AWS_URL')).$topPages[3]->image}}" alt="{{$topPages[3]->title}}">
                                    </div>
                                    <p class="article-datetime">{{Util::vnDateFormat($topPages[3]->created_at)}}</p>
                                    <p class="article-title">{{$topPages[3]->title}}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="news-ads-banner">
                    <a href="{{$banner->link}}">
                        <img src="{{url(env('AWS_URL')).$banner->img}}" alt="{{$banner->name}}">
                    </a>
                </div>
                <div class="news-divider"></div>
                <div class="news-other-post">
                    @foreach($pages as $page)
                    <div class="other-post" style="min-height:250px">
                        <div class="row">
                            <div class="col-5">
                                <a href="{{ url('/page/'.$page->slug) }}">
                                    <img src="{{url(env('AWS_URL')).$page->image}}" alt="">
                                    @if($page->type == 1)
                                    <div class="listenable-box">
                                        <img width="32" height="32" class="listenable-icon"
                                            src="/thecup/resources/img/icon/ic_playlist.svg" alt="">
                                    </div>
                                    @endif
                                    @if($page->type == 2)
                                    <div class="listenable-box">
                                        <img width="14" height="18" class="listenable-icon play-icon"
                                            src="/thecup/resources/img/icon/ic_play.svg" alt="">
                                    </div>
                                    @endif
                                </a>
                            </div>
                            <div class="col-7">
                                <p class="other-post-category">{{Category::find($page->category_id)->title}}</p>
                                <p class="other-post-title"><a href="{{ url('/page/'.$page->slug) }}">{{$page->title}}</a></p>
                                <div class="other-post-information">
                                    <span class="other-post-date-info">{{Util::vnDateFormat($page->published_at)}}</span>
                                    <div class="info-seperator"></div>
                                    <span class="other-post-comment-info">{{array_key_exists($page->id, $countComments) ? $countComments[$page->id] : 0}} bình luận</span>
                                    <div class="info-seperator"></div>
                                    <?php 
                                    $total = array_key_exists($page->id, $sumRatings) ? $sumRatings[$page->id] : 0;
                                    $number = array_key_exists($page->id, $countRatings) ? $countRatings[$page->id] : 0;
                                    ?>
                                    @include('layouts.rating', ["rating" => array("total" => $total, "number" => $number), "show" => 0])
                                </div>
                                <p class="other-post-description"><a href="{{ url('/page/'.$page->slug) }}">{!!$page->description!!}</a></p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="paging-sector">
                    {{ $pages->links() }}
                </div>
            </div>
            <div class="news-newest col-md-4">
                @include('layouts.newPages')
                @include('layouts.newPodcasts')
                @include('layouts.newComments', ["comments" => $comments])
            </div>
        </div>
    </div>
</div>
<!--News-end-->
@include('layouts.footer')
@include('layouts.homeScript')
@yield('scripts')