<!-- Start Modal Add images -->
<div id="modal-add-media" class="modal fade bd-example-modal-lg" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-pink">
				<h5 class="modal-title">
				Add Media
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" >&times;</span>
				</button>
				</h5>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="media-lib-upload" action="{{ url('/backadmin/media') }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<div class="col-md-12 mb-20">
							<div style="overflow:hidden;" class="col-md-12 mb-20">
								<div class="form-group">
									<label class="col-md-3 control-label">Media Type</label>
									<div class="col-md-9">
										<select class="form-control media_type" name="type" id="media_type">
											<option value="">Choose Media Type</option>
											<option value="image">Image</option>
											<option value="video">Video</option>
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
												<input type="file" name="filename" id="file-image"/>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-3 control-label">name</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="name" placeholder="Images Name"  value=""/>
									</div>
								</div>
							</div>
							<div style="display:none" id="filter_video" class="mb-20">
								<div class="col-md-6">
									<div class="form-group">
										<label class="col-md-3 control-label">link</label>
										<div class="col-md-9">
											<input type="text" class="form-control" name="link" placeholder="Link youtube - https://"  value=""/>
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
										<button type="button" class="upload-media btn btn-primary bg-cokelat">Save</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
<!-- END Modal Add images -->