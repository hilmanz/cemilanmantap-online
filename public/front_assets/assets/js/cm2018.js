
$(document).ready(function() {
	SetRatingStar();
	'use strict';

	/**
	 * Hero unit animation
	 */
	$('.hero').addClass('hero-animate');

	/**
	 * Cover carousel
	 */


	 $('.hero-carousel').owlCarousel({
	 	autoplay: true,
	 	items: 1,
	 	nav: true,
	 	navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
	 });


	/**
	 * Photos Gallery
	 */

	/**
	 * Image gallery
	 */
	 $('.gallery').owlCarousel({
	 	items: 1,
	 	nav: true,
	 	navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
	 });

	if ($('#listing-position').length) {
		var map = L.map('listing-position', {
			zoom: 12,
			maxZoom: 20,
			center: [40.761077, -73.88]
		});

		var access_token = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw';
		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=' + access_token, {
			scrollWheelZoom: false,
			id: 'mapbox.streets',
			attribution: '<a href="http://www.mapbox.com/about/maps/" target="_blank">Terms &amp; Feedback</a>'
		}).addTo(map);
	}


//  Enable image previews in multi file input --------------------------------------------------------------------------

    if( $("input[type=file].with-preview").length ){
        $("input.file-upload-input").MultiFile({
            list: ".file-upload-previews"
        });
    }

//  Enable image preview in file upload with single image --------------------------------------------------------------

    $(".single-file-preview input[type=file]").change(function() {
        previewImage(this);
    });

	/**
	 * Map Leaflet
	 */
	if ($('#map-leaflet').length) {
		var map = L.map('map-leaflet', {
			zoom: 12,
			maxZoom: 20,
			center: [40.761077, -73.88]
		});

		var access_token = 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpandmbXliNDBjZWd2M2x6bDk3c2ZtOTkifQ._QA7i5Mpkd_m30IGElHziw';
 		var marker_cluster = L.markerClusterGroup();

		map.scrollWheelZoom.disable();

		L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=' + access_token, {
			scrollWheelZoom: false,
			id: 'mapbox.streets',
			attribution: '<a href="http://www.mapbox.com/about/maps/" target="_blank">Terms &amp; Feedback</a>'
		}).addTo(map);

		$.ajax('assets/data/markers.json', {
			success: function(markers) {
				$.each(markers, function(index, value) {
			        var icon = L.divIcon({
			        	html: value.icon,
			            iconSize:     [36, 36],
			            iconAnchor:   [36, 36],
			            popupAnchor:  [-20, -42]
			        });

					var marker = L.marker(value.center, {
						icon: icon
					}).addTo(map);

	                marker.bindPopup(
	                    '<div class="listing-window-image-wrapper">' +
	                        '<a href="properties-detail-standard.html">' +
	                            '<div class="listing-window-image" style="background-image: url(' + value.image + ');"></div>' +
	                            '<div class="listing-window-content">' +
	                                '<div class="info">' +
	                                    '<h2>' + value.title + '</h2>' +
	                                    '<h3>' + value.price + '</h3>' +
	                                '</div>' +
	                            '</div>' +
	                        '</a>' +
	                    '</div>'
	                );

					marker_cluster.addLayer(marker);
				});

				map.addLayer(marker_cluster);
			}
		});
	}


	// Checkbox
	$('input[type=checkbox]').wrap('<div class="checkbox-wrapper"></div>');
	$('input[type=checkbox]').each(function() {
		if (this.checked) {
			$(this).closest('.checkbox-wrapper').addClass('checked');
		}
	});

	$('input[type=checkbox]').change(function() {
		if (this.checked) {
			$(this).closest('.checkbox-wrapper').addClass('checked');
		} else {
			$(this).closest('.checkbox-wrapper').removeClass('checked');
		}
	});

	// Radio
	// $('input[type=radio]').wrap('<div class="radio-wrapper"></div>');
	// $('input[type=radio]').each(function() {
	// 	if ($(this).is(':checked')) {
	// 		$(this).closest('.radio-wrapper').addClass('checked');
	// 	}
	// });

	// $('input[type=radio]').change(function() {
	// 	$('input[type=radio]').each(function() {
	// 		if ($(this).is(':checked')) {
	// 			$(this).closest('.radio-wrapper').addClass('checked');
	// 		} else {
	// 			console.log('b');
	// 			$(this).closest('.radio-wrapper').removeClass('checked');
	// 		}
	// 	});
	// });

});
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

