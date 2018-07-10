$(document).ready(function() {

	// Start Pagination Ajax
	$(window).on('hashchange', function() {
		if (window.location.hash) {
			var page = window.location.hash.replace('#', '');
			if (page == Number.NaN || page <= 0) {
				return false;
			}else{
				getData(page);
			} 
		}
	});
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
	$(document).ready(function(){
		var food_id = $('#food_id').val();
		getFoodPhotos(undefined,food_id);
		$(document).on('click', '.photos-ajax .pagination a',function(event){
			$('li').removeClass('active');
			$(this).parent('li').addClass('active');
			event.preventDefault();
			var myurl = $(this).attr('href');
			var page=$(this).attr('href').split('page=')[1];
			getFoodPhotos(page,food_id);
		});
	});
	$(document).ready(function(){
		var food_id = $('#food_id').val();
		getFoodComments(undefined,food_id);
		if(food_id){
			getFoodRating(food_id);
		}
		$(document).on('click', '.comments-ajax .pagination a',function(event){
			$('li').removeClass('active');
			$(this).parent('li').addClass('active');
			event.preventDefault();
			var myurl = $(this).attr('href');
			var page=$(this).attr('href').split('page=')[1];
			getFoodComments(page,food_id);
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
	$(document).ready(function(){
		$(document).on('click', '.multiplr-ajax .pagination a',function(event){
			$('li').removeClass('active');
			$(this).parent('li').addClass('active');
			event.preventDefault();
			var myurl = $(this).attr('href');
			var page=$(this).attr('href').split('page=')[1];
			var keyword = $('#multiple_search_keyword').val();
			getDataMultiple(page,keyword);
			$('#choose-media-value').addClass("disabled");
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
		$('#multiple_search_keyword').keyup(function() {
			var keyword = $(this).val();
			delay(function(){
				getDataMultiple(undefined,keyword);
			}, 800 );
		});
	});
	// Paginate Ajax
	function getFoodPhotos(page,food_id){
    	var base_url = window.location.origin;
		$('#food-photos').html("<div class='preload-datatable'><center><img style='width:30px; margin:auto;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></div>");
		if(page==undefined){
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
				type:"GET",
				url: base_url+"/backadmin/get-food-photos/"+food_id,
				data: {
				_token  : CSRF_TOKEN,
			},
			success: function(html){
				$('#food-photos').html(html);
			}
			});
			return false;
		}else{
			$.ajax({
				url: base_url+"/backadmin/get-food-photos/"+food_id+"?page=" + page,
				type: "get",
				datatype: "html",
				data: {
					_token  : CSRF_TOKEN,
				}
			}).done(function(data){
				$("#food-photos").empty().html(data);
				//location.hash = page;
			}).fail(function(jqXHR, ajaxOptions, thrownError){
				alert('No response from server');
			});
		}
	}
	function getFoodComments(page,food_id){
    	var base_url = window.location.origin;
		$('#food-comments').html("<div class='preload-datatable'><center><img style='width:30px; margin:auto;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></div>");
		if(page==undefined){
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
				type:"GET",
				url: base_url+"/backadmin/get-food-comments/"+food_id,
				data: {
				_token  : CSRF_TOKEN,
			},
			success: function(html){
				$('#food-comments').html(html);
			}
			});
			return false;
		}else{
			$.ajax({
				url: base_url+"/backadmin/get-food-comments/"+food_id+"?page=" + page,
				type: "get",
				datatype: "html",
				data: {
					_token  : CSRF_TOKEN,
				}
			}).done(function(data){
				$("#food-comments").empty().html(data);
				//location.hash = page;
			}).fail(function(jqXHR, ajaxOptions, thrownError){
				alert('No response from server');
			});
		}
	}
	function getFoodRating(food_id){
    	var base_url = window.location.origin;
		$('#food-rating').html("<div class='preload-datatable'><center><img style='width:30px; margin:auto;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></div>");
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type:"GET",
			url: base_url+"/backadmin/get-food-rating/"+food_id,
			data: {
			_token  : CSRF_TOKEN,
		},
		success: function(html){
			$('#food-rating').html(html);
		}
		});
		return false;
	}
	function getDataMultiple(page,keyword){
    	var base_url = window.location.origin;
		$('#multiple-imagesList').html("<div class='preload-datatable'><center><img style='width:30px; margin:auto;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></div>");
		if(page==undefined){
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			var type     	= $('#add-multiple-media').data('type');
			$.ajax({
				type:"GET",
				url: base_url+"/backadmin/modal-multiple-media",
				data: {
				_token  : CSRF_TOKEN,
				q 		: keyword,
				type 	: 'image'
			},
			success: function(html){
				$('#multiple-imagesList').html(html);
			}
			});
			return false;
		}else{
			$.ajax({
				url: base_url+"/backadmin/modal-multiple-media?page=" + page,
				type: "get",
				datatype: "html",
				data: {
					_token  : CSRF_TOKEN,
					q 		: keyword,
					type 	: 'image'
				}
			}).done(function(data){
				$("#multiple-imagesList").empty().html(data);
				//location.hash = page;
			}).fail(function(jqXHR, ajaxOptions, thrownError){
				alert('No response from server');
			});
		}
	}
	function getData(page,keyword){
    	var base_url = window.location.origin;
		$('#imagesList').html("<div class='preload-datatable'><center><img style='width:30px; margin:auto;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></div>");
		if(page==undefined){
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			var type     	= $('#choose-media').data('type');
			$.ajax({
				type:"GET",
				url: base_url+"/backadmin/modal-media",
				data: {
				_token  : CSRF_TOKEN,
				q 		: keyword,
				type 	: type
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
	function getEditFoods(id){
    	var base_url = window.location.origin;
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type:"GET",
			url: base_url+"/backadmin/foods/"+id+"/edit",
			data: {
			_token: CSRF_TOKEN,
			id :id
		},
		success: function(html){
			$('#get-data-foods').html(html);
		}
		});
		return false;
	}

	// Submit Action

	$('#add-foods').on('click', function(){
		$('#modal-add-foods').modal('show');
	});
	$('.edit-foods').on('click', function(){
		var base_url = window.location.origin;
		$('#get-data-foods').html("<center><img style='width:60px; margin:auto;' src='"+ base_url+"/back_assets/img/loading_button.gif'></center>");
		var id = $(this).data('id');
		$('#modal-edit-foods').modal('show');
		getEditFoods(id);
	});
	$('.choose-media').on('click', function(){
		$('#modal-choose-media').modal('show');
		getData();
	});
	$('.choose-multiple-media').on('click', function(){
		$('.array_media').html("");
		$('.array_image_media').html("");
		$('.button-save-media').css('display','none');
		$('#modal-choose-multiple-media').modal('show');
		getDataMultiple();
	});

	var progressbar     = $('.progress-bar');
	$(".submit-foods").click(function(){
		$(".submit-foods").prop("disabled", true).css("cursor", 'not-allowed');
		$('#' + 'add_post').html( tinymce.get('add_post').getContent() );
		$(".loading-button").css("display", 'inline-block');
			$("#form-add-foods").ajaxForm(
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
						$(".submit-foods").prop("disabled", false).css("cursor", 'pointer');
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
						$(".submit-foods").prop("disabled", false).css("cursor", 'pointer');
						$(".loading-button").css("display", 'none');
					}
					$('div').animate({ scrollTop: $('.progress').offset().top }, 'slow');
				}
				})
			.submit();
	});
	$('.modal').on("hidden.bs.modal", function (e) {
		if($('.modal:visible').length){
			$('.modal-backdrop').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) - 10);
			$('body').addClass('modal-open');
		}
		}).on("show.bs.modal", function (e) {
		if($('.modal:visible').length){
			$('.modal-backdrop.in').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) + 10);
			$(this).css('z-index', parseInt($('.modal-backdrop.in').first().css('z-index')) + 10);
		}else{
			$('.modal-backdrop.in').first().css('z-index', parseInt($('.modal:visible').last().css('z-index')) - 10);
			$(".modal .modal-dialog").css('z-index', 99999);
		}
	});
});
$(document).on("click", ".button-delete", function() {
	var base_url = window.location.origin;
	var box = $($(this).data("box"));
	var id = $(this).data('id');
	$('#delete-id').val(id);
	$('#delete-foods').attr('action',base_url + '/backadmin/foods/' + id);
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
$(document).on("click", ".delete-photos", function() {
	var base_url = window.location.origin;
	var box = $($(this).data("box"));
	var id = $(this).data('id');
	$('#delete-food-photos-id').val(id);
	$('#delete-foods-photos').attr('action',base_url + '/backadmin/foods-photos-delete/' + id);
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

$(document).on("click", ".delete-comments", function() {
	var base_url = window.location.origin;
	var box = $($(this).data("box"));
	var id = $(this).data('id');
	$('#delete-food-comments-id').val(id);
	$('#delete-foods-comments').attr('action',base_url + '/backadmin/foods-comments-delete/' + id);
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

$(document).ready(function() {
 var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
     plugins: [
      "advlist autolink link image lists charmap preview hr anchor pagebreak spellchecker",
	         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	         "save table contextmenu directionality emoticons template paste textcolor"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
});
// End Select 2 Categories