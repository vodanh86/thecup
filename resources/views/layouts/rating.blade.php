<?php 
$total = 0;
$number = 0;
$avg = 0;
if (!is_null($rating)){
    $total = $rating["total"];
    $number = $rating["number"];
}
if ($number != 0){
    $avg = $total / $number;
}
if ($avg > 5){
    $avg = 5;
}
?>
<div class="rating-holder">
    @if($show == 1)
    <span class="text">Đánh giá</span>
    @endif
    @for ($i =0; $i < 5; $i ++)
        @if ($i < $avg)
            <span class="material-icons material-icons-outlined">
                star
            </span>
        @else 
            <span class="material-icons material-icons-outlined">
                star_outline
            </span>
        @endif
    @endfor
    <span class="quantity">({{$number}})</span>
</div>