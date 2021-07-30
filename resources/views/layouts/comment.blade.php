<?php
use App\Models\User;
use App\Admin\Controllers\Util;

?>
<div class="comment">
    <div class="comment-message">
    </div>
    <div class="title">
        <p>Bình luận mới nhất</p>
    </div>
    @foreach($comments as $comment)
    <div class="comment-block">
        <div class="row">
            <div class="col-md-1">
                <div class="user-avatar">
                    <img src="{{url(env('AWS_URL')).$comment->avatar}}" alt="{{$comment->name}}" width="40px">
                </div>
            </div>
            <div class="col-md-11">
                <p class="user-name">{{$comment->name}}</p>
                <p class="comment-text">“{{$comment->comment}}”</p>
                <p class="comment-date-time">{{Util::dateTimeFormat($comment->created_at)}}</p>
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
    @endforeach
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
                    <textarea class="form-control" placeholder="Leave a comment here" maxlength="1000"
                    id="commentTextarea"></textarea>
                    <label for="commentTextarea">Để lại bình luận của bạn</label>
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
    var formData = {"page_id": {{$page->id}}};
    var comment = $("#commentTextarea").val();
    if (comment.length == 0){
        $(".comment-message").html('    <div class="alert alert-success alert-block">' + 
                                            '<strong id="success-message">Vui lòng để lại bình luận</strong>'+
                                            '<button type="button" class="close" style="float:right" data-dismiss="alert">×</button>	'+
                                        '</div>' );
        return; 
    }
    formData["comment"] = $("#commentTextarea").val();
    $.ajax({
          method: "POST",
          headers: {
              Accept: "application/json"
          },
          url: "{{ url('user/addComment') }}",
          data: formData,
          success: () => {
            $(".comment-message").html('    <div class="alert alert-success alert-block">' + 
                                    '<strong id="success-message">Bình luận của bạn sẽ hiện lên sau 15 phút.</strong>'+
                                    '<button type="button" class="close" style="float:right" data-dismiss="alert">×</button>	'+
                                '</div>' );
            //window.location.assign("{{ route('home') }}")
          },
          error: (response) => {
              if(response.status === 401) {
                  //window.location.reload();
              } else if(response.status === 422) {
                  let errors = response.responseJSON.errors;

                  Object.keys(errors).forEach(function (key) {
                      $("#" + key + "Input").addClass("is-invalid");
                      $("#" + key + "Error").children("strong").text(errors[key][0]);
                  });
              } else {
                  //window.location.reload();
              }

          }
    })
}
</script>
@endif