$('.location-city-front').keyup(function() {
    delay(function(){
      $('.location-city-front').show();
      getSuggestionMap();
    }, 1000 );
});

$('.abjad-button').click(function() {
	var url 	=  window.location.origin;
	var abjad 	= $(this).data('name');
	var city 	= $('.city-select').val();
	var redirect = url+'/category/abjad='+abjad+'&city='+city;
	window.location.href = redirect;
});
$('.change-city-index').change(function() {
	var url 	=  window.location.origin;
	var abjad 	= $('.abjad-input').val();
	var city 	= $('.city-select').val();
	var redirect = url+'/category/abjad='+abjad+'&city='+city;
	window.location.href = redirect;
});

$('.change-city-detail').change(function() {
	var url 	=  window.location.origin;
	var abjad 	= $('.abjad-input').val();
	var categories 	= $('.categories-input').val();
	var city 	= $('.city-select').val();
	var redirect = url+'/category/abjad='+abjad+'&city='+city+'/categories='+categories;
	window.location.href = redirect;
});

$(document).on("click",".suggestions ul li",function() {
	var base_url = window.location.origin;
	var place_id 	=	$(this).data('place_id');
	var main_text 	=	$(this).data('main_text');
	var description =	$(this).data('description');
	$('.location-city-front').val(main_text);
	$('.form-locations .place_id').val(place_id);
    $('.suggestions').hide();
    //$('#form-locations').attr('action',base_url+"/search-location/keyword="+main_text+"-"+description);
    //searchCity(place_id,main_text,description);
});
// Preview for single file upload --------------------------------------------------------------------------------------
function getSuggestionMap(){
	var base_url = window.location.origin;
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$('.suggestions').html("<center style='padding:20px;'><img style='width:20px; margin:auto; height:20px;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center>");
	$.ajax({
		type:"GET",
		url: base_url+"/search-google-place/",
		data: {
		_token: CSRF_TOKEN,
		q     :$('.location-city-front').val()
	},
	success: function(html){
		$('.suggestions').html(html);
	}
	});
	return false;
}
// function searchCity(place_id,main_text,description){
// 	var base_url = window.location.origin;
// 	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
// 	$.ajax({
// 		type:"GET",
// 		url: base_url+"/get-search-gm",
// 		data: {
// 		_token: CSRF_TOKEN,
// 		place_id    : place_id,
// 		main_text	: main_text,
// 		description	: description
// 	},
// 	success: function(data){
// 		console.log(data);
// 		window.location.replace(base_url+"/search-location/main_keyword="+main_text+"/desc="+description+"/place_id="+place_id);
// 	}
// 	});
// 	return false;
// } 
function previewImage(input) {
    var ext = $(input).val().split('.').pop().toLowerCase();
    if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
        alert('invalid extension!');
    }
    else {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(input).parents(".single-file-preview").find("img").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
}

var $star_rating = $('.star-rating .fa');
var SetRatingStar = function() {
  return $star_rating.each(function() {
    if (parseInt($star_rating.siblings('input.rating-value').val()) >= parseInt($(this).data('rating'))) {
      return $(this).removeClass('fa-star-o').addClass('fa-star');
    } else {
      return $(this).removeClass('fa-star').addClass('fa-star-o');
    }
  });
};

$star_rating.on('click', function() {
  $star_rating.siblings('input.rating-value').val($(this).data('rating'));
  return SetRatingStar();
});
