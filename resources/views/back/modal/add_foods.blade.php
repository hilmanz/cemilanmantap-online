<!-- Start Modal Add Item Categories -->
<div id="modal-add-foods" class="modal fade bd-example-modal-lg" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-pink">
				<h5 class="modal-title">
				New foods
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" >&times;</span>
				</button>
				</h5>
			</div>
			<div class="modal-body">
				<div class="row">
					<form id="form-add-foods" action="{{ url('/backadmin/foods') }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
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
							<div class="col-md-12">
								<div class="form-group">
									<label class="col-md-3 control-label">Cover</label>
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
							<div style="overflow:hidden;" class="col-md-12 mb-20">
								<div class="form-group pilih-store">
									<label class="col-md-3 control-label">Stores</label>
									<div class="col-md-9">
										<select style="width: 100%;" id="stores-select" name="store_id" class="stores-select form-control" >
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Categories</label>
									<div class="col-md-9">
										<select style="width: 100%;" id="categories-select" multiple="multiple" name="category_id[]" class=" categories-select form-control" >
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
									<label class="col-md-3 control-label">Price</label>
									<div class="col-md-9">
										<input type="number" class="form-control" name="price" placeholder="Price"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Short Text</label>
									<div class="col-md-9">
										<textarea name="short_text" onkeyup="countChar(this)" class="form-control" cols="30" rows="10"></textarea>
										<div id="charNum"></div>
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
									<label class="col-md-3 control-label">Contributor</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="contributor" placeholder="Contributor"/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Status Rekomended</label>
									<div class="col-md-9">
										<select style="width: 100%;" name="status_recomended" class="form-control" >
										<option value="0" slected="true">None</option>
										<option value="1">Rekomended</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label">Long Text</label>
									<div style="min-height: 500px!important;" class="col-md-12">
										<textarea id="add_post" style="height: 500px!important;" name="text" class="form-control  my-editor"></textarea>
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
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="col-md-3 control-label"></label>
									<p class="text-right">
										<img class="loading-button" style="width:20px; display: none;" src="{{url('/back_assets')}}/img/loading_button.gif" alt="">
										<button type="button" class="btn btn-primary bg-cokelat submit-foods">Save</button>
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
<script>
	function countChar(short_text) {
var len = short_text.value.length;
if (len >= 300) {
short_text.value = short_text.value.substring(0, 500);
$('#charNum').text(300 - len);
} else {
$('#charNum').text(300 - len);
}
	}
</script>