<!-- Start Modal Add Item comments -->
<div id="modal-add-comments" class="modal fade bd-example-modal-lg" role="dialog" aria-hidden="true">
	<div class="modal-dialog " role="document">
		<div class="modal-content">
			<div class="modal-header bg-pink">
				<h5 class="modal-title">
				Add Comments
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" >&times;</span>
				</button>
				</h5>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="form-add-comments" action="{{ url('/backadmin/comments') }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
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
								<div class="form-group pilih-store">
									<label class="col-md-3 control-label">Food</label>
									<div class="col-md-9">
										<select style="width: 100%;" id="food-select" name="food_id" class=" food-select form-control" >
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Title</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="title">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Comments</label>
									<div class="col-md-9">
										<textarea name="text" class="form-control" cols="30" rows="10"></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Rating</label>
									<div class="col-md-9">
										<div class="star-rating">
											<span class="fa fa-star-o" data-rating="1"></span>
											<span class="fa fa-star-o" data-rating="2"></span>
											<span class="fa fa-star-o" data-rating="3"></span>
											<span class="fa fa-star-o" data-rating="4"></span>
											<span class="fa fa-star-o" data-rating="5"></span>
											<input type="hidden" name="rating" class="rating-value" value="3">
										</div>
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
									<div class="panel panel-default">
										<div class="panel-body">
											<h3><span class="fa fa-picture-o"></span> Images</h3>
											<div class="form-group">
												<div class="col-md-12">
													<label>Browse Image</label>
													<br/>
													<input type="file" multiple name="filename[]" id="file-image"/>
												</div>
											</div>
										</div>
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
<!-- END Modal Add Item comments -->