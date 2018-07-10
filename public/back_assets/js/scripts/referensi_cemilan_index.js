$(document).ready(function() {
	$('.view-referensi-cemilan').on('click', function(){
		var id = $(this).data('id');
		$('#modal-view-referensi-cemilan').modal('show');
		getViewreferensiCemilan(id);
	});
	function getViewreferensiCemilan(id){
		var base_url = window.location.origin;
		$('#get-data-referensi-cemilan').html("<div class='preload-datatable'><center><img style='width:30px; margin:auto;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></div>");
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type:"GET",
			url: base_url+"/backadmin/referensi-cemilan/"+id,
			data: {
			_token: CSRF_TOKEN,
			id :id
		},
		success: function(html){
			$('#get-data-referensi-cemilan').html(html);
		}
		});
		return false;
	}
});


$(document).on("click", ".button-delete", function() {
var base_url = window.location.origin;
	var box = $($(this).data("box"));
	var id = $(this).data('id');
	$('#delete-id').val(id);
	$('#delete-referensi-cemilan').attr('action',base_url + '/backadmin/referensi-cemilan/' + id);
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