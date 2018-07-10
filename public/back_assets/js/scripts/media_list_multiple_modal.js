
$("#media-multiple-toggle-items").on("click",function(){
	$(".gallery-item").each(function(){
		var wr = $(this).find(".iCheck-helper").parent("div");
		if(wr.hasClass("checked")){
			$(this).removeClass("active");
			$('#choose-media-value').addClass("disabled");
			wr.removeClass("checked");
			wr.find("input").prop("checked",false);
		}else{
			$(this).addClass("active");
			$('#choose-media-value').removeClass("disabled");
			wr.addClass("checked");
			wr.find("input").prop("checked",true);
		}
	}); 
});
$(document).on("click", ".cancel-media-value", function() {
	$('.array_media').html("");
	$('.array_image_media').html("");
	$('.button-save-media').css('display','none');
	$('.array_image_media').css('display','none');
	$('#media-images-id').val("");
	$(this).parents(".message-box").removeClass("open");
	return false;
});
$("#choose-media-value").on("click",function(){
	var val 		= [];
	var jumlah = $('.gallery-item-controls .check .checked' ).length ;
	$('.gallery-item-controls .check .checked input[type="checkbox"]' ).each(function(i){
		val[i] = $(this).val();
		$('.array_media').append('<input style="color:#000;" type="text" name="media_id[]" value="'+val[i]+'" />');
	});
	getMedia(val);
});
function getMedia(val){
	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
	var media_id    = val;
    var base_url 	= window.location.origin;
   	$.ajax({
		type:"post",
		url: base_url+"/backadmin/choose-multiple-media",
		data: {
		_token	: CSRF_TOKEN,
		data  	: media_id,
	},
		success: function(data){
			$('#modal-choose-multiple-media').modal('hide');
			$.each(data.filename, function (index, media) {
				$('.array_image_media').css('display','block');
				$('.button-save-media').css('display','block');
				$('.array_image_media').append('<img style="width:45%; margin:10px 5px;" src="../../media/originals/'+media+'" alt="'+media+'">');
			});
		}
	});
}