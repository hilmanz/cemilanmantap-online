<!-- Start Modal Add Item Categories -->
<div id="modal-add-case" class="modal fade bd-example-modal-lg" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-pink">
				<h5 class="modal-title">
				New case
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" >&times;</span>
				</button>
				</h5>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="form-add-case" action="{{ url('/backadmin/posts') }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<input type="hidden" name="media_id" id="media_id">
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
										<select class="form-control" readonly name="status" id="status">
											<option value="draft">draft</option>
											<option value="publish">publish</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Title</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="title" placeholder="Title"/>
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
										<input type="text" class="form-control" name="type" id="case-type" value="" readonly="true" placeholder="Automatic when you choose image"/>
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
														<div id="image_output"></div>
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
								<div class="col-md-9 input-group"  id='datetimepicker1'>
									<input type='text' name="updated_at" id="date" class="form-control" />
									<label class="input-group-addon btn" for="date">
										<span class="glyphicon glyphicon-calendar open-datetimepicker"></span>
									</label>
								</div>
							</div>
							<div style="min-height: 500px!important;" class="col-md-12">
								<textarea id="add_post" style="height: 500px!important;" name="text" class="form-control  my-editor"></textarea>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<p class="text-right">
										<img class="loading-button" style="width:20px; display: none;" src="{{url('/back_assets')}}/img/loading_button.gif" alt="">
										<button type="button" class="btn btn-primary bg-cokelat submit-case">Save</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
									</p>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END Modal Add Item Categories -->
<script>
$(document).ready(function() {
	$(function () {
		$('#datetimepicker1').datetimepicker({
			format: 'YYYY-MM-DD HH:mm:ss'
		});
		$('#datetimepicker1 input').click(function(event){
		   $('#datetimepicker1 ').data("DateTimePicker").show();
		});
	});
});
</script>