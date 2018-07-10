@extends('back.yield.app')
@section('content')
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li><a href="{{url('/backadmin/foods')}}">Foods</a></li>
	<li class="active">{{$foods->title}}</li>
</ul>
<!-- END BREADCRUMB -->
<!-- PAGE CONTENT WRAPPER -->
<div  style="padding-top:20px;"  class="page-content-wrap">
	<!-- START WIDGETS -->
	<div class="row">
		<div class="col-md-12">
			@if ($message = Session::get('success'))
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>{{ $message }}</strong>
			</div>
			@elseif($message = Session::get('Failed'))
			<div class="alert alert-danger alert-block eror">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>{{ $message }}</strong>
			</div>
			@endif @if(count($errors)>0)
			<div class="alert alert-danger eror">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-body posts">
						<div class="row">
							<div class="col-md-12">
								<div class="post-item">
									<div class="post-title">
										<a href="{{url('backadmin/foods/').'/'.$foods->id}}">{{$foods->title}}</a>
									</div>
									<div class="post-date"><span class="fa fa-calendar"></span> {{$foods->created_at}} / <a href="pages-blog-post.html#comments">3 Comments</a> / <a href="pages-profile.html">{{$foods->user->name}}</a></div>
									<div class="post-text">
										@if(!empty($foods->media->filename))
										<img class="img-responsive img-text" style="width:100%;" src="{{url('/media/originals/').'/'.$foods->media->filename}}" alt="">
										@else
										<img class="img-responsive  img-text"  style="width:100%;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
										@endif
										<p>Store : <i>{{$foods->store->name}}</i></p>
										<p>contributor : <i>{{$foods->contributor}}</i></p>
										<p>
										Status Rekomended :
										@if($foods->status_recomended == 0)
										<i>None</i>
										@else
										<i>Rekomended</i>
										@endif
										</p>
										<span class="btn btn-default btn-lg mt-10 mb-10">Rp.{{number_format($foods->price)}} </span>
										<p>{!!$foods->text!!}</p>
									</div>
									<div class="post-row">
										<div class="post-info pull-right">
											<span class="btn @if($foods->status == 'draft') btn-danger @else btn-success @endif btn-md mt-10 mb-10"> {{$foods->status}} </span>
											&nbsp
											<button data-id="{{$foods->id}}" class="edit-foods btn btn-md btn-default">
											<i class="fa fa-pencil"></i>
											</button>
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<h3 class="push-down-20">Comments</h3>
					<div style="overflow: hidden;" id="food-comments"></div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<h3>Rating</h3>
						<div id="food-rating"></div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<h3>Categories</h3>
						<div class="links">
							@foreach($categories as $data)
							@if(!empty($data->categories->name))
							<a href="#">{{$data->categories->name}} <span class="label label-default">{{$data->count}}</span></a>
							@else
							<a href="#">Removed<span class="label label-default">-</span></a>
							@endif
							@endforeach
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<h3>Photos</h3>
						<button id="add-multiple-media" data-type="image" class="choose-multiple-media btn btn-lg btn-primary mbt10">Add Photos From Library</button>
						<div style="overflow: hidden;" id="food-photos"></div>
						<form id="upload-food-media" style="display:none"  class="form-horizontal" action="{{url('/backadmin/foods-upload-media')}}" method="post" accept-charset="utf-8">
							{{ csrf_field() }}
							<input id="food_id" type="hidden" name="food_id" value="{{$foods->id}}">
							<div class="array_media">
								<div class='preload-datatable'><center><img style='width:30px; margin:auto;' src='{{url('/')}}/back_assets/img/loading_button.gif'></center></div>
							</div>
						</form>
						<div style="background:#f0f0f0;display:none;" class="array_image_media"></div>
						<div style="display:none; margin-top: 10px;" class="button-save-media">
							<button onclick="event.preventDefault();
							document.getElementById('upload-food-media').submit();"  class="btn btn-success btn-lg pull-right mb-control-close">Save</button>
							<button class="btn btn-default btn-lg pull-right cancel-media-value">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
	<div class="slides">
	</div>
	<h3 class="title"></h3>
	<a class="prev">‹</a>
	<a class="next">›</a>
	<a class="close">×</a>
	<a class="play-pause"></a>
	<ol class="indicator">
	</ol>
</div>
<div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="photos-delete">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-trash-o"></span>Delete Confirm!</div>
			<div class="mb-content">
				<p>Are you Sure delete this <b>data</b></p>
			</div>
			<div class="mb-footer">
				<form id="delete-foods-photos" style="display:none;"  class="form-horizontal" action="" method="post" accept-charset="utf-8">
					{{ csrf_field() }}
					<input style="color:#000;" type="hidden" name="id" value="" id="delete-food-photos-id"  />
				</form>
				<button onclick="event.preventDefault();
				document.getElementById('delete-foods-photos').submit();" class="btn btn-primary btn-lg pull-right mb-control-close">Yes</button>
				<button class="btn btn-default btn-lg pull-right mb-control-close">No</button>
			</div>
		</div>
	</div>
</div>
<div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="comments-delete">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-trash-o"></span>Delete Confirm!</div>
			<div class="mb-content">
				<p>Are you Sure delete this <b>data</b></p>
			</div>
			<div class="mb-footer">
				<form id="delete-foods-comments" style="display:none;"  class="form-horizontal" action="" method="post" accept-charset="utf-8">
					{{ csrf_field() }}
					<input style="color:#000;" type="hidden" name="id" value="" id="delete-food-comments-id"  />
				</form>
				<button onclick="event.preventDefault();
				document.getElementById('delete-foods-comments').submit();" class="btn btn-primary btn-lg pull-right mb-control-close">Yes</button>
				<button class="btn btn-default btn-lg pull-right mb-control-close">No</button>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT WRAPPER -->
@include('back.modal.add_foods')
@include('back.modal.edit_foods')
@include('back.modal._list_media')
@include('back.modal._list_media_multiple')
@stop
@push('scripts')
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/foods_index.min.js')}}"></script>
@endpush