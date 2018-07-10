$(document).ready(function($) {
    var base_url = window.location.origin;
    var food_id = $('#get-food-rating').data('id');
    getFoodRating(food_id);
    swiper.appendSlide('<div class="swiper-slide swiper-loader"><img style="width:100%;" src="'+base_url+'/front_assets/loader.gif" alt="loading..."></div>');
    getData(undefined);

	var progressbar     = $('.progress-bar');
	$(".submit-comment").click(function(){
		$(".submit-comment").prop("disabled", true).css("cursor", 'not-allowed');
		$(".loading-button").css("display", 'inline-block');
			$("#form-add-comments").ajaxForm({
				target: '.preview',
				beforeSend: function() {
					$(".progress").css("display","block");
					progressbar.width('0%');
					progressbar.text('0%');
				},
				uploadProgress: function (event, position, total, percentComplete) {
					progressbar.width(percentComplete + '%');
					progressbar.text(percentComplete + '%');
				},
				success: function(data) {
					if(data.status == 'success'){
						$('.pesan').removeClass('alert alert-danger');
						$('.pesan').addClass('alert alert-success');
						$('.pesan').html(data.message);
						$(".submit-comment").prop("disabled", false).css("cursor", 'pointer');
						$(".loading-button").css("display", 'none');
						$(this).closest('form').find("input[type=text], textarea").val("");
						$('#thanks_for_submit').modal('show');
						setTimeout(function(){
	                         location.reload();
	                    }, 5000);
					}else if (data.status == 'failed'){
						$('.pesan').removeClass('alert alert-success');
						$('.pesan').addClass('alert alert-danger');
						$('.pesan').html(data.message);
						$(".submit-comment").prop("disabled", false).css("cursor", 'pointer');
						$(".loading-button").css("display", 'none');
					}else{
						var errorString = '';
						$.each( data.message, function( key, value) {
							errorString += '<li>' + value + '</li>';
						});
						$('.pesan').removeClass('alert alert-success');
						$('.pesan').addClass('alert alert-danger');
						$('.pesan').html(errorString);
						$(".submit-comment").prop("disabled", false).css("cursor", 'pointer');
						$(".loading-button").css("display", 'none');
					}
					$('div').animate({ scrollTop: $('.progress').offset().top }, 'slow');
				}
				})
			.submit();
	});
     window.fbAsyncInit = function() {
        FB.init({
          appId      : '189973868449439',
          status     : true,
          xfbml      : true
        });
      };
      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/all.js";
            fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
        $('#share-facebook').click(function () {
                var product_name   =    'Cemilan Mantap';
                var share_url      =    $('meta[property="og:url"]').attr('content');
                FB.ui({
                  method: 'share',
                  mobile_iframe: true,
                  href: share_url,
                }
            , function(response) {
                if(response &&  !response.error_message){
                    //
                }else{
                    console.log('Terjadi Kesalahan pada saat share');
                }
            }); 
        });

});
$(document).on("click", ".view-comment-food-photos", function() {
    var comment_id = $(this).data('id');
    $('#view-comment-food-photos').modal('show') ;
    getCommentFoodPhotos(comment_id);
    return false;
});
$(document).on("click", ".view-food-photos", function() {
    var food_id = $(this).data('id');
    $('#view-food-photos').modal('show') ;
    getFoodPhotos(food_id);
    return false;
});
function getFoodPhotos(food_id){
    var base_url = window.location.origin;
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#get-food-photos').html('<center><img style="width:200px;" src="'+base_url+'/front_assets/loader.gif" alt="loading..."></center>');
    $.ajax({
        type:"GET",
        url: base_url+"/modal-food-photos/"+food_id,
        data: {
        _token: CSRF_TOKEN,
        id :food_id
    },
    success: function(html){
        $('#get-food-photos').html(html);
    }
    });
    return false;
}
function getCommentFoodPhotos(comment_id){
    var base_url = window.location.origin;
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $('#get-food-photos').html('<center><img style="width:200px;" src="'+base_url+'/front_assets/loader.gif" alt="loading..."></center>');
    $.ajax({
        type:"GET",
        url: base_url+"/modal-comment-food-photos/"+comment_id,
        data: {
        _token: CSRF_TOKEN,
        id :comment_id
    },
    success: function(html){
        $('#get-comment-food-photos').html(html);
    }
    });
    return false;
}
function getData(page){
    var base_url = window.location.origin;
    var CSRF_TOKEN  = $('meta[name="csrf-token"]').attr('content');
    var food_id = $('#get-food-rating').data('id');
    $('#photos-comments .pagination a').removeClass('js-link');
    swiper.appendSlide('<div class="swiper-slide swiper-loader"><img style="width:100%;" src="'+base_url+'/front_assets/loader.gif" alt="loading..."></div>');
    if(page==undefined){
       $.ajax({
            url: base_url+"/photos-comments/"+food_id,
            type: "get",
            datatype: "html",
            data: {
                _token  : CSRF_TOKEN,
            }
        }).done(function(data){
            $( ".swiper-loader" ).remove();
            swiper.appendSlide(data);
            return false;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
        });
    }else{
        $.ajax({
            url: base_url+"/photos-comments/"+food_id+"?page=" + page,
            type: "get",
            datatype: "html",
            data: {
                _token  : CSRF_TOKEN,
            }
        }).done(function(data){
            $( ".swiper-loader" ).remove();
            swiper.appendSlide(data);
            return false;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
        });
    }
}
var swiper = new Swiper('.swiper-container', {
    slidesPerView: 6,
    spaceBetween: 5,
    keyboardControl: false,
    loop: false,
    lazy: false,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    }
});
swiper.on('slideChangeTransitionEnd', function (event) {
  if(swiper.isEnd){
    if($('#photos-comments ul li').hasClass('disabled')){
        return false;
    }else{
        var myurl = $('#photos-comments a.js-link').attr('href');
        var page=myurl.split('page=')[1];
        getData(page);
    }
  }
});
$("#comment-gallery").unitegallery({
    gallery_theme: "tilesgrid",
    grid_num_rows:1,
    gallery_width:"100%",
    gallery_min_width: 100,
    tile_width: 80,
    tile_height: 80,
    theme_bullets_margin_top: 10,
    theme_gallery_padding: 0,
    tile_border_radius:8,
    grid_padding:10,
    grid_space_between_cols: 12,
    tile_enable_border:true,
    tile_border_width:0,
    tile_enable_shadow:false,
    lightbox_slider_image_border: true,
    lightbox_slider_image_border_width: 0,
    lightbox_slider_image_border_radius: 8,
    lightbox_show_textpanel: false,
    lightbox_overlay_opacity:0.8,
});
$('.fancybox-photos-comments').fancybox({
	padding:0,
});
$('.fancybox-photos-food-comments').fancybox({
	padding:0,
});
$('.fancybox-food').fancybox({
	padding:0,
});
$('.fancybox-modal-food-photos').fancybox({
	padding:0,
});

function getFoodRating(food_id){
    var base_url = window.location.origin;
    $('#get-food-rating').html("<div class='preload-datatable'><center><img style='width:30px; margin:auto;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></div>");
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type:"GET",
        url: base_url+"/get-food-rating/"+food_id,
        data: {
        _token  : CSRF_TOKEN,
    },
    success: function(html){
        $('#get-food-rating').html(html);
    }
    });
    return false;
}

