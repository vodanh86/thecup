<?php
use App\Models\Page; ?>

<div class="comment">
    <div class="title">
        <p>Bình luận mới nhất</p>
    </div>
    @foreach($comments as $comment)
        <?php $page = Page::find($comment->page_id) ?>
        @if($page)
            <div class="comment-block">
                <div class="row">
                    <div class="col-md-2">
                        <div class="user-avatar">
                        <img src="{{url(env('AWS_URL')).$comment->avatar}}" alt="{{$comment->name}}" width="40px">
                        </div>
                    </div>
                    <div class="col-md-10">
                        <p class="user-name">{{$comment->name}}</p>
                        <p class="comment-text">“{{$comment->comment}}”</p>
                        <a href="">
                            <p class="post"><a href="{{ url('/page/'.$page->slug) }}">{{$page->title}}</a></p>
                        </a>
                    </div>
                </div>
                <!--button class="btn btn-outline-secondary dropdown-toggle comment-block-button fas fa-ellipsis-v"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Thích</a></li>
                    <li><a class="dropdown-item" href="#">Không thích</a></li>
                    <li><a class="dropdown-item" href="#">Báo cáo</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Ẩn</a></li>
                </ul-->
            </div>
        @endif
    @endforeach
</div>