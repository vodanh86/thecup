$(document).ready(function(){
    $('.owl-carousel').owlCarousel({
        loop:false,
        margin:30,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            1024:{
                items:3
            },
            1366:{
                items:3
            },
            1600:{
                items:4
            }
        }
    })
    $('.btn-carousel-prev').click(function() {
        $(".carousel-holder .owl-carousel .owl-prev").trigger('click');
    });
    $('.btn-carousel-next').click(function() {
        $(".carousel-holder .owl-carousel .owl-next").trigger('click');
    });
});