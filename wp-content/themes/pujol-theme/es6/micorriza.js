const $ = jQuery;
import {positionHeader} from './menu-fixed';
import {responsiveMenu} from './responsive-menu';
import {logoScroll} from './logo';
import {smoothScroll, addClassScroll} from './scroll';
import {active} from './menu-active';

$(document).ready(function() {
    // menú fix
    positionHeader();

    //menú responsive
    responsiveMenu();

    //scroll
    smoothScroll();

    active();

    //porcentaje en los que se tienen que mover las imágenes parallax del menú
    // $("#menu_parallax_JS").find(".y-scroll_JS").each(function(img){
    //     var transition  = $(this).attr("data-transition")+'%';
    //     var moves  = $(this).attr("data-time");
    //     timelineMaxParallax.from(this, 1, {y: transition, ease: Back.easeIn.config(1) }, moves)
    // })

    // init controller
    var controller = new ScrollMagic.Controller();

    // create a scene
     $('.menu_parallax_JS').each(function(){

          var timelineMaxParallax = new TimelineMax();

          $(this).find('.y-scroll_JS').each(function() {

               var transition  = $(this).data('transition') + '%';
               var duration  = $(this).data('duration') ? true : 0;
               var position  = $(this).data('time') ? true : 0;

               timelineMaxParallax.from(this, duration, {
                    y: transition,
                    ease: Back.easeIn.config(1)
               }, position)

          });

          var slideParallaxScene = new ScrollMagic.Scene({
               triggerElement: this,
               triggerHook: 1,
               duration: '100%',
          })
          // .setClassToggle(this, 'in-viewport_JS')
          .setTween(timelineMaxParallax)
          .addTo(controller);

     });

});

$(function() {

    $(window).scroll(function() {
        //funcionalidad para hacer más pequeña la fuente en el scroll
        if ($(window).width() > 450) {
            var mass = Math.max(52, 95-0.1*$(this).scrollTop()) + 'px';
        }
        if ($(window).width() <= 450) {
            var mass = Math.max(25, 60-0.1*$(this).scrollTop()) + 'px';
        }

        $('#title_JS').css({
            'font-size': mass,
            'line-height': mass
        });

          //funcionalidad de calcular en donde el logo se tiene que quedar fijo
          logoScroll();

          //funcionalidad para agregar la clase de active a los ítems del menú
          // addClassScroll();

    });


     $(window).load(function(){
          //Para que el logo este en tamaño pequeño cuando el scroll no se encuentra desde el inicio de la página
          logoScroll();
     });

     $(window).resize(function() {
          //Para que la imagen siempre sea full en pantalla aunque se haga resize de pantalla
          $("#height_JS").css("height", "100vh");
          // $("#height_JS").css("height", "calc(100vh - 78px)");


          logoScroll();
     });
});
