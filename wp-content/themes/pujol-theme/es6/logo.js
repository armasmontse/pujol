const $ = jQuery;

export var logoScroll = function () {

    if ($(window).width() > 450) {
         var altura = $(window).height()*.666 || 0;
        // var altura = $(window).height()*.582 || 0;
    }

    if ($(window).width() <= 450) {
        var altura = $(window).height()*.68 || 0;
    }


    // console.log($(window).scrollTop() , altura )

    if ($(window).scrollTop() >= altura) {
        $('#title_JS').hide();
        $('#title--small_JS').show();
    }else {
        $('#title_JS').show();
        $('#title--small_JS').hide();
    }
}
