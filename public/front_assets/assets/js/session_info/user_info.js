$(document).ready(function($) {
	userInfo();
	userInfoMobile();
});
function userInfo(){
	var base_url = window.location.origin;
	$('#user-info').html("<li style='width:100%;height:50px; margin:auto; float:none;'><center><img style='margin:auto; float:none; width:10px;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></li>");
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		type:"GET",
		url: base_url+"/user-info-ajax",
		data: {
		_token: CSRF_TOKEN
		},
	success: function(html){
		$('#user-info').html(html);
	}
	});
	return false;
}
function userInfoMobile(){
	var base_url = window.location.origin;
	$('#user-info-mobile').html("<li style='width:100%;height:50px; margin:auto; float:none;'><center><img style='margin:auto; float:none; width:10px;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></li>");
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		type:"GET",
		url: base_url+"/user-info-mobile-ajax",
		data: {
		_token: CSRF_TOKEN
		},
	success: function(html){
		$('#user-info-mobile').html(html);
	}
	});
	return false;
}
