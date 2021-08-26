<?php 
use App\Models\Page;
use App\Models\Category;
use App\Admin\Controllers\Util;

$pages = Page::where('status', 1)
        ->where('type', 2)
        ->orderBy("created_at", 'DESC')
        ->limit(5)
        ->get();

?>
<div class="new-podcast-block">
    <p class="newest-block-title">podcast mới</p>
    @foreach($pages as $page)
    <?php 
    $cat = Category::find($page->category_id);
    ?>
    <div class="newest-post">
        <div class="row">
            <div class="col-3">
                <a href="{{ url('/page/'.$page->slug) }}">
                    <img src="{{url(env('AWS_URL')).$page->image}}" width="87" alt="">
                </a>
            </div>
            <div class="col-9">
                <a href="{{ url('/page/'.$page->slug) }}">
                    <p class="new-post-title">{{$page->title}}</p>
                </a>
                <p class="new-post-category">
                    <a class="dropdown-item" href="{{ url('/category/'.$cat->slug) }}" style="padding: 0">{{$cat->title}}</a>
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>