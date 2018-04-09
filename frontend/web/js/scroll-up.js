$(function(){
    // Up scroll
    $(".b-scroll-up_backgroung").click(function(){
        $("html, body").stop().animate({
            scrollTop: 0
        }, 800);
    });
});