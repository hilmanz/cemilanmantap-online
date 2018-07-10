<form id="form-edit-videos" action="{{ url('/backadmin/videos').'/'.$videos->id }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
	<input type="hidden" name="file_id" value="{{$videos->media_id}}" id="edit-media_id">
	<div class="col-md-12 mb-20">
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
				<label class="col-md-3 control-label">Videos</label>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<div class="col-md-12">
									<div id="edit-image_output">
										@if(!empty($videos->media->filename))
										<img style="width:100%;" src="{{url('/media/thumbnail/').'/'.$videos->media->filename}}" alt="">
										@else
										<img style="width:100%;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
										@endif
										<br>
										<br>
									</div>
									<a id="choose-media" data-type="video" class="choose-media btn btn-danger">
										<i class="fa fa-play"></i>
										Choose Videos From Library
									</a>
									<div class="wrong-type"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style="overflow:hidden;" class="col-md-12 mb-20">
			<div class="form-group">
				<label class="col-md-3 control-label">Name</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="name" placeholder="Name"  value="{{$videos->name}}"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Description</label>
				<div class="col-md-9">
					<textarea name="text" class="form-control description" id="" cols="30" rows="10">{{$videos->text}}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Status</label>
				<div class="col-md-9">
					<select class="form-control" name="status" id="status">
						<option @if($videos->status == 'draft') selected @endif value="draft">draft</option>
						<option @if($videos->status == 'publish') selected @endif value="publish">publish</option>
					</select>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<p class="text-right">
					<img class="loading-button" style="width:20px; display: none;" src="{{url('/back_assets')}}/img/loading_button.gif" alt="">
					<button type="button" class="btn btn-primary bg-cokelat submit-edit-videos">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</p>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/videos_data_edit.min.js')}}"></script>