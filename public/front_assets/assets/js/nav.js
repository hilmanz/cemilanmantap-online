var mr_firstSectionHeight,
    mr_floatingProjectSections,
    mr_scrollTop = 0;

var _functions = {};

$(document).ready(function() {
    "use strict";

    // Update scroll variable for scrolling functions

    addEventListener('scroll', function() {
        mr_scrollTop = window.pageYOffset;
    }, false);

});



function updateNav() {
    var scrollY = mr_scrollTop;
}

/*================*/
/* GLOBAL.js */
/*================*/

$(function() {

    "use strict";

    /*================*/
    /* VARIABLES */
    /*================*/
    var swipers = [], winW, winH, winScr, _isphone, _istablet, _ismobile = navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i), _isFF = !!navigator.userAgent.match(/firefox/i);

    /*========================*/
    /* page calculations */
    /*========================*/
    _functions.pageCalculations = function(){
        winW = $(window).width();
        winH = $(window).height();
        _isphone = $('.phone-marker').is(':visible') ? true : false;
        _istablet = $('.tablet-marker').is(':visible') ? true : false;
        $('nav').css({'height':winH});
        var fullpageHeight = winH - $('header').not('.type-1').outerHeight() - $('footer').outerHeight();
        $('.full-screen-height').css({'height':(fullpageHeight<500)?500:fullpageHeight});
        $('html').css({'font-size':winW/70});
        $('.rotate').each(function(){
            $(this).width($(this).parent().height());
        });
    };

    _functions.initSelect = function(){
        if(!$('.SlectBox').length) return false;
        $('.SlectBox').SumoSelect({ csvDispCount: 3, search: true, searchText:'Search', noMatch:'No matches for "{0}"', floatWidth: 0 });
    };

    /*=================================*/
    /* function on document ready */
    /*=================================*/
    if(_ismobile) $('body').addClass('mobile');
    _functions.pageCalculations();
    _functions.initSelect();



    /*==============================*/
    /* function on page resize */
    /*==============================*/
    _functions.resizeCall = function(){
        _functions.pageCalculations();
    };
    if(!_ismobile){
        $(window).on('resize', function(){
            _functions.resizeCall();
        });
    } else{
        window.addEventListener("orientationchange", function() {
            _functions.resizeCall();
        }, false);
    }

    /*==============================*/
    /* function on page scroll */
    /*==============================*/
    $(window).on('scroll', function(){
        _functions.scrollCall();
    });

    _functions.scrollCall = function(){
        winScr = $(window).scrollTop();
        if(winScr>70) $('header').addClass('scrolled');
        else $('header').removeClass('scrolled');
    };

    /*==============================*/
    /* buttons, clicks, hovers */
    /*==============================*/


    //hamburger menu
    $('.hamburger-icon').on('click', function(){
        $(this).toggleClass('active');
        $('header').toggleClass('active');
        return false;
    });

    //toggle submenu
    $('.toggle-menu').on('click', function(){
        $(this).toggleClass('active').next().slideToggle();
        return false;
    });
});

function updateFloatingFilters() {
    var l = mr_floatingProjectSections.length;
    while (l--) {
        var section = mr_floatingProjectSections[l];

        if ((section.elemTop < mr_scrollTop) && typeof window.mr_variant == "undefined" ) {
            section.filters.css({
                position: 'fixed',
                top: '16px',
                bottom: 'auto'
            });
            if (mr_navScrolled) {
                section.filters.css({
                    transform: 'translate3d(-50%,48px,0)'
                });
            }
            if (mr_scrollTop > (section.elemBottom - 70)) {
                section.filters.css({
                    position: 'absolute',
                    bottom: '16px',
                    top: 'auto'
                });
                section.filters.css({
                    transform: 'translate3d(-50%,0,0)'
                });
            }
        } else {
            section.filters.css({
                position: 'absolute',
                transform: 'translate3d(-50%,0,0)'
            });
        }
    }
}
