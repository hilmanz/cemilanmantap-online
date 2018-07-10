$(document).on("click", ".button-delete", function() {
var base_url = window.location.origin;
	var box = $($(this).data("box"));
	var id = $(this).data('id');
	$('#delete-id').val(id);
	$('#delete-users').attr('action',base_url + '/backadmin/users/' + id);
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