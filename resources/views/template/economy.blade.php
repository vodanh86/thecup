<?php
use Illuminate\Http\Request;
use App\Models\Category;
use App\Admin\Controllers\Util;

?>
@include('layouts.header')
<body class="economy-body">
@include('layouts.nav')
<!--Economy-banner-start-->
<div class="category-banner">
    <div class="text-block">
        <p class="category">Chuyên mục</p>
        <p class="eco">{{$cat->title}}</p>
    </div>
</div>
<!--Economy-banner-end-->
<!--Economy-start-->
<div class="news-holder">
    <div class="container">
        <div class="sorting-post">
            <span>Sắp xếp: </span>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{\Request::url().'?sort=time'}}">Theo ngày đăng</a></li>
                    <li><a class="dropdown-item" href="{{\Request::url().'?sort=author'}}">Theo tác giả</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="news-main col-md-8">
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
                                    <span class="other-post-comment-info">3 bình luận</span>
                                </div>
                                <p class="other-post-description"><a href="{{ url('/page/'.$page->slug) }}">{!!$page->description!!}</a></p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="paging-sector">
                    @if(isset($sort))
                    {{ $pages->appends(['sort' => $sort])->links() }}
                    @else
                    {{ $pages->links() }}
                    @endif
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
@include('layouts.footer')
@include('layouts.script')