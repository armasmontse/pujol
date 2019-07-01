const $ = jQuery;

export var smoothScroll = function() {
    $("body").on("click", ".menu-link-home", function(e) {
        e.preventDefault();

        var target = $(this).attr("href");

        $('html, body').stop().animate({
            scrollTop: $(target).offset().top + 15
       }, 500);

        return false;

    });
}

export var addClassScroll = function() {
    var scrollDistance = $(window).scrollTop();
	$('.page-section_JS').each(function(i) {
		if ($(this).position().top <= scrollDistance) {
			$('.navigation_JS a.active').removeClass('active');
			$('.navigation_JS a').eq(i).addClass('active');
		}
	});
}
