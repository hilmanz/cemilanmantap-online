<form id="media-edit-upload" action="{{ url('/backadmin/media').'/'.$media->id }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
	<div class="col-md-12 mb-20">
		<div style="overflow:hidden;" class="col-md-12 mb-20">
			<div class="form-group">
				<label class="col-md-3 control-label">Media Type</label>
				<div class="col-md-9">
					<select class="form-control media_type" name="type" id="media_type">
						<option value="">Choose Media Type</option>
						<option @if($media->type =='image') selected="true" @endif value="image">Image</option>
						<option @if($media->type =='video') selected="true" @endif value="video">Video</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-body">
					<h3><span class="fa fa-picture-o"></span> Images</h3>
					<div class="form-group">
						<div class="col-md-12">
							<label>Browse Image</label>
							<br/>
							<input type="file" name="filename" id="edit-media"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="col-md-3 control-label">name</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="name" placeholder="Images Name"  value="{{$media->name}}"/>
				</div>
			</div>
		</div>
		<div @if($media->type =='video') style="display:block" @else style="display:none" @endif id="edit-filter_video" class="mb-20">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-3 control-label">link</label>
					<div class="col-md-9">
						<input type="text" class="form-control" id="edit-link" name="link" placeholder="Link youtube - https://"  value="@if($media->type =='video'){{$media->link}}@endif"/>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="preview"></div>
			<div class="progress" style="display:none; overflow: hidden;">
				<div class="progress-bar" role="progressbar" aria-valuenow="0"
					aria-valuemin="0" aria-valuemax="100" style="width:0%">
					0%
				</div>
			</div>
			<div class="mess" style="display:block; overflow: hidden;"></div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<p class="text-right">
					<img class="loading-button" style="width:20px; display: none;" src="{{url('/back_assets')}}/img/loading_button.gif" alt="">
					&nbsp
					<button type="button" class="edit-upload-media btn btn-primary bg-cokelat">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				</p>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/media_data_edit.min.js')}}"></script>
<script>

$("#edit-media").fileinput({
		showUpload: false,
		initialPreview: [
		'<img src="{{url('/').'/media/originals/'.$media->filename}}" class="file-preview-image" .... >'
		],
		showCaption: false,
		browseClass: "btn btn-danger",
		fileType: "any"
	});

</script>