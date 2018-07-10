<form id="form-edit-case" action="{{ url('/backadmin/update-case') }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
	{{ csrf_field() }}
	<input type="hidden" name="media_id" value="{{$posts->media_id}}" id="media_id">
	<input type="hidden" name="id" value="{{$posts->id}}" />
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
					<input type="text" class="form-control" name="section" value="case-studies" readonly="true" placeholder="Name"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-md-3 control-label">Type</label>
				<div class="col-md-9">
					<input type="text" class="form-control" name="type" id="case-type" value="{{$posts->type}}" readonly="true" placeholder="Automatic when you choose image"/>
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
		<div class="form-group">
			<label class="col-md-3 control-label">Created At</label>
			<div class="col-md-9 input-group"  id='datetimepicker-edit'>
				<input type='text' value="{{$posts->updated_at}}" name="updated_at" id="date-edit" class="form-control" />
				<label class="input-group-addon btn" for="date-edit">
					<span class="glyphicon glyphicon-calendar open-datetimepicker"></span>
				</label>
			</div>
		</div>
		<div class="col-md-12">
			<textarea style="height: 500px!important;" name="text" class="form-control my-editor">{!! $posts->text !!}</textarea>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label class="col-md-3 control-label"></label>
				<p class="text-right">
					<img class="loading-button" style="width:20px; display: none;" src="{{url('/back_assets')}}/img/loading_button.gif" alt="">
					<button type="submit" class="btn btn-primary bg-cokelat ">Save</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				</p>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/posts_data_edit_case_studies.min.js')}}"></script>
<script>
$(document).ready(function() {
	$(function () {
		$('#datetimepicker-edit').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss',
		});
		$('#datetimepicker-edit input').click(function(event){
		$('#datetimepicker-edit ').data("DateTimePicker").show();
		});
	});
});
</script>