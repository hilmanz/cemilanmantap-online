	$('.choose-media').on('click', function(){
		$('#modal-choose-media').modal('show');
		$('#edit-size-value').val($(this).data('size'));
		getData();
	});


	// Paginate Ajax
	$(document).on('click', '.pagination a',function(event){
		$('li').removeClass('active');
		$(this).parent('li').addClass('active');
		event.preventDefault();
		var myurl = $(this).attr('href');
		var page=$(this).attr('href').split('page=')[1];
		var keyword = $('#search_keyword').val();
		getData(page,keyword);
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

	// Edit Submit Action
	var progressbar     = $('#form-edit-categories-abjad .progress-bar');
	$(".edit-submit").click(function(){
		$(".edit-submit").prop("disabled", true).css("cursor", 'not-allowed');
		$("#form-edit-categories-abjad .loading-button").css("display", 'inline-block');
			$("#form-edit-categories-abjad").ajaxForm(
				{
					target: '#form-edit-categories-abjad .preview',
					beforeSend: function() {
						$("#form-edit-categories-abjad .progress").css("display","block");
						progressbar.width('0%');
						progressbar.text('0%');
		},
				uploadProgress: function (event, position, total, percentComplete) {
				progressbar.width(percentComplete + '%');
				progressbar.text(percentComplete + '%');
				},
				success: function(data) {
					if(data.status == 'success'){
						$('#form-edit-categories-abjad .mess').removeClass('alert alert-danger');
						$('#form-edit-categories-abjad .mess').addClass('alert alert-success');
						$('#form-edit-categories-abjad .mess').html(data.message);
						$(".edit-submit").prop("disabled", false).css("cursor", 'pointer');
						$("#form-edit-categories-abjad .loading-button").css("display", 'none');
						location.reload();
					}else{
						var errorString = '';
						$.each( data.message, function( key, value) {
							errorString += '<li>' + value + '</li>';
						});
						$('#form-edit-categories-abjad .mess').removeClass('alert alert-success');
						$('#form-edit-categories-abjad .mess').addClass('alert alert-danger');
						$('#form-edit-categories-abjad .mess').html(errorString);
						$(".edit-submit").prop("disabled", false).css("cursor", 'pointer');
						$("#form-edit-categories-abjad .loading-button").css("display", 'none');
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
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			var type     	= $('#choose-media').data('type');
			$.ajax({
				type:"GET",
				url: base_url+"/backadmin/modal-media",
				data: {
				_token  : CSRF_TOKEN,
				q 		: keyword,
				type   	: type
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

