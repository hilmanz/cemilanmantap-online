$(document).ready(function() {
	SetRatingStar();
	$('#add-comments').on('click', function(){
		$('#modal-add-comments').modal('show');
	});
	$('.view-comments').on('click', function(){
		var base_url = window.location.origin;
		$('#get-data-comments').html("<center><img style='width:60px; margin:auto;' src='"+ base_url+ "'/back_assets/img/loading_button.gif'></center>");
		var id = $(this).data('id');
		$('#modal-view-comments').modal('show');
		getViewcomments(id);
	});
	$('.choose-media').on('click', function(){
		$('#modal-choose-media').modal('show');
		getData();
	});
	function getViewcomments(id){
		var base_url = window.location.origin;
		$('#get-data-comments').html("<div class='preload-datatable'><center><img style='width:30px; margin:auto;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></div>");
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type:"GET",
			url: base_url+"/backadmin/comments/"+id,
			data: {
			_token: CSRF_TOKEN,
			id :id
		},
		success: function(html){
			$('#get-data-comments').html(html);
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
			$("#form-add-comments").ajaxForm(
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
					}else if (data.status == 'failed'){
						$('.mess').removeClass('alert alert-success');
						$('.mess').addClass('alert alert-danger');
						$('.mess').html(data.message);
						$(".submit").prop("disabled", false).css("cursor", 'pointer');
						$(".loading-button").css("display", 'none');
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
				type 	: type,
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


// Start select2 Categories
var base_url = window.location.origin;
$('.food-select').select2({
	placeholder: "Choose Foods...",
	ajax: {
		url: base_url+'/backadmin/foods-select2',
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
			$.each(data, function (index, food) {
				myResults.push({
					'id': food.id,
					'text': food.title
				});
			});
			return {
				results: myResults
			};
		},
		cache: true
	}
});

$(function(){
	$("#file-image").fileinput({
		showUpload: false,
		showCaption: false,
		browseClass: "btn btn-danger",
		fileType: "any"
	});
});


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

$(document).on("click", ".change-status", function() {
var base_url = window.location.origin;
	var box = $($(this).data("box"));
	var id = $(this).data('id');
	$('#comment-id').val(id);
	$('#comment-status').val($(this).data('status'));
	$('#status-comments').attr('action',base_url + '/backadmin/comments-status/');
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

$(document).on("click", ".button-delete", function() {
var base_url = window.location.origin;
	var box = $($(this).data("box"));
	var id = $(this).data('id');
	$('#delete-id').val(id);
	$('#delete-comments').attr('action',base_url + '/backadmin/comments/' + id);
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