
$("#choose-image-radio  input[name='media_id[]']:radio").on("change", function() {
	var CSRF_TOKEN 	= $('meta[name="csrf-token"]').attr('content');
    var base_url 	= window.location.origin;
	var media_id 	= $(this).val();
	$.ajax({
		type:"GET",
		url: base_url+"/backadmin/choose-media/"+media_id,
		data: {
		_token: CSRF_TOKEN,
	},
	success: function(data){
		if($('#modal-add-slider').is(':visible')){
			if($('#size-value').val()=='desktop'){
				$('#image_output').html('');
				$('#media_id').val(data.id);
				$('#image_output').html('<img style="max-width:250px; margin:10px auto;" src="../media/originals/'+data.filename+'" alt="'+data.name+'">');
			}else{
				$('#mobile_image_output').html('');
				$('#mobile_media_id').val(data.id);
				$('#mobile_image_output').html('<img style="max-width:250px; margin:10px auto;" src="../media/originals/'+data.filename+'" alt="'+data.name+'">');	
			}
			$('#modal-choose-media').modal('hide');
		}else if($('#modal-edit-home-slider').is(':visible')){
			if($('#edit-size-value').val()=='desktop'){
				$('#edit-image_output').html('');
				$('#edit-media_id').val(data.id);
				$('#edit-image_output').html('<img style="max-width:250px; margin:10px auto;" src="../media/originals/'+data.filename+'" alt="'+data.name+'">');
			}else{
				$('#edit-mobile_image_output').html('');
				$('#edit-mobile_media_id').val(data.id);
				$('#edit-mobile_image_output').html('<img style="max-width:250px; margin:10px auto;" src="../media/originals/'+data.filename+'" alt="'+data.name+'">');
			}
			$('#modal-choose-media').modal('hide');
		}else if($('#modal-add-categories').is(':visible')){
			$('#modal-add-categories #image_output').html('');
			$('#modal-add-categories #media_id').val(data.id);
			$('#modal-add-categories #image_output').html('<img style="max-width:250px; margin:10px auto;" src="../../media/originals/'+data.filename+'" alt="'+data.name+'">');
			$('#modal-choose-media').modal('hide');
		}else if($('#modal-edit-categories').is(':visible')){
			$('#modal-edit-categories #edit-image_output').html('');
			$('#modal-edit-categories #edit-media_id').val(data.id);
			$('#modal-edit-categories #edit-image_output').html('<img style="max-width:250px; margin:10px auto;" src="../../media/originals/'+data.filename+'" alt="'+data.name+'">');
			$('#modal-choose-media').modal('hide');
		}else if($('#modal-add-stores').is(':visible')){
			$('#modal-add-stores #image_output').html('');
			$('#modal-add-stores #media_id').val(data.id);
			$('#modal-add-stores #image_output').html('<img style="max-width:250px; margin:10px auto;" src="../../media/originals/'+data.filename+'" alt="'+data.name+'">');
			$('#modal-choose-media').modal('hide');
		}else if($('#modal-edit-stores').is(':visible')){
			$('#modal-edit-stores #edit-image_output').html('');
			$('#modal-edit-stores #edit-media_id').val(data.id);
			$('#modal-edit-stores #edit-image_output').html('<img style="max-width:250px; margin:10px auto;" src="../../media/originals/'+data.filename+'" alt="'+data.name+'">');
			$('#modal-choose-media').modal('hide');
		}else if($('#modal-add-videos').is(':visible')){
			$('#modal-add-videos #image_output').html('');
			$('#modal-add-videos #media_id').val(data.id);
			$('#modal-add-videos #image_output').html('<img style="max-width:250px; margin:10px auto;" src="../../media/originals/'+data.filename+'" alt="'+data.name+'">');
			$('#modal-choose-media').modal('hide');
		}else if($('#modal-edit-videos').is(':visible')){
			$('#modal-edit-videos #edit-image_output').html('');
			$('#modal-edit-videos #edit-media_id').val(data.id);
			$('#modal-edit-videos #edit-image_output').html('<img style="max-width:250px; margin:10px auto;" src="../../media/originals/'+data.filename+'" alt="'+data.name+'">');
			$('#modal-choose-media').modal('hide');
		}else if($('#modal-add-foods').is(':visible')){
			$('#modal-add-foods #image_output').html('');
			$('#modal-add-foods #media_id').val(data.id);
			$('#modal-add-foods #image_output').html('<img style="max-width:250px; margin:10px auto;" src="../../media/originals/'+data.filename+'" alt="'+data.name+'">');
			$('#modal-choose-media').modal('hide');
		}else if($('#modal-edit-foods').is(':visible')){
			$('#modal-edit-foods #edit-image_output').html('');
			$('#modal-edit-foods #edit-media_id').val(data.id);
			$('#modal-edit-foods #edit-image_output').html('<img style="max-width:250px; margin:10px auto;" src="../../media/originals/'+data.filename+'" alt="'+data.name+'">');
			$('#modal-choose-media').modal('hide');
		}else if($('#modal-add-categories-abjad').is(':visible')){
			if($('#size-value').val()=='desktop'){
				$('#image_output').html('');
				$('#media_id').val(data.id);
				$('#image_output').html('<img style="max-width:250px; margin:10px auto;" src="../media/originals/'+data.filename+'" alt="'+data.name+'">');
			}else{
				$('#mobile_image_output').html('');
				$('#mobile_media_id').val(data.id);
				$('#mobile_image_output').html('<img style="max-width:250px; margin:10px auto;" src="../media/originals/'+data.filename+'" alt="'+data.name+'">');	
			}
			$('#modal-choose-media').modal('hide');

		}else if($('#modal-edit-categories-abjad').is(':visible')){
			if($('#edit-size-value').val()=='desktop'){
				$('#edit-image_output').html('');
				$('#edit-media_id').val(data.id);
				$('#edit-image_output').html('<img style="max-width:250px; margin:10px auto;" src="../media/originals/'+data.filename+'" alt="'+data.name+'">');
			}else{
				$('#edit-mobile_image_output').html('');
				$('#edit-mobile_media_id').val(data.id);
				$('#edit-mobile_image_output').html('<img style="max-width:250px; margin:10px auto;" src="../media/originals/'+data.filename+'" alt="'+data.name+'">');
			}
			$('#modal-choose-media').modal('hide');

		}

	}
	});
	return false;
});