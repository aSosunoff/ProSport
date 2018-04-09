$(function(){
    // Resize height block item
    // $("section.item").css({'min-height' : $(window).height()});
    // $( window ).resize(function() {
    //    var newHeightItems = $(window).height();
    //    $("section.item").css({'min-height' : newHeightItems});
    // });

    // Hide color background top menu
    // if($(window).scrollTop() < $("#top_header").outerHeight()){
    //     $("#top_header")
    //         .css({'background-color': 'transparent'});
    // }
    $(window).scroll(function() {
        if($(this).scrollTop() > $(".js-menu").outerHeight()){
            $(".js-menu")
                .css({'background-color': '#414141'});
        }else{
            $(".js-menu")
                .css({'background-color': 'transparent'});
        }
    });
});