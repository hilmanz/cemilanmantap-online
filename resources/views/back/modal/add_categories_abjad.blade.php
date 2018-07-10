<!-- Start Modal Add Item Categories -->
<div id="modal-add-categories-abjad" class="modal fade bd-example-modal-lg" role="dialog" aria-hidden="true">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="modal-header bg-pink">
				<h5 class="modal-title">
				Add Abjad Categories
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" >&times;</span>
				</button>
				</h5>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="form-add-categories-abjad" action="{{ url('/backadmin/categories-abjad') }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<input type="hidden" name="file_id" id="media_id">
						<input type="hidden" name="mobile_media_id" id="mobile_media_id">
						<input type="hidden" id="size-value">
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
															<div id="image_output"></div>
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
														<div id="mobile_image_output"></div>
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
										<input type="text" class="form-control" name="name" placeholder="Abjad Categories Name"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Meta Title</label>
									<div class="col-md-9">
										<input type="text" class="form-control store_name" value="" name="meta_title" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Meta Description</label>
									<div class="col-md-9">
										<input type="text" class="form-control address" value="" name="meta_description">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Meta Tags</label>
									<div class="col-md-9">
										<input type="text" class="form-control" value="" name="meta_tags" data-role="tagsinput" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<p class="text-right">
										<img class="loading-button" style="width:20px; display: none;" src="{{url('/back_assets')}}/img/loading_button.gif" alt="">
										<button type="button" class="btn btn-primary bg-cokelat submit">Save</button>
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