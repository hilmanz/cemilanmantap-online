$(document).ready(function() {
		// Submit Action
		var progressbar     = $('.progress-bar');
		$(".submit").click(function(){
			$(".submit").prop("disabled", true).css("cursor", 'not-allowed');
			$(".loading-button").css("display", 'inline-block');
				$("#form-add-roles").ajaxForm(
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
	});