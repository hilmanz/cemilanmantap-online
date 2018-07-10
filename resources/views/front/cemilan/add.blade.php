@extends('front.yield.app')
@section('content')
<div class="main-wrapper">
    <div class="main">
        <div class="main-inner">
            <div class="content">
                <div class="container push-top-bottom">
                	<div class="row">
                		<div class="col-sm-12 col-md-6 col-md-push-3">
                			<div class="box center">
                            <form id="form-add-referensi-cemilan" action="{{ url('/add-referensi-cemilan') }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                    <div class="col-sm-12 col-md-10 col-md-push-1">
                    					<legend class="mb30 mt20"><b>Add Cemilan</b></legend>
                                        <div class="w100">
                                            <div class="pesan" style="display:block; overflow: hidden;"></div>
                                        </div>
                    					<div class="form-group">
                    						<input type="text" class="form-control" name="name" placeholder="Nama Cemilan">
                    					</div><!-- /.form-group -->
                    					<div class="form-group">
                                            <input type="text" class="form-control" name="lokasi" placeholder="Lokasi">
                    					</div><!-- /.form-group -->
                    					<div class="form-group">
                                            <input type="number" class="form-control" name="harga" placeholder="Harga">
                    					</div><!-- /.form-group -->
                    					<div class="form-group">
                                            <input type="number" class="form-control" name="no_telp" placeholder="Telepon">
                    					</div><!-- /.form-group -->
                    					<div class="form-group">
                    						<textarea style="height: 200px;" class="form-control" name="review_text" placeholder="Tulis Review" cols="30" rows="10"></textarea>
                    					</div><!-- /.form-group -->
                                        <div class="file-upload-previews"></div><!-- /.file-upload-previews -->
                                        <div class="file-upload">
                                            <input type="file" name="filename[]" class="file-upload-input with-preview" multiple title="Click to add files" maxlength="10" accept="gif|jpg|png">
                                            <span>Click to add images</span>
                                        </div><!-- /.file-upload -->
                                        <div class="w100">
                                            <div class="preview"></div>
                                            <div class="progress" style="display:none; overflow: hidden;">
                                                <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                                    aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                                    0%
                                                </div>
                                            </div>
                                        </div>
                    					<div class="center">
                    						<div class="form-group-btn" style="z-index:999">
                    							<button type="button" class="btn btn-primary btn-large submit-referensi-cemilan">Submit Review</button>
                                                <img class="loading-button" style="width:20px; display: none;" src="{{url('/back_assets')}}/img/loading_button.gif" alt="">
                    						</div><!-- /.form-group-btn -->
                    					</div><!-- /.center -->
                                    </div>
                				</form>
                			</div><!-- /.box -->
                		</div><!-- /.col -->
                	</div><!-- /.row -->

                </div><!-- /.container -->
            </div><!-- /.content -->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->
</div><!-- /.main-wrapper -->
@stop
@push('scripts')
<script type='text/javascript' src='{{url('/back_assets')}}/js/form.js'></script>
<script type="text/javascript" src="{{url('/back_assets')}}/js/plugins/scrolltotop/scrolltopcontrol.js"></script>
<script type="text/javascript" src="{{url('/front_assets')}}/assets/js/jQuery.MultiFile.min.js"></script>
<script type="text/javascript" src="{{url('/').mix('front_assets/assets/js/add_cemilan/add_cemilan.min.js')}}"></script>
@endpush