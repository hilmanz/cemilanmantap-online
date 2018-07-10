<form id="form-edit-categories" action="{{ url('/backadmin/categories').'/'.$category->id }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
	<input type="hidden" name="file_id" value="{{$category->media_id}}" id="edit-media_id">
	<input type="hidden" name="id" value="{{$category->id}}">
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
			<div class="col-md-12">
				<div class="form-group">
					<label class="col-md-3 control-label">Images</label>
					<div class="col-md-9">
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="form-group">
									<div class="col-md-12">
										<div id="edit-image_output">
											@if(!empty($category->media->filename))
											<img style="width:100%;" src="{{url('/media/thumbnail/').'/'.$category->media->filename}}" alt="">
											@else
											<img style="width:100%;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
											@endif
											<br>
											<br>
										</div>
										<a id="choose-media" data-type="image" class="choose-media btn btn-success">
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
			<div class="form-group">
				<label class="col-md-3 control-label">Abjad Categories</label>
				<div class="col-md-9">
					<select style="width: 100%;" id="categories-abjad-select" name="categories_abjad_id" class=" categories-abjad-select form-control" >
						@if($category->categories_abjad_id != NULL && !$category->categories_abjad->trashed())
						<option selected="true" value="{{$category->categories_abjad->id}}">{{$category->categories_abjad->name}}</option>
						@endif
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Categories Name</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="name" placeholder="Categories Name"  value="{{$category->name}}"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Short Text</label>
				<div class="col-md-9">
					<textarea name="short_text" class="form-control" id="" cols="30" rows="10">{{$category->short_text}}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Long Text</label>
				<div class="col-md-9">
					<textarea name="long_text" class="form-control" id="" cols="30" rows="10">{{$category->long_text}}</textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Meta Title</label>
				<div class="col-md-9">
					<input type="text" class="form-control store_name" value="{{$category->meta_title}}" name="meta_title" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Meta Description</label>
				<div class="col-md-9">
					<input type="text" class="form-control address" value="{{$category->meta_description}}" name="meta_description">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Meta Tags</label>
				<div class="col-md-9">
					<input type="text" class="form-control" value="{{$category->meta_tags}}" name="meta_tags" data-role="tagsinput" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Status</label>
				<div class="col-md-9">
					<select class="form-control" name="status" id="status">
						<option @if($category->status == 'draft') selected @endif value="draft">draft</option>
						<option @if($category->status == 'publish') selected @endif value="publish">publish</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<p class="text-right">
					<img class="loading-button" style="width:20px; display: none;" src="{{url('/back_assets')}}/img/loading_button.gif" alt="">
					<button type="button" class="btn btn-primary bg-cokelat edit-submit">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</p>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript" src="{{url('/back_assets')}}/js/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/categories_data_edit.min.js')}}"></script>