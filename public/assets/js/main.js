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
    // Control carousel prev, next button
    $('.btn-carousel-prev').click(function() {
        $(".carousel-holder .owl-carousel .owl-prev").trigger('click');
    });
    $('.btn-carousel-next').click(function() {
        $(".carousel-holder .owl-carousel .owl-next").trigger('click');
    });

    //Change play button to pause and revert back
    // $('#playBtn').click(function(){
    //     if($(this).find('span').text().trim() == 'play_arrow'){
    //         $(this).find('span').text('pause');
    //         $(this).attr('id','pauseBtn');
    //     } else {
    //         $(this).find('span').text('play_arrow');
    //         $(this).attr('id','playBtn');
    //     }
    // });
    $(document).on('click', '#purchaseHistory', function() {
        console.log("History Clicked!");
        popupPurchase.style.visibility = 'visible';
        //progress.style.width = "50%";
    });

    //POPUP LOGIN , REGISTER
    $(document).on('click', '#loginBtn', function() {
        loginBody.style.visibility = 'visible';
        loginBody.style.opacity= '1';
        //progress.style.width = "50%";
    });
    $(document).on('click', '#exitLoginFormBtn', function() {
        loginBody.style.visibility = 'hidden';
        loginBody.style.opacity= '0';
        //progress.style.width = "50%";
    });
    $(document).on('click', '#registerBtn', function() {
        registerBody.style.visibility = 'visible';
        registerBody.style.opacity= '1';
        //progress.style.width = "50%";
    });
    $(document).on('click', '#exitRegFormBtn', function() {
        registerBody.style.visibility = 'hidden';
        registerBody.style.opacity= '0';
        //progress.style.width = "50%";
    });

    $(document).on('click', '#searchBtn', function() {
        searchPopupBody.style.visibility = 'visible';
        searchPopupBody.style.opacity= '1';
        homePageBody.style.overflow = "hidden";
    });
    $(document).on('click', '#searchPopupBody', function() {
        searchPopupBody.style.visibility = 'hidden';
        searchPopupBody.style.opacity= '0';
        homePageBody.style.overflow = "visible";
    });

    //Disable move gesture on mobile
    $('#loginBody').on('touchmove', function(e){
        //prevent native touch activity like scrolling
        e.preventDefault();
    });
    $('#registerBody').on('touchmove', function(e){
        //prevent native touch activity like scrolling
        e.preventDefault();
    });
    $('#searchPopupBody').on('touchmove', function(e){
        //prevent native touch activity like scrolling
        e.preventDefault();
    });
});



