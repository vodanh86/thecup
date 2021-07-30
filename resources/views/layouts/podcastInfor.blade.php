<div class="podcast-infor">
    <span class="infor">{{count($songs)}} phần</span>
    <div class="dot-seperator"></div>
    <?php
        $totalMinutes = 0;
        foreach($songs as $song){
            $totalMinutes += $song->duration;
        }
    ?>
    <span class="infor">{{floor($totalMinutes/60)}} phút</span>
    <div class="dot-seperator"></div>
    <span class="infor">{{count($comments)}} bình luận</span>
    <div class="dot-seperator"></div>
    @include('layouts.rating', ["rating" => $rating, "show" => 0])
</div>