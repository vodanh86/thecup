<?php
use Illuminate\Http\Request;
use App\Models\Category;
use App\Admin\Controllers\Util;

?>
@extends('layouts.app')
<body class="author-body">
@section('body')
@endsection

@section('content')
<!--Economy-banner-start-->
<div class="category-banner">
    <div class="text-block">
        <p class="category">Chuyên mục</p>
        <p class="eco">tác giả</p>
    </div>
</div>
<!--Economy-banner-end-->
<!--Economy-start-->
<div class="author-holder">
    <div class="container">
        <div class="row">
            <div class="col-md-4 author-info">
                <div class="row">
                    <div class="col-md-4">
                        <div class="rounded-avatar">
                            <img src="{{url(env('AWS_URL')).$author->avatar}}'" alt="">

                        </div>
                    </div>
                    <div class="col-md-8">
                        <p class="author-name">{{$author->title}}</p>
                        <div class="author-birth">
                            <span class="material-icons material-icons-outlined">
                            cake
                            </span>
                            <span>{{Util::dateFormat($author->birth_date)}}</span>
                        </div>
                        <div class="author-nickname">
                            <span class="material-icons material-icons-outlined">
                            account_box
                            </span>
                            <span>{{$author->title}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 author-description">
                <p>{{$author->quote}}</p>
                <div class="comma">“</div>
                <div class="stick"></div>
            </div>
        </div>
        <div class="divider"></div>
    </div>
</div>
<div class="news-holder">
    <div class="container">
        <div class="row">
            <div class="news-main col-md-8">
                <div class="news-other-post">
                    @foreach($pages as $page)
                        <div class="other-post" style="min-height:250px">
                            <div class="row">
                                <div class="col-5">
                                    <a href="{{ url('/page/'.$page->slug) }}">
                                        <img class="post-img" src="{{url(env('AWS_URL')).$page->image}}" alt="">
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
            </div>
        </div>
    </div>
</div>
<!--Economy-end-->
</div>
@endsection