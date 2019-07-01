const $ = jQuery;

export var active = function () {

     $(document).on("scroll", onScroll);

    //smoothscroll

    function onScroll(event){
         var scrollPos = $(document).scrollTop();
         $('#header__navbar__JS .menu-link-home').each(function () {
               var currLink = $(this);
               var refElement = $(currLink.attr("href"));

               if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
                    $('#header__navbar__JS ul li .menu-link-home').removeClass("active");
                    currLink.addClass("active");
               }
               else{
                    currLink.removeClass("active");
               }
          });
     }
}
