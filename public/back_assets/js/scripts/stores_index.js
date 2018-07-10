$(document).ready(function() {
	$('#add-stores').on('click', function(){
		$('#modal-add-stores').modal('show');
	});
	$('.edit-stores').on('click', function(){
		var base_url = window.location.origin;
		$('#get-data-stores').html("<center><img style='width:60px; margin:auto;' src='"+ base_url+ "'/back_assets/img/loading_button.gif'></center>");
		var id = $(this).data('id');
		$('#modal-edit-stores').modal('show');
		getEditstores(id);
	});
	$('#add-foods').on('click', function(){
		$('#modal-add-foods').modal('show');
	});
	$('.choose-media').on('click', function(){
		$('#modal-choose-media').modal('show');
		getData();
	});

	$('#modal-add-stores .location-select').on('select2:select', function (e) {
		var data = e.params.data;
		getPlaceDetail(data.place_id)
		// $('#modal-add-stores .lat').val(data.lat);
		// $('#modal-add-stores .lng').val(data.lng);
		// $('#modal-add-stores .place_id').val(data.place_id);
		// $('#modal-add-stores .address').val(data.text);
	});

	function getEditstores(id){
    	var base_url = window.location.origin;
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type:"GET",
			url: base_url+"/backadmin/stores/"+id,
			data: {
			_token: CSRF_TOKEN,
			id :id
		},
		success: function(html){
			$('#get-data-stores').html(html);
		}
		});
		return false;
	}
	function getPlaceDetail(place_id){
    	var base_url = window.location.origin;
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type:"GET",
			url: base_url+"/backadmin/google-map/"+place_id,
			data: {
			_token: CSRF_TOKEN,
		},
		success: function(data){
			$('#modal-add-stores .lat').val(data[0].lat);
			$('#modal-add-stores .lng').val(data[0].lng);
			$('#modal-add-stores .country').val(data[0].long_name);
			$('#modal-add-stores .country_initial').val(data[0].short_name);
			$('#modal-add-stores .url').val(data[0].url);
			$('#modal-add-stores .address').val(data[0].formatted_address);
			$('#modal-add-stores .place_id').val(data[0].place_id);
			$('#modal-add-stores .store_name').val(data[0].name);
			$('#modal-add-stores .phone_number').val(data[0].formatted_phone_number);
		}
		});
		return false;
	}

	// Paginate Ajax
	$(document).ready(function(){
		$(document).on('click', '.ajax .pagination a',function(event){
			$('li').removeClass('active');
			$(this).parent('li').addClass('active');
			event.preventDefault();
			var myurl = $(this).attr('href');
			var page=$(this).attr('href').split('page=')[1];
			var keyword = $('#search_keyword').val();
			getData(page,keyword);
		});
	});
	jQuery(function(){
	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		};
	})();
	$('#search_keyword').keyup(function() {
		var keyword = $(this).val();
		delay(function(){
			getData(undefined,keyword);
		}, 800 );
	});
	});
	// Paginate Ajax
	// Submit Action
	var progressbar     = $('.progress-bar');
	$(".submit").click(function(){
		$(".submit").prop("disabled", true).css("cursor", 'not-allowed');
		$(".loading-button").css("display", 'inline-block');
			$("#form-add-stores").ajaxForm(
				{
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
						$('.mess').removeClass('alert alert-danger');
						$('.mess').addClass('alert alert-success');
						$('.mess').html(data.message);
						$(".submit").prop("disabled", false).css("cursor", 'pointer');
						$(".loading-button").css("display", 'none');
						$(this).closest('form').find("input[type=text], textarea").val("");
						location.reload();
					}else{
						var errorString = '';
						$.each( data.message, function( key, value) {
							errorString += '<li>' + value + '</li>';
						});
						$('.mess').removeClass('alert alert-success');
						$('.mess').addClass('alert alert-danger');
						$('.mess').html(errorString);
						$(".submit").prop("disabled", false).css("cursor", 'pointer');
						$(".loading-button").css("display", 'none');
					}
					$('div').animate({ scrollTop: $('.progress').offset().top }, 'slow');
				}
				})
			.submit();
	});
	function getData(page,keyword){
    var base_url = window.location.origin;
		$('#imagesList').html("<div class='preload-datatable'><center><img style='width:30px; margin:auto;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></div>");
		if(page==undefined){
			var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
			var type     	= $('#choose-media').data('type');
			$.ajax({
				type:"GET",
				url: base_url+"/backadmin/modal-media",
				data: {
				_token  : CSRF_TOKEN,
				q 		: keyword,
				type    : type,
			},
			success: function(html){
				$('#imagesList').html(html);
			}
			});
			return false;
		}else{
			$.ajax({
				url: base_url+"/backadmin/modal-media?page=" + page,
				type: "get",
				datatype: "html",
				data: {
					_token  : CSRF_TOKEN,
					q 		: keyword,
				}
			}).done(function(data){
				/* MESSAGE BOX */
				$(".mb-control").on("click",function(){
					var box = $($(this).data("box"));
					if(box.length > 0){
						box.toggleClass("open");
						var sound = box.data("sound");
						if(sound === 'alert')
							playAudio('alert');
						if(sound === 'fail')
							playAudio('fail');
					}
					return false;
				});
				$(".mb-control-close").on("click",function(){
					$(this).parents(".message-box").removeClass("open");
					return false;
				});
					/* END MESSAGE BOX */
				$("#imagesList").empty().html(data);
				//location.hash = page;
			}).fail(function(jqXHR, ajaxOptions, thrownError){
				alert('No response from server');
			});
		}
	}
});
$(document).on("click", ".button-delete", function() {
var base_url = window.location.origin;
	var box = $($(this).data("box"));
	var id = $(this).data('id');
	$('#delete-id').val(id);
	$('#delete-stores').attr('action',base_url + '/backadmin/stores/' + id);
	if (box.length > 0) {
		box.toggleClass("open");
		var sound = box.data("sound");
	if (sound === 'alert')
		playAudio('alert');
	if (sound === 'fail')
		playAudio('fail');
	}
	return false;
});
// Start select2 Categories
var base_url = window.location.origin;
$('.categories-select').select2({
	placeholder: "Choose Category...",
	ajax: {
		url: base_url+'/backadmin/categories-select2',
		dataType: 'json',
		type: "GET",
		quietMillis: 50,
		allowClear: true,
		data: function (params) {
			return {
				q: $.trim(params.term)
			};
		},
		processResults: function (data) {
			var myResults = [];
			$.each(data, function (index, category) {
				myResults.push({
					'id': category.id,
					'text': category.name
				});
			});
			return {
				results: myResults
			};
		},
		cache: true
	}
});


