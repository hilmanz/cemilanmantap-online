// modal
$(document).on("click", "#add-media", function() {
	$('#modal-add-media').modal('show');
	$(".progress").css("display","none");
	$(".mess").html("");
	$(".mess").removeClass("alert");
});
$(document).on("click", ".edit-image", function() {
	var base_url = window.location.origin;
	$('#get-edit-images').html("<center><img style='width:60px; margin:auto;' src='"+ base_url+ "'/back_assets/img/loading_button.gif'></center>");
	var id = $(this).data('id');
	$('#edit-images').modal('show') ;
	getEditImages(id);
	return false;
});
function getEditImages(id){
    var base_url = window.location.origin;
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		type:"GET",
		url: base_url+"/backadmin/media/"+id+"/edit",
		data: {
		_token: CSRF_TOKEN,
		id :id
	},
	success: function(html){
		$('#get-edit-images').html(html);
	}
	});
	return false;
}
// end modal
// Add modal duplicate section
var add_clones_limit = 6;
var add_cloned_nbr = $(".add-loop-spec").length - 1; //Exclude Default (first) div
function add_clone() {
if (add_cloned_nbr < add_clones_limit) {
		add_cloned_nbr++;
		var new_clone = $(".add-loop-spec").first().clone();
			$("#add-sections-spec").append(new_clone);
			add_rearrange();
		}
}
function add_remove() {
	$(this).closest(".add-loop-spec").remove();
	add_cloned_nbr--;
	add_rearrange();
}
function add_rearrange() {
var count = 1;
var totalCount = $(".add-loop-spec").length;
	$(".add-loop-spec").each(function() {
		$(this).attr("id", "add-loop-spec" + count).find(".add-number-section-spec").text(count).end().
		find(".add-specification").attr("id", "add-specification" + count).end().find(".remove").toggle(totalCount != 1).attr("id", "remove" + count);
		count++;
	});
}
$(".add-clone").on("click", add_clone);
$(document).on("click", ".add-remove", add_remove);
// end Add modal duplicate section
$(function(){
	$("#file-image").fileinput({
		showUpload: false,
		showCaption: false,
		browseClass: "btn btn-danger",
		fileType: "any"
	});
});
// Ajax Upload Progres Bar
$(document).ready(function() {
// Start Gallery Icheck
$.mpb("show",{value: [0,50],speed: 5});
/* Gallery Items */
$(".gallery-item .iCheck-helper").on("click",function(){
	var wr = $(this).parent("div");
	if(wr.hasClass("checked")){
		$(this).parents(".gallery-item").addClass("active");
	}else{
		$(this).parents(".gallery-item").removeClass("active");
	}
});
$(".gallery-item-remove").on("click",function(){
	$(this).parents(".gallery-item").fadeOut(400,function(){
		$(this).remove();
	});
	return false;
});
$("#gallery-toggle-items").on("click",function(){
	$(".gallery-item").each(function(){
		var wr = $(this).find(".iCheck-helper").parent("div");
		if(wr.hasClass("checked")){
			$(this).removeClass("active");
			$('#delete-value').addClass("disabled");
			wr.removeClass("checked");
			wr.find("input").prop("checked",false);
		}else{
			$(this).addClass("active");
			$('#delete-value').removeClass("disabled");
			wr.addClass("checked");
			wr.find("input").prop("checked",true);
		}
	});
});
// End Gallery Icheck
var progressbar     = $('.progress-bar');
$(".upload-media").click(function(){
	$(".upload-media").prop("disabled", true).css("cursor", 'not-allowed');
	$(".loading-button").css("display", 'inline-block');
		$("#media-lib-upload").ajaxForm(
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
					$(".upload-media").prop("disabled", false).css("cursor", 'pointer');
					$(".loading-button").css("display", 'none');
					$('#file-image').fileinput('reset');
					$(this).closest('form').find("input[type=text], textarea").val("");
					getData();
					location.reload();
				}else if(data.status == 'Failed'){
					$('.mess').html(data.message);
					$(".upload-media").prop("disabled", false).css("cursor", 'pointer');
					$(".loading-button").css("display", 'none');
				}else{
					var errorString = '';
					$.each( data.message, function( key, value) {
						errorString += '<li>' + value + '</li>';
						});
						$('#someDivToDisplayErrors').html(errorString);
						$('.mess').removeClass('alert alert-success');
						$('.mess').addClass('alert alert-danger');
					$('.mess').html(errorString);
					$(".upload-media").prop("disabled", false).css("cursor", 'pointer');
					$(".loading-button").css("display", 'none');
				}
					$('div').animate({ scrollTop: $('.progress').offset().top }, 'slow');
			}
			})
		.submit();
});
});
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
	getData();
	$(document).on('click', '.pagination a',function(event){
		$('li').removeClass('active');
		$(this).parent('li').addClass('active');
		event.preventDefault();
		var myurl 	= $(this).attr('href');
		var page  	= myurl.split('page=')[1];
		var keyword = $('#search_keyword').val();
		getData(page,keyword);
		$('#delete-value').addClass("disabled");
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
function getData(page,keyword){
    var base_url = window.location.origin;
	$('#imagesList').html("<div class='preload-datatable'><center><img style='width:30px; margin:auto;' src='"+ base_url+ "/back_assets/img/loading_button.gif'></center></div>");
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
	}else{
		$.ajax({
			url: '?page=' + page,
			type: "get",
			datatype: "html",
			data: {
				_token  : CSRF_TOKEN,
				q 		: keyword,
			},
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
// End Pagination Ajax
$(document).on("click", "#delete-image", function() {
	/* MESSAGE BOX */
	var box = $($(this).data("box"));
	var images_id = $(this).data('id');
	$('.array_delete').append('<input style="color:#000;" type="text" name="id[]" value="'+images_id+'" />');
	if (box.length > 0) {
		box.toggleClass("open");
		var sound = box.data("sound");
		if (sound === 'alert')
		playAudio('alert');
		if (sound === 'fail')
		playAudio('fail');
	}
	return false;
	/* END MESSAGE BOX */
});
$(document).on("click", ".cancel-delete-value", function() {
	$('.array_delete').html("");
	$('#delete-images-id').val("");
	$(this).parents(".message-box").removeClass("open");
	return false;
});
$(document).on("click", "#delete-value", function() {
	var box = $($(this).data("box"));
	var val = [];
	var jumlah = $('.gallery-item-controls .check .checked' ).length ;
	$('.gallery-item-controls .check .checked input[type="checkbox"]' ).each(function(i){
		val[i] = $(this).val();
		$('.array_delete').append('<input style="color:#000;" type="text" name="id[]" value="'+val[i]+'" />');
	});
	if(jumlah>0){
		if (box.length > 0) {
			box.toggleClass("open");
			var sound = box.data("sound");
			if (sound === 'alert')
			playAudio('alert');
			if (sound === 'fail')
			playAudio('fail');
		}
	}
	return false;
});
$(document).ready(function(){
	$('#filter_video').hide();
	$('.media_type ').on('change', function(){
		if($(this).val()=='image'){
			$('#filter_video').hide();
		}else{
			$('#filter_video').show();
		}
	});
});