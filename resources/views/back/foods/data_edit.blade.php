<form id="form-edit-foods" action="{{ url('/backadmin/foods').'/'.$foods->id }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
	{{ csrf_field() }}
	{{ method_field('PATCH') }}
	<input type="hidden" name="media_id" value="{{$foods->media_id}}" id="edit-media_id">
	<input type="hidden" name="id" value="{{$foods->id}}" />
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
				<label class="col-md-3 control-label">Images</label>
				<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="form-group">
								<div class="col-md-12">
									<div id="edit-image_output">
										@if(!empty($foods->media->filename))
										<img style="width:250px;" src="{{url('/media/originals/').'/'.$foods->media->filename}}" alt="">
										@else
										<img style="width:250px;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
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
		<div style="overflow:hidden;" class="col-md-12 mb-20">
			<div class="form-group">
				<label class="col-md-3 control-label">Categories</label>
				<div class="col-md-9">
					<select style="width: 100%;" id="categories-select" name="category_id[]" multiple="multiple" class=" categories-select form-control" >
						@foreach($foods_role_categories as $data)
						@if(!empty($data->categories->name))
						<option selected="true" value="{{$data->categories->id}}">{{$data->categories->name}}</option>
						@endif
						@endforeach
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Stores</label>
				<div class="col-md-9">
					<select style="width: 100%;" id="stores-select" name="store_id" class="stores-select form-control" >
						<option selected="true" value="{{$foods->store_id}}">{{$foods->store->name}}</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Title</label>
				<div class="col-md-9">
					<input type="text" class="form-control" value="{{$foods->title}}" name="title" placeholder="Title"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Price</label>
				<div class="col-md-9">
					<input type="number" class="form-control" value="{{$foods->price}}" name="price" placeholder="Title"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Short Text</label>
				<div class="col-md-9">
					<textarea name="short_text"  onkeyup="countChar(this)"  class="form-control" cols="30" rows="10">{{ $foods->short_text }}</textarea>
					<div id="edit-charNum"></div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Meta Title</label>
				<div class="col-md-9">
					<input type="text" class="form-control store_name" value="{{$foods->meta_title}}" name="meta_title" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Meta Description</label>
				<div class="col-md-9">
					<input type="text" class="form-control address" value="{{$foods->meta_description}}" name="meta_description">
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Meta Tags</label>
				<div class="col-md-9">
					<input type="text" class="form-control" value="{{$foods->meta_tags}}" name="meta_tags" data-role="tagsinput" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Status Rekomended</label>
				<div class="col-md-9">
					<select style="width: 100%;" name="status_recomended" class="form-control" >
					<option @if($foods->status_recomended == 0) selected @endif value="0" slected="true">None</option>
					<option @if($foods->status_recomended == 1) selected @endif value="1">Rekomended</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Contributor</label>
				<div class="col-md-9">
					<input type="text" class="form-control" value="{{$foods->contributor}}" name="contributor" placeholder="Contributor"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Status</label>
				<div class="col-md-9">
					<select class="form-control" name="status" id="status">
						<option @if($foods->status == 'draft') selected @endif value="draft">draft</option>
						<option @if($foods->status == 'publish') selected @endif value="publish">publish</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Long Text</label>
				<div style="min-height: 500px!important;" class="col-md-12">
					<textarea style="height: 500px!important;" name="text" class="form-control my-editor edit-text">{!! $foods->text !!}</textarea>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<p class="text-right">
					<img class="loading-button" style="width:20px; display: none;" src="{{url('/back_assets')}}/img/loading_button.gif" alt="">
					<button type="submit" class="btn btn-primary bg-cokelat">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</p>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript" src="{{url('/back_assets')}}/js/bootstrap-tagsinput.js"></script>
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/foods_data_edit.min.js')}}"></script>
<script>
	function countChar(short_text) {
var len = short_text.value.length;
if (len >= 300) {
short_text.value = short_text.value.substring(0, 500);
$('#edit-charNum').text(300 - len);
} else {
$('#edit-charNum').text(300 - len);
}
	}
</script>