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
        <p class="author-name">{{$author->name}}</p>
        <p class="album-name">{{$page->title}}</p>
        <div class="date-and-rating">
          <p class="date">{{Util::dateFormat($page->created_at)}}</p>
          <div class="rating-holder">
            <p class="text">Đánh giá</p>
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
                        star
                        </span>
            <span class="material-icons material-icons-outlined">
                        star_half
                        </span>
            <span class="quantity">(23)</span>
          </div>
        </div>
      </div>
      <div class="img-grid">
        <div class="row">
          @foreach($photos as $photo)
          <div class="col-4 col-md-3 img-block">
            <img src="{{url(env('AWS_URL')).$photo->image}}" alt="{{$photo->title}}">
          </div>
          @endforeach
        </div>
      </div>
      <div class="comment">
        <div class="title">
          <p>Bình luận</p>
        </div>
        <div class="comment-block">
          <div class="row">
            <div class="col-md-2">
              <div class="user-avatar"></div>
            </div>
            <div class="col-md-10">
              <p class="user-name">tranvanan122</p>
              <p class="comment-text">“Bài viết hay, bổ ích mới chỉ áp dụng được một phần thôi đã thấy
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
            <div class="col-md-2">
              <div class="user-avatar"></div>
            </div>
            <div class="col-md-10">
              <p class="user-name">phanvantai123</p>
              <p class="comment-text">Đã từng là quản lý và đã thất bại. Thật sự là không hề dễ. Cảm ơn
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
            <div class="col-md-2">
              <div class="user-avatar"></div>
            </div>
            <div class="col-md-10">
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
  <div class="col-md-9">
    <!--Life-Carousel-start-->
    <div id="life-carousel" class="carousel slide carousel-fade life-carousel-holder" data-bs-ride="none">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#life-carousel" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#life-carousel" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#life-carousel" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <@foreach($photos as $photo)
        @if ($loop->first)
          <div class="carousel-item active">
        @else
          <div class="carousel-item">
        @endif
          <img src="{{url(env('AWS_URL')).$photo->image}}" class="d-block" alt="{{$photo->title}}">
          <div class="carousel-caption d-none d-md-block">
            <h5>{{$photo->title}}</h5>
            <p>{{Util::vnDateFormat($page->published_at)}}</p>
          </div>
          <div class="item-pos">
            <p>{{$loop->index + 1}}/3</p>
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
@include('layouts.footer')
@include('layouts.script')