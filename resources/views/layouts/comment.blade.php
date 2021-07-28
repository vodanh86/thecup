<?php
use App\Models\User; ?>
<div class="comment">
    <div class="title">
        <p>Bình luận mới nhất</p>
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
    @if (\Auth::user())
    <?php $user = User::find(\Auth::user()->id) ?>
    <div class="post-comment">
        <div class="row">
            <div class="col-md-1">
                <div class="user-avatar">
                    <img src="{{url(env('AWS_URL')).$user->avatar}}" alt="{{$user->name}}" width="50px">
                </div>
            </div>
            <div class="col-md-11">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here"
                    id="floatingTextarea"></textarea>
                    <label for="floatingTextarea">Để lại bình luận của bạn</label>
                </div>
                <button class="btn btn-primary" onclick="sendComment()">Đăng bình luận</button>
            </div>
        </div>
    </div>
    @endif
</div>

@if (\Auth::user())
<script>
function sendComment(obj, id, rating) {
	$('#rating-div li').each(function(index) {
		$(this).addClass('selected');
		$('#rating-div #rating').val((index+1));
		if(index == $('#rating-div li').index(obj)) {
			return false;	
		}
	});
	$.ajax({
        url: "addRating",
        data:'page_id='+id+'&rating='+rating,
        type: "POST"
	}).done(function(data) {
        currentStart = data.rating.rate;
    });
}
</script>
@endif