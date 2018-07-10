<!-- Start Modal Add Item Categories -->
<div id="modal-add-event" class="modal fade bd-example-modal-lg" role="dialog" aria-hidden="true">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="modal-header bg-pink">
				<h5 class="modal-title">
				New Event
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" >&times;</span>
				</button>
				</h5>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="form-add-event" action="{{ url('/backadmin/posts') }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
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
								<div class="form-group pilih-store">
									<label class="col-md-3 control-label">Categories</label>
									<div class="col-md-9">
										<select style="width: 100%;" id="categories-select" name="category_id" class=" categories-select form-control" >
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Status</label>
									<div class="col-md-9">
										<select class="form-control" name="status" id="status">
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
										<input type="text" class="form-control" name="section" value="event" readonly="true" placeholder="Name"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Type</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="type" id="event-type" value="" readonly="true" placeholder="Automatic when you choose image"/>
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
							<div class="col-md-12">
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<p class="text-right">
										<img class="loading-button" style="width:20px; display: none;" src="{{url('/back_assets')}}/img/loading_button.gif" alt="">
										<button type="button" class="btn btn-primary bg-cokelat submit-event">Save</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
									</p>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- END Modal Add Item Categories -->