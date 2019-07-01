const $ = jQuery;

export var positionHeader = function() {
	var altura = $('#height_JS').height();

		if ($(window).scrollTop() >= altura) {
			// $('#header-fixed_JS').slideDown('fast');

			$('#header-fixed_JS').addClass('fixed');

			$('body').css({
				paddingTop: '0px'
			});
			$('#us').addClass('paddingTop');

		} else {
			// $('#header-fixed_JS').slideUp('fast');
			$('#header-fixed_JS').removeClass('fixed');

			$('body').css({
				paddingTop: '0px'
			});
			$('#us').removeClass('paddingTop');
		}
}

$(window).scroll(positionHeader);
