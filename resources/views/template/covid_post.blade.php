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
                                <a href="/thecup/template/author.html">
                                    <span class="material-icons material-icons-outlined">
                                    person
                                    </span>
                                    <span>{{$author->name}}</span>
                                </a>
                            </div>
                            <div class="date">
                                <span class="material-icons material-icons-outlined">
                                today
                                </span>
                                <span>{{Util::dateFormat($page->created_at)}}</span>
                            </div>
                            <div class="rating-holder">
                                <span class="text">Đánh giá</span>
                                <span class="material-icons material-icons-outlined">
                  star
                </span>
                                <span class="material-icons material-icons-outlined">
                  star
                </span>
                                <span class="material-icons material-icons-outlined">
                  star
                </span>
                                <span class="material-icons material-icons-outlined">
                  star_half
                </span>
                                <span class="material-icons material-icons-outlined">
                  star_outline
                </span>
                                <span class="quantity">(23)</span>
                            </div>
                        </div>
                    </div>
                    <div class="post-content">
                        <p class="short-description">{!!$page->description!!}</p>
                        <img src="{{url(env('AWS_URL')).$page->image}}" alt="" class="image">
                        <p class="post-text">{!!$page->content!!}</p>
                        <div class="divider"></div>
                        <div class="rating-holder">
                            <div class="text">
                                <span>Đánh giá bài viết</span>
                            </div>
                            <div class="star">
                    <span class="material-icons material-icons-outlined">
                        star
                    </span>
                                <span class="material-icons material-icons-outlined">
                        star
                    </span>
                                <span class="material-icons material-icons-outlined">
                        star
                    </span>
                                <span class="material-icons material-icons-outlined">
                        star_half
                    </span>
                                <span class="material-icons material-icons-outlined">
                        star_outline
                    </span>
                                <p>Bài viết tạm ổn</p>
                            </div>
                            <button class="btn btn-outline-primary send-rating">Gửi đánh giá</button>
                        </div>
                        <div class="divider"></div>
                        <div class="news-ads-banner">
                            <img src="../resources/img/ads-banner/banner-1.png" alt="">
                        </div>
                        <div class="comment">
                            <div class="title">
                                <p>Bình luận</p>
                            </div>
                            <div class="comment-block">
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="user-avatar"></div>
                                    </div>
                                    <div class="col-md-11">
                                        <p class="user-name">tranvanan122</p>
                                        <p class="comment-text">“Bài viết hay, bổ ích mới chỉ áp dụng được một phần thôi
                                            đã thấy
                                            hiệu quả hẳn ra. Nếu áp dụng được hết chắc chắn sẽ thành công”</p>
                                        <p class="comment-date-time">12/05/2021 20:12</p>
                                    </div>
                                </div>
                                <button class="btn btn-outline-secondary dropdown-toggle comment-block-button fas fa-ellipsis-v"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Thích</a></li>
                                    <li><a class="dropdown-item" href="#">Không thích</a></li>
                                    <li><a class="dropdown-item" href="#">Báo cáo</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Ẩn</a></li>
                                </ul>
                            </div>
                            <div class="comment-block">
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="user-avatar"></div>
                                    </div>
                                    <div class="col-md-11">
                                        <p class="user-name">phanvantai123</p>
                                        <p class="comment-text">Đã từng là quản lý và đã thất bại. Thật sự là không hề
                                            dễ. Cảm ơn
                                            tác giá đã có một bài viết rất ý nghĩa và sâu sắc</p>
                                        <p class="comment-date-time">12/05/2021 20:12</p>
                                    </div>
                                </div>
                                <button class="btn btn-outline-secondary dropdown-toggle comment-block-button fas fa-ellipsis-v"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false"></button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#">Thích</a></li>
                                    <li><a class="dropdown-item" href="#">Không thích</a></li>
                                    <li><a class="dropdown-item" href="#">Báo cáo</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Ẩn</a></li>
                                </ul>
                            </div>
                            <div class="post-comment">
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="user-avatar"></div>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here"
                                          id="floatingTextarea"></textarea>
                                            <label for="floatingTextarea">Để lại bình luận của bạn</label>
                                        </div>
                                        <button class="btn btn-primary">Đăng bình luận</button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<!--Economy-end-->
</div>
@include('layouts.footer')
@include('layouts.script')