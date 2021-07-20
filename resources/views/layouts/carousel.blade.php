<?php 
use App\Models\Page;
use App\Admin\Controllers\Util;

$pages = Page::where('status', 1)
        ->where('slide', 1)
        ->get();

?>
<!--Carousel-start-->
<div class="carousel-holder">
    <div class="container-fluid">
        <div class="owl-carousel owl-theme">
            @foreach ($pages as $page)
            <div class="item">
                <a href="{{ url('/page/'.$page->slug) }}">
                    <div class="overlay"></div>
                    <img class="item-img" src='{{url(env("AWS_URL")).$page->image}}' alt="">
                    <div class="item-category">{{Util::getCat($page->category_id)}}</div>
                    <div class="item-divider"></div>
                    <div class="item-title">{{$page->title}}
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="nav-button">
        <button class="btn btn-carousel-prev">
            <span class="material-icons material-icons-outlined align-middle">
                chevron_left
                </span>
        </button>
        <button class="btn btn-carousel-next">
            <span class="material-icons material-icons-outlined align-middle">
                chevron_right
                </span>
        </button>
    </div>
</div>
<!--Carousel-end-->