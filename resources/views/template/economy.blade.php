<?php
use Illuminate\Http\Request;
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
                    <div class="other-post">
                        <div class="row">
                            <div class="col-5">
                                <img src="/thecup/resources/img/other%20post/another-post-1.png" alt="">
                            </div>
                            <div class="col-7">
                                <p class="other-post-category">Sống</p>
                                <p class="other-post-title">Phân tích tác phẩm tiếng thét? Sự thật đằng sau nó còn đáng
                                    giá
                                    hơn rất nhiều</p>
                                <div class="other-post-information">
                                    <span class="other-post-date-info">Ngày 21 tháng 5, 2020</span>
                                    <div class="info-seperator"></div>
                                    <span class="other-post-comment-info">3 bình luận</span>
                                </div>
                                <p class="other-post-description">Giao dịch khối ngoại là điểm trừ khi họ tiếp tục bán
                                    ròng
                                    khá mạnh với giá trị hơn 1.500 tỷ đồng trên toàn thị trường. Lực bán của khối ngoại
                                    tập
                                    trung vào các ...</p>
                            </div>
                        </div>
                    </div>
                    <div class="other-post">
                        <div class="row">
                            <div class="col-5">
                                <img class="post-img" src="/thecup/resources/img/other%20post/another-post-2.png" alt="">
                                <div class="listenable-box">
                                    <img width="32" height="32" class="listenable-icon"
                                         src="/thecup/resources/img/icon/ic_playlist.svg" alt="">
                                </div>
                            </div>
                            <div class="col-7">
                                <p class="other-post-category">Sống</p>
                                <p class="other-post-title">Làm sao để có thể là một nhà lãnh đạo tốt</p>
                                <div class="other-post-information">
                                    <span class="other-post-date-info">Ngày 21 tháng 5, 2020</span>
                                    <div class="info-seperator"></div>
                                    <span class="other-post-comment-info">3 bình luận</span>

                                </div>
                                <p class="other-post-description">Giao dịch khối ngoại là điểm trừ khi họ tiếp tục bán
                                    ròng
                                    khá mạnh với giá trị hơn 1.500 tỷ đồng trên toàn thị trường. Lực bán của khối ngoại
                                    tập
                                    trung vào các ...</p>
                            </div>
                        </div>
                    </div>
                    <div class="other-post">
                        <div class="row">
                            <div class="col-5">
                                <img class="post-img" src="/thecup/resources/img/other%20post/another-post-3.png" alt="">
                                <div class="listenable-box">
                                    <img width="14" height="18" class="listenable-icon play-icon"
                                         src="/thecup/resources/img/icon/ic_play.svg" alt="">
                                </div>
                            </div>
                            <div class="col-7">
                                <p class="other-post-category">Sống</p>
                                <p class="other-post-title">Kinh tế học đại cương tóm tắt và ngắn gọn</p>
                                <div class="other-post-information">
                                    <span class="other-post-date-info">Ngày 21 tháng 5, 2020</span>
                                    <div class="info-seperator"></div>
                                    <span class="other-post-comment-info">3 bình luận</span>
                                    <div class="info-seperator"></div>
                                    <span class="other-post-comment-info">0 audio</span>
                                </div>
                                <p class="other-post-description">Giao dịch khối ngoại là điểm trừ khi họ tiếp tục bán
                                    ròng
                                    khá mạnh với giá trị hơn 1.500 tỷ đồng trên toàn thị trường. Lực bán của khối ngoại
                                    tập
                                    trung vào các ...</p>
                            </div>
                        </div>
                    </div>
                    <div class="other-post">
                        <div class="row">
                            <div class="col-5">
                                <img src="/thecup/resources/img/other%20post/another-post-4.png" alt="">
                            </div>
                            <div class="col-7">
                                <p class="other-post-category">Sống</p>
                                <p class="other-post-title">Phân tích tác phẩm tiếng thét? Sự thật đằng sau nó còn đáng
                                    giá
                                    hơn rất nhiều</p>
                                <div class="other-post-information">
                                    <span class="other-post-date-info">Ngày 21 tháng 5, 2020</span>
                                    <div class="info-seperator"></div>
                                    <span class="other-post-comment-info">3 bình luận</span>
                                </div>
                                <p class="other-post-description">Giao dịch khối ngoại là điểm trừ khi họ tiếp tục bán
                                    ròng
                                    khá mạnh với giá trị hơn 1.500 tỷ đồng trên toàn thị trường. Lực bán của khối ngoại
                                    tập
                                    trung vào các ...</p>
                            </div>
                        </div>
                    </div>
                    <div class="other-post">
                        <div class="row">
                            <div class="col-5">
                                <img src="/thecup/resources/img/other%20post/another-post-5.png" alt="">
                            </div>
                            <div class="col-7">
                                <p class="other-post-category">Sống</p>
                                <p class="other-post-title">Phân tích tác phẩm tiếng thét? Sự thật đằng sau nó còn đáng
                                    giá
                                    hơn rất nhiều</p>
                                <div class="other-post-information">
                                    <span class="other-post-date-info">Ngày 21 tháng 5, 2020</span>
                                    <div class="info-seperator"></div>
                                    <span class="other-post-comment-info">3 bình luận</span>
                                </div>
                                <p class="other-post-description">Giao dịch khối ngoại là điểm trừ khi họ tiếp tục bán
                                    ròng
                                    khá mạnh với giá trị hơn 1.500 tỷ đồng trên toàn thị trường. Lực bán của khối ngoại
                                    tập
                                    trung vào các ...</p>
                            </div>
                        </div>
                    </div>
                    <div class="other-post">
                        <div class="row">
                            <div class="col-5">
                                <img class="post-img" src="/thecup/resources/img/other%20post/another-post-6.png" alt="">
                                <div class="listenable-box">
                                    <img width="32" height="32" class="listenable-icon"
                                         src="/thecup/resources/img/icon/ic_playlist.svg" alt="">
                                </div>
                            </div>
                            <div class="col-7">
                                <p class="other-post-category">Sống</p>
                                <p class="other-post-title">Làm sao để có thể là một nhà lãnh đạo tốt</p>
                                <div class="other-post-information">
                                    <span class="other-post-date-info">Ngày 21 tháng 5, 2020</span>
                                    <div class="info-seperator"></div>
                                    <span class="other-post-comment-info">3 bình luận</span>

                                </div>
                                <p class="other-post-description">Giao dịch khối ngoại là điểm trừ khi họ tiếp tục bán
                                    ròng
                                    khá mạnh với giá trị hơn 1.500 tỷ đồng trên toàn thị trường. Lực bán của khối ngoại
                                    tập
                                    trung vào các ...</p>
                            </div>
                        </div>
                    </div>
                    <div class="other-post">
                        <div class="row">
                            <div class="col-5">
                                <img class="post-img" src="/thecup/resources/img/other%20post/another-post-7.png" alt="">
                                <div class="listenable-box">
                                    <img width="14" height="18" class="listenable-icon play-icon"
                                         src="/thecup/resources/img/icon/ic_play.svg" alt="">
                                </div>
                            </div>
                            <div class="col-7">
                                <p class="other-post-category">Sống</p>
                                <p class="other-post-title">Kinh tế học đại cương tóm tắt và ngắn gọn</p>
                                <div class="other-post-information">
                                    <span class="other-post-date-info">Ngày 21 tháng 5, 2020</span>
                                    <div class="info-seperator"></div>
                                    <span class="other-post-comment-info">3 bình luận</span>
                                    <div class="info-seperator"></div>
                                    <span class="other-post-comment-info">0 audio</span>
                                </div>
                                <p class="other-post-description">Giao dịch khối ngoại là điểm trừ khi họ tiếp tục bán
                                    ròng
                                    khá mạnh với giá trị hơn 1.500 tỷ đồng trên toàn thị trường. Lực bán của khối ngoại
                                    tập
                                    trung vào các ...</p>
                            </div>
                        </div>
                    </div>
                    <div class="other-post">
                        <div class="row">
                            <div class="col-5">
                                <img src="/thecup/resources/img/other%20post/another-post-8.png" alt="">
                            </div>
                            <div class="col-7">
                                <p class="other-post-category">Sống</p>
                                <p class="other-post-title">Phân tích tác phẩm tiếng thét? Sự thật đằng sau nó còn đáng
                                    giá
                                    hơn rất nhiều</p>
                                <div class="other-post-information">
                                    <span class="other-post-date-info">Ngày 21 tháng 5, 2020</span>
                                    <div class="info-seperator"></div>
                                    <span class="other-post-comment-info">3 bình luận</span>
                                </div>
                                <p class="other-post-description">Giao dịch khối ngoại là điểm trừ khi họ tiếp tục bán
                                    ròng
                                    khá mạnh với giá trị hơn 1.500 tỷ đồng trên toàn thị trường. Lực bán của khối ngoại
                                    tập
                                    trung vào các ...</p>
                            </div>
                        </div>
                    </div>
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