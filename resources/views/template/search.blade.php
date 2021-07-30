<?php
use Illuminate\Http\Request;
use App\Models\Category;
use App\Admin\Controllers\Util;

?>
@include('layouts.header')
<body class="search-body">
@include('layouts.nav')
<!--Economy-banner-start-->
<div class="category-banner">
  <div class="text-block">
    <p class="category">Chuyên mục</p>
    <p class="eco">Tìm kiếm</p>
  </div>
</div>
<!--Economy-banner-end-->
<!--Economy-start-->
<div class="news-holder">
  <div class="container">
    <div class="search-result">
      <div class="total-post" style="margin-bottom: 15px">
        <span>kết quả tìm kiếm: {{$q}} ({{$pages->total()}} bài viết)</span>
      </div>
    </div>

      <div class="news-main">
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
                                  src="{{url('resources/img/icon/ic_playlist.svg')}}" alt="">
                          </div>
                          @endif
                          @if($page->type == 2)
                          <div class="listenable-box">
                              <img width="14" height="18" class="listenable-icon play-icon"
                                  src="{{url('resources/img/icon/ic_play.svg')}}" alt="">
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
          {{ $pages->appends(['q' => $q])->links() }}
        </div>
      </div>
  </div>
</div>
<!--Economy-end-->
</div>
@include('layouts.footer')
@include('layouts.script')