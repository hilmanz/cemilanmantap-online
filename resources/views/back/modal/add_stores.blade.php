<!-- Start Modal Add Item stores -->
<div id="modal-add-stores" class="modal fade bd-example-modal-lg" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-pink">
				<h5 class="modal-title">
				Add stores
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" >&times;</span>
				</button>
				</h5>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="form-add-stores" action="{{ url('/backadmin/stores') }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
						{{ csrf_field() }}
						{{ method_field('POST') }}
						<input type="hidden" name="file_id" id="media_id">
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
								<div class="form-group pilih-store">
									<label class="col-md-3 control-label">Location By Google Map API</label>
									<div class="col-md-9">
										<select style="width: 100%;" id="location-select" name="location" class=" location-select form-control" >
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">stores Name</label>
									<div class="col-md-9">
										<input type="text" class="form-control store_name" name="name" placeholder="stores Name"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Latitude</label>
									<div class="col-md-9">
										<input type="text" class="form-control lat" name="lat" placeholder="Latitude"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Longtitude</label>
									<div class="col-md-9">
										<input type="text" class="form-control lng" name="lng" placeholder="Longtitude"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Place Id</label>
									<div class="col-md-9">
										<input type="text" class="form-control place_id" name="place_id" placeholder="Place ID"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Url</label>
									<div class="col-md-9">
										<input type="text" class="form-control url" name="url" placeholder="Url"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Country</label>
									<div class="col-md-9">
										<input type="text" class="form-control country" name="country" placeholder="country"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">City</label>
									<div class="col-md-9">
										<input type="text" class="form-control city" name="city" placeholder="City"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Country initial</label>
									<div class="col-md-9">
										<input type="text" class="form-control country_initial" name="country_initial" placeholder="country Initial"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Email</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="email" placeholder="Email"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Phone Number</label>
									<div class="col-md-9">
										<input type="text" class="form-control phone_number" name="phone_number" placeholder="Phone Numbers"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Address</label>
									<div class="col-md-9">
										<textarea name="address" class="form-control address" id="" cols="30" rows="10"></textarea>
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
									<label class="col-md-3 control-label">Url Google Map Method</label>
									<div class="col-md-9">
										<select class="form-control" name="url_use" id="status">
											<option value="url">url</option>
											<option value="longlat">Longtitude & Latitude</option>
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
<!-- END Modal Add Item stores -->