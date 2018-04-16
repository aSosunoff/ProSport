$.fn.navigation = function() {
    // Cache selectors
    var lastId,
        topMenu = this,
        // All list items
        menuItems = topMenu.find("a"),
        // Anchors corresponding to menu items
        scrollItems = menuItems.map(function() {
            var item = $($(this).attr("href"));
            if (item.length) { return item; }
        }),
        noScrollAction = false;

    $(menuItems[0]).addClass("active");

    // Set to scroll to the top position
    $("html, body").stop().animate({
        scrollTop: 0
    });

    // Bind click handler to menu items
    // so we can get a fancy scroll animation
    menuItems.click(function(e) {
        var href = $(this).attr("href"),
            offsetTop = href === "#" ? 0 : $(href).offset().top;
        noScrollAction = true;
        $("html, body").stop().animate({
            scrollTop: offsetTop
        }, {
            duration: 300,
            complete: function() {
                menuItems
                    .removeClass("active")
                    .filter("[href='" + href +"']").addClass("active");
                setTimeout(function(){ noScrollAction = false; }, 10);
            }
        });
        e.preventDefault();
    });

    // Bind to scroll
    $(window).scroll(function() {
        if (!noScrollAction) {
            // Get container scroll position
            var fromTop = $(this).scrollTop() + topMenu.outerHeight();

            // Get id of current scroll item
            var cur = scrollItems.map(function() {
                if ($(this).offset().top < fromTop) {
                    return this;
                }
            });
            // Get the id of the current element
            cur = cur[cur.length-1];
            var id = cur && cur.length ? cur[0].id : "";

            if (lastId !== id) {
                lastId = id;
                menuItems.removeClass("active").filter("[href='#"+id+"']").addClass("active");
            };
        };
    });
}