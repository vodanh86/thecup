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
    $(window).scroll(function () {
        if ($(window).scrollTop() > 550) {
            $(".restrict-layer").addClass("show");
            $(".restrict-layer-text").removeClass("transition");
        }
    });

    // Control carousel prev, next button
    $('.btn-carousel-prev').click(function() {
        $(".carousel-holder .owl-carousel .owl-prev").trigger('click');
    });
    $('.btn-carousel-next').click(function() {
        $(".carousel-holder .owl-carousel .owl-next").trigger('click');
    });

    $(document).on('click', '#purchaseHistory', function() {
        console.log("History Clicked!");
        popupPurchase.style.visibility = 'visible';
        popupPurchase.style.opacity = 1;
    });
    $(document).on('click', '#purchaseHisCloseBtn', function() {
        console.log("History Clicked!");
        popupPurchase.style.visibility = 'hidden';
        popupPurchase.style.opacity = 0;
    });

    //POPUP LOGIN , REGISTER
    $(document).on('click', '#loginBtn', function() {
        loginBody.style.visibility = 'visible';
        loginBody.style.opacity= '1';
        window.scrollTo(0, 0);
        $("body").css("overflow", "hidden");
    });
    $(document).on('click', '#exitLoginFormBtn', function() {
        loginBody.style.visibility = 'hidden';
        loginBody.style.opacity= '0';
        window.scrollTo(0, 0);
        $("body").css("overflow", "auto");
    });
    $(document).on('click', '#registerBtn', function() {
        registerBody.style.visibility = 'visible';
        registerBody.style.opacity= '1';
        window.scrollTo(0, 0);
        $("body").css("overflow", "hidden");
    });

    $(document).on('click', '#forgotPwBtn', function() {
        loginBody.style.visibility = 'hidden';
        loginBody.style.opacity= '0';
        forgotPassBody.style.visibility = 'visible';
        forgotPassBody.style.opacity= '1';
        window.scrollTo(0, 0);
        $("body").css("overflow", "hidden");
    });

    $(document).on('click', '#switchToRegBtn', function() {
        loginBody.style.visibility = 'hidden';
        loginBody.style.opacity= '0';
        registerBody.style.visibility = 'visible';
        registerBody.style.opacity= '1';
    });

    $(document).on('click', '#switchToLoginBtn', function() {
        registerBody.style.visibility = 'hidden';
        registerBody.style.opacity= '0';
        loginBody.style.visibility = 'visible';
        loginBody.style.opacity= '1';
    });

    $(document).on('click', '#exitForgotPwFormBtn', function() {
        forgotPassBody.style.visibility = 'hidden';
        forgotPassBody.style.opacity= '0';
        window.scrollTo(0, 0);
        $("body").css("overflow", "auto");
    });

    $(document).on('click', '#exitRegFormBtn', function() {
        registerBody.style.visibility = 'hidden';
        registerBody.style.opacity= '0';
        window.scrollTo(0, 0);
        $("body").css("overflow", "auto");
    });

    $(document).on('click', '#searchBtn', function() {
        searchPopupBody.style.visibility = 'visible';
        searchPopupBody.style.opacity= '1';
        searchInput.style.display = 'block';
        //homePageBody.style.overflow = "hidden";
        $("body").css("overflow", "hidden");
    });
    $(document).on('click', '#searchPopupBody', function() {
        searchPopupBody.style.visibility = 'hidden';
        searchPopupBody.style.opacity= '0';
        searchInput.style.display = 'none';
        $("body").css("overflow", "visible");
    });

    //Home page playAll button


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
    $('#forgotPassBody').on('touchmove', function(e){
        //prevent native touch activity like scrolling
        e.preventDefault();
    });

    //Post q&a icon changer
    // $(document).on('click', '.collapse-btn', function() {
    //     $('.collapse-btn').addClass('clicked');
    //     console.log($('.clicked').find('span').text().trim());
    //     if ($('.collapse-btn.clicked').find('span').text().trim() == 'add'){
    //         $('.collapse-btn.clicked').find('span').text('remove');
    //         $('.collapse-btn .collapsed').find('span').text('add');
    //     } else {
    //
    //     }
    //
    // });
});


