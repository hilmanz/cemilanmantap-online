<form id="form-edit-event" action="{{ url('/backadmin/posts').'/'.$posts->id }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
	<input type="hidden" name="media_id" value="{{$posts->media_id}}" id="media_id">
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
		<div style="overflow:hidden;" class="col-md-12 mb-20">
			<div class="form-group pilih-store">
				<label class="col-md-3 control-label">Categories</label>
				<div class="col-md-9">
					<select style="width: 100%;" id="categories-select" name="category_id" class=" categories-select form-control" >
						@if(!empty($posts_role_categories->categories->id))
						<option value="{{$posts_role_categories->categories->id}}">{{$posts_role_categories->categories->name}}</option>
						@endif
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Status</label>
				<div class="col-md-9">
					<select class="form-control" name="status" id="status">
						<option @if($posts->status == 'draft') selected @endif value="draft">draft</option>
						<option @if($posts->status == 'publish') selected @endif value="publish">publish</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Title</label>
				<div class="col-md-9">
					<input type="text" class="form-control" value="{{$posts->title}}" name="title" placeholder="Title"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Section</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="section" value="event" readonly="true" placeholder="Name"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Type</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="type" id="event-type" value="{{$posts->type}}" readonly="true" placeholder="Automatic when you choose image"/>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label class="col-md-3 control-label">Images</label>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<div class="col-md-12">
									<div id="image_output">
										@if(!empty($posts->media->filename))
										<img style="width:200px;" src="{{url('/media/originals/').'/'.$posts->media->filename}}" alt="">
										@else
										<img style="width:200px;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
										@endif
										<br>
										<br>
									</div>
									<a id="choose-media" class="choose-media btn btn-success">
										<i class="fa fa-picture-o"></i>
										Choose From library
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<p class="text-right">
					<img class="loading-button" style="width:20px; display: none;" src="{{url('/back_assets')}}/img/loading_button.gif" alt="">
					<button type="button" class="btn btn-primary bg-cokelat edit-submit-event">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</p>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/posts_data_edit_event.min.js')}}"></script>