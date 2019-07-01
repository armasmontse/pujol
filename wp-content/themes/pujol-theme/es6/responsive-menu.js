const $ = jQuery;

export var responsiveMenu = function() {
    var body = $('body')
	var menu = $('.mobile_JS')
	var button = $('.mobile_btn_JS')
	var toggle = 0

    // if ($(window).width() > 1000) {return}
    // if ($(window).width() <= 1000) {
        // menu.slideUp(0);
     	button.click( function () {
     		if ( toggle === 0 ) {
     			menu.slideDown('fast');
     			toggle++;
     		} else {
     			menu.slideUp('fast');
     			toggle = 0;
     		}
     	});
        menu.click( function () {
     		$(this).slideUp('fast');
     	});
    // }
    if ($(window).width() <= 1000) {
        $(window).resize( function () {
            menu.slideUp(0);
            toggle = 0;
    	})
    }
}
;