// Start select2 Stores
var base_url = window.location.origin;
$('.stores-select').select2({
	placeholder: "Choose Stores...",
	ajax: {
		url: base_url+'/backadmin/get-stores-select2',
		dataType: 'json',
		type: "GET",
		quietMillis: 50,
		allowClear: true,
		data: function (params) {
			return {
				q: $.trim(params.term)
			};
		},
		processResults: function (data) {
			var myResults = [];
			$.each(data, function (index, store) {
				myResults.push({
					'id': store.id,
					'text': store.name
				});
			});
			return {
				results: myResults
			};
		},
		cache: true
	}
});
// Start select2 Store Google Map
var base_url = window.location.origin; 
$('.location-select').select2({
	placeholder: "Choose Location...",
	ajax: {
		url: base_url+'/backadmin/stores-select2',
		dataType: 'json',
		type: "GET",
		quietMillis: 500,
		allowClear: true,
		data: function (params) {
			$('.select2-results__message').html('<center><img style="width:50px;" src="'+base_url+'/back_assets/img/cemilanmantap/img/loader-search.gif" alt="Searching..."/></center>');
			return {
				q: $.trim(params.term)
			};
		},
		processResults: function (data) {
			var myResults = [];
			$.each(data, function (index, location) {
				myResults.push({
					'id'				: location.id,
					'text'				: location.main_text+" - "+location.description,
					'place_id' 			: location.place_id,
					'terms' 			: location.terms,
					'description' 		: location.description,
					'main_text'     	: location.main_text,
					'secondary_text'    : location.secondary_text,
				});
			});
			return {
				results: myResults
			};
		},
		cache: true
	}
});
// End Select 2 Store Google Map