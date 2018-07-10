$(document).ready(function($) {
    var base_url = window.location.origin;
    "use strict";

    // Append .background-image-holder <img>'s as CSS backgrounds
    $('.background-image-holder').each(function() {
        var imgSrc = $(this).children('img').attr('src');
        $(this).css('background', 'url("' + imgSrc + '")');
        $(this).children('img').hide();
        $(this).css('background-position', 'initial');
    });
    $('.infinite-scroll').jscroll({
        autoTrigger: false,
        loadingHtml: '<div class="col-md-12"><div style="width:100px; padding:20px; margin:auto;overflow:hidden;"><img style="width:100%;" src="'+base_url+'/front_assets/loader.gif" alt="loading..."></div></div>',
        padding: 20,
        nextSelector: 'a.js-link',
        contentSelector: 'div.infinite-scroll',
    });
});//document.ready

