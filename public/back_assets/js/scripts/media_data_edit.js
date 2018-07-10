
$(document).ready(function(){
	$('.media_type ').on('change', function(){
		if($(this).val()=='image'){
			$('#edit-filter_video').hide();
			$('#edit-link').val(' ')
		}else{
			$('#edit-filter_video').show();
		}
	});

	// Submit Update

	var progressbar     = $('.progress-bar');
	$(".edit-upload-media").click(function(){
		$(".edit-upload-media").prop("disabled", true).css("cursor", 'not-allowed');
		$(".loading-button").css("display", 'inline-block');
			$("#media-edit-upload").ajaxForm(
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
						$(".edit-upload-media").prop("disabled", false).css("cursor", 'pointer');
						$(".loading-button").css("display", 'none');
						$('#file-image').fileinput('reset');
						getData();
					}else{
						var errorString = '';
						$.each( data.message, function( key, value) {
							errorString += '<li>' + value + '</li>';
							});
							$('#someDivToDisplayErrors').html(errorString);
							$('.mess').removeClass('alert alert-success');
							$('.mess').addClass('alert alert-danger');
						$('.mess').html(errorString);
						$(".edit-upload-media").prop("disabled", false).css("cursor", 'pointer');
						$(".loading-button").css("display", 'none');
					}
					$('div').animate({ scrollTop: $('.progress').offset().top }, 'slow');
				}
				})
			.submit();
	});

	function getData(page,keyword){
    var base_url = window.location.origin;
	$('#imagesList').html("<div class='preload-datatable'><img style='width:30px; margin:auto;' src='"+ base_url+ "'/back_assets/img/loading_button.gif'></div>");
	if(page==undefined){
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type:"GET",
			url: base_url+"/backadmin/media",
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
			url: '?page=' + page,
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
			//location.hash = page;
		}).fail(function(jqXHR, ajaxOptions, thrownError){
			alert('No response from server');
		});
	}
}
});
