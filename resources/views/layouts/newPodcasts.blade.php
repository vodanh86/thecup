<?php 
use App\Models\Podcast;
use App\Models\Category;
use App\Admin\Controllers\Util;

$podcasts = Podcast::where('status', 1)
        ->orderBy("created_at", 'DESC')
        ->limit(5)
        ->get();

?>
<div class="new-podcast-block">
    <p class="newest-block-title">podcast mới</p>
    @foreach($podcasts as $podcast)
    <?php 
    $cat = Category::find($podcast->category_id);
    ?>
    <div class="newest-post">
        <div class="row">
            <div class="col-3">
                <img src="{{url(env('AWS_URL')).$podcast->image}}" width="87" alt="">
            </div>
            <div class="col-9">
                <p class="new-post-title">{{$podcast->title}}</p>
                <p class="new-post-category">{{$cat->title}}</p>
            </div>
        </div>
    </div>
    @endforeach
</div>