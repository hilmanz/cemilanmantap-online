<form id="form-edit-categories-abjad" action="{{ url('/backadmin/categories-abjad').'/'.$category_abjad->id }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
	<input type="hidden" name="file_id" value="{{$category_abjad->media_id}}" id="edit-media_id">
	<input type="hidden" name="mobile_media_id" value="{{$category_abjad->mobile_media_id}}" id="edit-mobile_media_id">
	<input type="hidden" name="id" value="{{$category_abjad->id}}">
	<input type="hidden" id="edit-size-value">
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
											@if(!empty($category_abjad->media->filename))
											<img style="width:100%;" src="{{url('/media/thumbnail/').'/'.$category_abjad->media->filename}}" alt="">
											@else
											<img style="width:100%;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
											@endif
											<br>
											<br>
										</div>
										<a id="choose-media" data-type="image" data-size="desktop" class="choose-media btn btn-success">
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
				<label class="col-md-3 control-label">Mobile Images</label>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<div class="col-md-12">
									<div id="edit-mobile_image_output">
										@if(!empty($category_abjad->mobile_media->filename))
										<img style="width:100%;" src="{{url('/media/originals/').'/'.$category_abjad->mobile_media->filename}}" alt="">
										@else
										<img style="width:100%;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
										@endif
										<br>
										<br>
									</div>
									<a id="mobile-choose-media" data-type="image" data-size="mobile" class="choose-media btn btn-success">
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
				<label class="col-md-3 control-label">Abjad Categories Name</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="name" placeholder="Abjad Categories Name"  value="{{$category_abjad->name}}"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Meta Title</label>
				<div class="col-md-9">
					<input type="text" class="form-control store_name" value="{{$category_abjad->meta_title}}" name="meta_title" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Meta Description</label>
				<div class="col-md-9">
					<input type="text" class="form-control address" value="{{$category_abjad->meta_description}}" name="meta_description">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Meta Tags</label>
				<div class="col-md-9">
					<input type="text" class="form-control" value="{{$category_abjad->meta_tags}}" name="meta_tags" data-role="tagsinput" >
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
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/categories_abjad_data_edit.min.js')}}"></script>