<div class="col-md-6 sharing">
    <span>Chia sẻ</span>
    <div class="social">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->full())}}&display=popup" target="_blank"><i class="fab fa-facebook-f"></i></a>
    </div>
    <div class="social">
        <a href="https://twitter.com/share?text=&url={{urlencode(url()->full())}}" target="_blank"><i class="fab fa-twitter"></i></a> 
    </div>
    <div class="social">
    <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo urlencode(url()->full()); ?>" target="_blank"><i class="fa fa-pinterest"></i></a>
    </div>
</div>