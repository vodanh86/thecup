<?php
use Illuminate\Http\Request;
use App\Models\Category;
use App\Admin\Controllers\Util;

?>
@include('layouts.header')
<body class="image-post-body">
@include('layouts.nav')
<!--Economy-banner-start-->
<div class="category-banner">
    <div class="text-block">
        <p class="category">Chuyên mục</p>
        <p class="eco">{{$cat->title}}</p>
    </div>
</div>
<!--Economy-banner-end-->
<!--Category-banner-end-->
<div class="row image-post-holder">
  <div class="col-md-3">
    <div class="image-grid-holder">
      <div class="upper">
        @if($author)
        <a href="{{url('author/'.$author->slug)}}">
          <p class="author-name">{{$author->title}}</p>
        </a>
        @endif
        <p class="album-name">{{$page->title}}</p>
        <div class="date-and-rating">
          <p class="date">{{Util::dateFormat($page->created_at)}}</p>
          @include('layouts.start', ["rate" => $rate, "page" => $page])
        </div>
      </div>
      <div class="img-grid">
        <div class="row">
          @foreach($photos as $photo)
          <div class="col-4 col-md-3 img-block">
            <img src="{{$trial ? url('resources/img/grid/grid-gray.png') : url(env('AWS_URL')).$photo->image}}" alt="{{$photo->title}}">
          </div>
          @endforeach
        </div>
      </div>
      @include('layouts.comment', ["comments" => $comments, "page" => $page])
    </div>
  </div>
  <div class="col-md-9 order-first order-md-last">
    <!--Life-Carousel-start-->
    <div id="life-carousel" class="carousel slide carousel-fade life-carousel-holder" data-bs-ride="none">
      <div class="carousel-indicators">
        <@foreach($photos as $photo)
          @if ($loop->first)
            <button type="button" data-bs-target="#life-carousel" data-bs-slide-to="0" class="active"
                  aria-current="true" aria-label="Slide 1"></button>
          @else
            <button type="button" data-bs-target="#life-carousel" data-bs-slide-to="{{$loop->index}}"
                  aria-label="Slide {{$loop->index}}"></button>
          @endif
        @endforeach>
      </div>
      <div class="carousel-inner">
        <@foreach($photos as $photo)
        @if ($loop->first)
          <div class="carousel-item active">
        @else
          <div class="carousel-item">
        @endif
          <img src="{{$trial ? url('resources/img/carousel/life-carousel-big-gray.png') : url(env('AWS_URL')).$photo->image}}" class="d-block" alt="{{$photo->title}}">
          <div class="carousel-caption d-none d-md-block">
            <h5>{{$photo->title}}</h5>
            <p>{{Util::vnDateFormat($page->published_at)}}</p>
          </div>
          <div class="item-pos">
            <p>{{$loop->index + 1}}/{{count($photos)}}</p>
          </div>
          <div class="carousel-gradient-bottom"></div>
        </div>
        @endforeach>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#life-carousel" data-bs-slide="prev">
        <span class="material-icons material-icons-outlined"> chevron_left </span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#life-carousel" data-bs-slide="next">
        <span class="material-icons material-icons-outlined"> chevron_right </span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!--Life-Carousel-end-->
  </div>
</div>
@if($trial)
@include('layouts.restrict')
@endif
@include('layouts.footer')
@include('layouts.script')