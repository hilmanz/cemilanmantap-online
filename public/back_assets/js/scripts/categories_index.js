$(document).ready(function() {
	$('#add-categories').on('click', function(){
		$('#modal-add-categories').modal('show');
	});
	$('.edit-category').on('click', function(){
		var base_url = window.location.origin;
		$('#get-data-categories').html("<center><img style='width:60px; margin:auto;' src='"+ base_url+ "'/back_assets/img/loading_button.gif'></center>");
		var id = $(this).data('id');
		$('#modal-edit-categories').modal('show');
		getEditCategories(id);
	});
	$('.choose-media').on('click', function(){
		$('#modal-choose-media').modal('show');
		getData();
	});
	function getEditCategories(id){
    var base_url = window.location.origin;
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type:"GET",
			url: base_url+"/backadmin/categories/"+id,
			data: {
			_token: CSRF_TOKEN,
			id :id
		},
		success: function(html){
			$('#get-data-categories').html(html);
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
			$("#form-add-categories").ajaxForm(
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

	// Start select2 Categories
	var base_url = window.location.origin;
	$('.categories-abjad-select').select2({
		placeholder: "Choose Category...",
		ajax: {
			url: base_url+'/backadmin/categories-abjad-select2',
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
				$.each(data, function (index, category_abjad) {
					myResults.push({
						'id': category_abjad.id,
						'text': category_abjad.name
					});
				});
				return {
					results: myResults
				};
			},
			cache: true
		}
	});

});
$(document).on("click", ".button-delete", function() {
var base_url = window.location.origin;
	var box = $($(this).data("box"));
	var id = $(this).data('id');
	$('#delete-id').val(id);
	$('#delete-categories').attr('action',base_url + '/backadmin/categories/' + id);
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