@extends('back.yield.app')
@section('content')
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li class="active">comments</li>
</ul>
<!-- END BREADCRUMB -->
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
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
			<div class="panel panel-default">
				<div class="col-md-12">
					<button id="add-comments" class="btn btn-lg btn-datatalk mbt10">Add comments</button>
				</div>
				<div class="panel-body panel-body-table">
					<div class="table-responsive">
						<table class="table table-striped table-bordered text-center">
							<thead>
								<tr>
									<th>Name</th>
									<th>Food</th>
									<th>Title</th>
									<th>rating</th>
									<th>Status</th>
									<th>Created At</th>
									<th>Image</th>
									<th style="width:200px">Action</th>
								</tr>
							</thead>
							<tbody>
								@if($comments->count()>0)
								@foreach($comments as $data)
								<tr>
									<td>{{$data->user->name}}</td>
									<td><p class="btn btn-primary btn-sm">{{$data->food->title}}</p></td>
									<td>{{$data->title}}</td>
									<td>
										<span class="glyphicon glyphicon-star"></span>
										{{$data->rating}}
									</td>
									<td>
										<span class="btn @if($data->status == 'draft') btn-danger @else btn-success @endif btn-sm mt-10 mb-10"> {{$data->status}} </span>
									</td>
									<td>{{$data->created_at}}</td>
									<td>
										<div style="padding: 2px;" class="col-lg-4 col-md-4 col-sm-4 col-xs-6 gallery" id="links" href="#">
											@foreach($data->comments_role_media->take(3) as $val )
											@if(!empty($val->media->filename))
											<a class="gallery-item" href="{{url('/').'/media/originals/'.$val->media->filename}}" title="{{$val->media->filename}}" data-gallery>
												<img width="50" class="media-object img-text img-responsive" src="{{url('/media/thumbnail/').'/'.$val->media->filename}}" alt="">
											</a>
											@else
											<a class="gallery-item" href="{{url('/back_assets/img/no_image.jpg')}}" title="Image Not Found" data-gallery>
												<img width="50" class="media-object img-text img-responsive" src="{{url('/back_assets/img/no_image.jpg')}}" alt="Image Not Found">
											</a>
											@endif
											@endforeach
										</div>
									</td>
									<td>
										@if($data->status == 'draft')
										<span data-status="publish" data-id="{{$data->id}}" data-box="#mb-status" class="change-status btn btn-success btn-sm mt-10 mb-10">Publish</span>
										@else
										<span data-status="draft" data-id="{{$data->id}}" data-box="#mb-status" class="change-status btn btn-danger btn-sm mt-10 mb-10">Unpublish</span>
										@endif
										<span data-id="{{$data->id}}" class="view-comments btn btn-default btn-sm mt-10 mb-10">
											<i class="fa fa-eye"></i>
										</span>
										<button href="#" title="Delete" data-id="{{$data->id}}" data-box="#mb-delete" class="button-delete btn btn-sm btn-danger">
										<i class="fa fa-trash-o"></i>
										</button>
									</td>
								</tr>
								@endforeach
								@else
								<tr>
									<td colspan="6">
										<img class="img-responsive no-record" src="{{url('/back_assets/img/no-record-found.jpg')}}" alt="">
									</td>
								</tr>
								@endif
							</tbody>
						</table>
						<div class="col-md-12">
							{{$comments->links()}}
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
<div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="mb-delete">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-trash-o"></span>Delete Confirm!</div>
			<div class="mb-content">
				<p>Are you Sure delete this <b>data</b></p>
			</div>
			<div class="mb-footer">
				<form id="delete-comments" style="display:none;"  class="form-horizontal" action="" method="post" accept-charset="utf-8">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<input style="color:#000;" type="hidden" name="id" value="" id="delete-id"  />
				</form>
				<button onclick="event.preventDefault();
				document.getElementById('delete-comments').submit();"  class="btn btn-primary btn-lg pull-right mb-control-close">Yes</button>
				<button class="btn btn-default btn-lg pull-right mb-control-close">No</button>
			</div>
		</div>
	</div>
</div>
<div class="message-box message-box-warning animated fadeIn" data-sound="alert" id="mb-status">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-exclamation-triangle"></span>Status Update Confirm!</div>
			<div class="mb-content">
				<p>Are you sure change status this <b>comment</b></p>
			</div>
			<div class="mb-footer">
				<form id="status-comments" style="display:none;"  class="form-horizontal" action="" method="post" accept-charset="utf-8">
					{{ csrf_field() }}
					<input style="color:#000;" type="hidden" name="id" id="comment-id" />
					<input style="color:#000;" type="hidden" name="status" id="comment-status" />
				</form>
				<button onclick="event.preventDefault();
				document.getElementById('status-comments').submit();"  class="btn btn-primary btn-lg pull-right mb-control-close">Yes</button>
				<button class="btn btn-default btn-lg pull-right mb-control-close">No</button>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT WRAPPER -->
@include('back.modal.add_comments')
@include('back.modal.view_comments')
@stop
@push('scripts')
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/comments_index.min.js')}}"></script>
@endpush