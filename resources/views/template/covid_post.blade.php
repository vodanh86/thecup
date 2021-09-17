<?php
use Illuminate\Http\Request;
use App\Models\Category;
use App\Admin\Controllers\Util;

?>
@include('layouts.header')
<body class="post-body">
@include('layouts.nav')
<!--Economy-banner-start-->
<div class="category-banner">
    <div class="text-block">
        <p class="category">Chuyên mục</p>
        <p class="eco">{{$cat->title}}</p>
    </div>
</div>
<!--Economy-banner-end-->
<!--News-start-->
<div class="news-holder">
    <div class="container">
        <div class="row">
            <div class="news-main col-md-8">
                <div class="post-holder">
                    <div class="post-title">
                        <p class="title-name">{{$page->title}}</p>
                        <div class="author-date-rating">
                            <div class="author">
                                <a href="{{url('author/'.$author->slug)}}">
                                    <span class="material-icons material-icons-outlined">
                                    person
                                    </span>
                                    <span>{{$author->title}}</span>
                                </a>
                            </div>
                            <div class="date">
                                <span class="material-icons material-icons-outlined">
                                today
                                </span>
                                <span>{{Util::dateFormat($page->created_at)}}</span>
                            </div>
                            @include('layouts.rating', ["rating" => $rating, "show" => 1])
                        </div>
                    </div>
                    <div class="post-content" style="text-align: justify">
                        <p class="short-description">{!!$page->description!!}</p>
                        <img src="{{url(env('AWS_URL')).$page->image}}" alt="" class="image">
                        @if($trial)
                        @else
                        <p class="post-text">{!!$page->content!!}</p>
                        @endif
                        <div class="divider"></div>
                        <div class="rating-holder">
                            <div class="text">
                                <span>Đánh giá bài viết</span>
                            </div>
                            @include('layouts.start', ["rate" => $rate, "page" => $page])
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
            <div class="news-newest col-md-4">
                @include('layouts.newPages')
                @include('layouts.newPodcasts')
            </div>
        </div>
    </div>
</div>
<!--Economy-end-->
@if($trial)
@include('layouts.restrict')
@endif
@include('layouts.footer')
@include('layouts.script')