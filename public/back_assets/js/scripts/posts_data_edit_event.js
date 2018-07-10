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

$('.choose-media').on('click', function(){
		$('#modal-choose-media').modal('show');
		getData();
	});
	// Paginate Ajax
	$(document).on('click', '.pagination a',function(event){
		$('li').removeClass('active');
		$(this).parent('li').addClass('active');
		event.preventDefault();
		var myurl = $(this).attr('href');
		var page=$(this).attr('href').split('page=')[1];
		getData(page);
		$('#delete-value').addClass("disabled");
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
	function getData(page,keyword){
    var base_url = window.location.origin;
		$('#imagesList').html("<div class='preload-datatable'><center><img style='width:30px; margin:auto;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></div>");
		if(page==undefined){
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			$.ajax({
				type:"GET",
				url: base_url+"/backadmin/modal-media",
				data: {
				_token  : CSRF_TOKEN,
						q 		: keyword,
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
				location.hash = page;
			}).fail(function(jqXHR, ajaxOptions, thrownError){
				alert('No response from server');
			});
		}
	}
	// Submit Action
	var progressbar     = $('.progress-bar');
	$(".edit-submit-event").click(function(){
		$(".edit-submit-event").prop("disabled", true).css("cursor", 'not-allowed');
		$(".loading-button").css("display", 'inline-block');
			$("#form-edit-event").ajaxForm(
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
						$(".edit-submit-event").prop("disabled", false).css("cursor", 'pointer');
						$(".loading-button").css("display", 'none');
					}else{
						var errorString = '';
						$.each( data.message, function( key, value) {
							errorString += '<li>' + value + '</li>';
						});
						$('.mess').removeClass('alert alert-success');
						$('.mess').addClass('alert alert-danger');
						$('.mess').html(errorString);
						$(".edit-submit-event").prop("disabled", false).css("cursor", 'pointer');
						$(".loading-button").css("display", 'none');
					}
					$('div').animate({ scrollTop: $('.progress').offset().top }, 'slow');
				}
				})
			.submit();
	});
// End Select 2 Categories