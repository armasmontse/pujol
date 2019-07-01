/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "./js/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ({

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var _menuFixed = __webpack_require__(325);
	
	var _responsiveMenu = __webpack_require__(326);
	
	var _logo = __webpack_require__(327);
	
	var _scroll = __webpack_require__(328);
	
	var _menuActive = __webpack_require__(329);
	
	var $ = jQuery;
	
	
	$(document).ready(function () {
	     // menú fix
	     (0, _menuFixed.positionHeader)();
	
	     //menú responsive
	     (0, _responsiveMenu.responsiveMenu)();
	
	     //scroll
	     (0, _scroll.smoothScroll)();
	
	     (0, _menuActive.active)();
	
	     //porcentaje en los que se tienen que mover las imágenes parallax del menú
	     // $("#menu_parallax_JS").find(".y-scroll_JS").each(function(img){
	     //     var transition  = $(this).attr("data-transition")+'%';
	     //     var moves  = $(this).attr("data-time");
	     //     timelineMaxParallax.from(this, 1, {y: transition, ease: Back.easeIn.config(1) }, moves)
	     // })
	
	     // init controller
	     var controller = new ScrollMagic.Controller();
	
	     // create a scene
	     $('.menu_parallax_JS').each(function () {
	
	          var timelineMaxParallax = new TimelineMax();
	
	          $(this).find('.y-scroll_JS').each(function () {
	
	               var transition = $(this).data('transition') + '%';
	               var duration = $(this).data('duration') ? true : 0;
	               var position = $(this).data('time') ? true : 0;
	
	               timelineMaxParallax.from(this, duration, {
	                    y: transition,
	                    ease: Back.easeIn.config(1)
	               }, position);
	          });
	
	          var slideParallaxScene = new ScrollMagic.Scene({
	               triggerElement: this,
	               triggerHook: 1,
	               duration: '100%'
	          })
	          // .setClassToggle(this, 'in-viewport_JS')
	          .setTween(timelineMaxParallax).addTo(controller);
	     });
	});
	
	$(function () {
	
	     $(window).scroll(function () {
	          //funcionalidad para hacer más pequeña la fuente en el scroll
	          if ($(window).width() > 450) {
	               var mass = Math.max(52, 95 - 0.1 * $(this).scrollTop()) + 'px';
	          }
	          if ($(window).width() <= 450) {
	               var mass = Math.max(25, 60 - 0.1 * $(this).scrollTop()) + 'px';
	          }
	
	          $('#title_JS').css({
	               'font-size': mass,
	               'line-height': mass
	          });
	
	          //funcionalidad de calcular en donde el logo se tiene que quedar fijo
	          (0, _logo.logoScroll)();
	
	          //funcionalidad para agregar la clase de active a los ítems del menú
	          // addClassScroll();
	     });
	
	     $(window).load(function () {
	          //Para que el logo este en tamaño pequeño cuando el scroll no se encuentra desde el inicio de la página
	          (0, _logo.logoScroll)();
	     });
	
	     $(window).resize(function () {
	          //Para que la imagen siempre sea full en pantalla aunque se haga resize de pantalla
	          $("#height_JS").css("height", "100vh");
	          // $("#height_JS").css("height", "calc(100vh - 78px)");
	
	
	          (0, _logo.logoScroll)();
	     });
	});

/***/ }),

/***/ 325:
/***/ (function(module, exports) {

	'use strict';
	
	Object.defineProperty(exports, "__esModule", {
		value: true
	});
	var $ = jQuery;
	
	var positionHeader = exports.positionHeader = function positionHeader() {
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
	};
	
	$(window).scroll(positionHeader);

/***/ }),

/***/ 326:
/***/ (function(module, exports) {

	'use strict';
	
	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	var $ = jQuery;
	
	var responsiveMenu = exports.responsiveMenu = function responsiveMenu() {
	    var body = $('body');
	    var menu = $('.mobile_JS');
	    var button = $('.mobile_btn_JS');
	    var toggle = 0;
	
	    // if ($(window).width() > 1000) {return}
	    // if ($(window).width() <= 1000) {
	    // menu.slideUp(0);
	    button.click(function () {
	        if (toggle === 0) {
	            menu.slideDown('fast');
	            toggle++;
	        } else {
	            menu.slideUp('fast');
	            toggle = 0;
	        }
	    });
	    menu.click(function () {
	        $(this).slideUp('fast');
	    });
	    // }
	    if ($(window).width() <= 1000) {
	        $(window).resize(function () {
	            menu.slideUp(0);
	            toggle = 0;
	        });
	    }
	};

/***/ }),

/***/ 327:
/***/ (function(module, exports) {

	'use strict';
	
	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	var $ = jQuery;
	
	var logoScroll = exports.logoScroll = function logoScroll() {
	
	    if ($(window).width() > 450) {
	        var altura = $(window).height() * .666 || 0;
	        // var altura = $(window).height()*.582 || 0;
	    }
	
	    if ($(window).width() <= 450) {
	        var altura = $(window).height() * .68 || 0;
	    }
	
	    // console.log($(window).scrollTop() , altura )
	
	    if ($(window).scrollTop() >= altura) {
	        $('#title_JS').hide();
	        $('#title--small_JS').show();
	    } else {
	        $('#title_JS').show();
	        $('#title--small_JS').hide();
	    }
	};

/***/ }),

/***/ 328:
/***/ (function(module, exports) {

	"use strict";
	
	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	var $ = jQuery;
	
	var smoothScroll = exports.smoothScroll = function smoothScroll() {
	    $("body").on("click", ".menu-link-home", function (e) {
	        e.preventDefault();
	
	        var target = $(this).attr("href");
	
	        $('html, body').stop().animate({
	            scrollTop: $(target).offset().top + 15
	        }, 500);
	
	        return false;
	    });
	};
	
	var addClassScroll = exports.addClassScroll = function addClassScroll() {
	    var scrollDistance = $(window).scrollTop();
	    $('.page-section_JS').each(function (i) {
	        if ($(this).position().top <= scrollDistance) {
	            $('.navigation_JS a.active').removeClass('active');
	            $('.navigation_JS a').eq(i).addClass('active');
	        }
	    });
	};

/***/ }),

/***/ 329:
/***/ (function(module, exports) {

	"use strict";
	
	Object.defineProperty(exports, "__esModule", {
	     value: true
	});
	var $ = jQuery;
	
	var active = exports.active = function active() {
	
	     $(document).on("scroll", onScroll);
	
	     //smoothscroll
	
	     function onScroll(event) {
	          var scrollPos = $(document).scrollTop();
	          $('#header__navbar__JS .menu-link-home').each(function () {
	               var currLink = $(this);
	               var refElement = $(currLink.attr("href"));
	
	               if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
	                    $('#header__navbar__JS ul li .menu-link-home').removeClass("active");
	                    currLink.addClass("active");
	               } else {
	                    currLink.removeClass("active");
	               }
	          });
	     }
	};

/***/ })

/******/ });
//# sourceMappingURL=functions.js.map