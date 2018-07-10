@extends('back.yield.app')
@section('content')
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li class="active">Foods</li>
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
			<div class="col-md-12">
				<button id="add-foods" class="btn btn-lg btn-datatalk mbt10">New Foods</button>
			</div>
			<div style="display:block; overflow: hidden; margin-bottom: 20px;" class="col-md-12">
				<form  class="form-horizontal" action="{{url('/backadmin/foods')}}" method="get" accept-charset="utf-8">
					{{ csrf_field() }}
					<div class="col-md-10">
						<input style="color:#000;" type="text" class="form-control" placeholder="you can find with title or contributor name of foods data" name="keyword" value="@if(!empty($term)) {{$term}} @endif" />
					</div>
					<div class="col-md-2">
					<button type="submit" class="btn btn-md btn-primary">Search</button>
					</div>
				</form>
			</div>
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-body posts">
						<div class="row">
							@if($foods->count()>0)
							@foreach($foods as $data)
							<div class="col-md-6">
								<div class="post-item">
									<div style="min-height: 60px;" class="post-title">
										<a href="{{url('backadmin/foods/').'/'.$data->id}}">{{$data->title}}</a>
									</div>
									<div class="post-date"><span class="fa fa-calendar"></span> {{$data->created_at}} / <a href="pages-blog-post.html#comments">{{$data->count_comments($data->id)}} Comments</a> / <a href="pages-profile.html">{{$data->user->name}}</a></div>
									<div style="min-height: 665px;" class="post-text">
										<div class="relative">
											@if(!empty($data->media->filename))
											<img class="img-responsive img-text" style="width:100%;" src="{{url('/media/thumbnail/').'/'.$data->media->filename}}" alt="">
											@else
											<img class="img-responsive  img-text"  style="width:100%;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
											@endif
											<p class="genjer-rating absolute-rating">
												<i class="fa fa-star "></i>
												&nbsp {{$data->get_rating($data->id)['total_rating']}} /
												<span style="font-size: 15px">
													{{$data->get_rating($data->id)['total_comment']}}
												</span>
											</p>
										</div>
										@if(!empty($data->store->name))
										<p>Store : <i>{{$data->store->name}}</i></p>
										@else
										<p>Store : <i>Removed From Database</i></p>
										@endif
										<p>contributor : <i>{{$data->contributor}}</i></p>
										<p>
										Status Rekomended :
										@if($data->status_recomended == 0)
										<i>None</i>
										@else
										<i>Rekomended</i>
										@endif
										</p>
										<span class="btn btn-default btn-md mt-10 mb-10">Rp.{{number_format($data->price)}} </span>
										@foreach($data->food_role_categories as $val)
										@if(!empty($val->categories->name))
										<span class="btn btn-primary btn-md mt-10 mb-10"> {{$val->categories->name}} </span>
										@else
										<span class="btn btn-default btn-md mt-10 mb-10"><i>Category Removed</i></span>
										@endif
										@endforeach
										<p style="min-height: 120px;">{{$data->short_text}}</p>
									</div>
									<div class="post-row">
										<div class="post-info pull-right">
											<span class="btn @if($data->status == 'draft') btn-danger @else btn-success @endif btn-md mt-10 mb-10"> {{$data->status}} </span>
											&nbsp
											<button data-id="{{$data->id}}" class="edit-foods btn btn-sm btn-default">
											<i class="fa fa-pencil"></i>
											</button>
											<a href="{{url('backadmin/foods/').'/'.$data->id}}" class="btn btn-default btn-md ">Detail &RightArrow;</a>
											<button href="#" title="Delete" data-id="{{$data->id}}" data-box="#mb-delete" class="button-delete btn btn-sm btn-danger">
											<i class="fa fa-trash-o"></i>
											</button>
										</div>
									</div>
								</div>
							</div>
							@endforeach
							@else
							<div class="col-md-12">
								<img class="img-responsive no-record" src="{{url('/back_assets/img/no-record-found.jpg')}}" alt="">
							</div>
							@endif
						</div>
						<div class="col-md-12">
							{{$foods->links()}}
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-body">
						<h3>Latest 5 Comments</h3>
						<div class="links small">
							@if($comments->count()>0)
							<ul class="media-list">
								@foreach($comments as $komen)
								<li class="media">
									<div style="padding: 0;" class="col-md-2">
										@if(!empty($komen->user->avatar))
										<img class="media-object img-text img-responsive" style="width:100%;" src="{{url('/media/thumbnail/').'/'.$komen->user->avatar}}" alt="">
										@else
										<img class="media-object img-text img-responsive"  style="width:100%;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
										@endif
									</div>
									<div class="col-md-10">
										@if(!empty($komen->user->name))
										<h4 class="media-heading">{{$komen->user->name}}</h4>
										@else
										<h4 class="media-heading">Removed From Database</h4>
										@endif
										<h5 class="media-heading"><b>{{$komen->title}}</b></h5>
										<p>{{ str_limit($komen->text, 200)}}</p>
										<p class="text-muted">{{$komen->created_at}}</p>
										@if(!empty($komen->food->title))
										<p class="btn btn-primary btn-sm">{{$komen->food->title}}</p>
										@else
										<p class="btn btn-primary btn-sm">Removed From Database</p>
										@endif
										<span class="btn @if($komen->status == 'draft') btn-danger @else btn-success @endif btn-sm mt-10 mb-10"> {{$komen->status}} </span>
									</div>
									<!-- Media Comment -->
									<div class="media">
										@foreach($komen->comments_role_media as $val )
										@if(!empty($val->media->filename))
										<a style="width:33.33333%;" href="{{url('/').'/media/originals/'.$val->media->filename}}" title="{{$val->media->filename}}" data-gallery>
											<img class="media-object img-text img-responsive" style="width:100%;" src="{{url('/media/thumbnail/').'/'.$val->media->filename}}" alt="">
										</a>
										@else
										<a style="width:33.33333%;" href="{{url('/back_assets/img/no_image.jpg')}}" title="Image Not Found" data-gallery>
											<img class="media-object img-text img-responsive" style="width:100%;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="Image Not Found">
										</a>
										@endif
										@endforeach
									</div>
									<!-- ./Media Comment -->
								</li>
								@endforeach
							</ul>
							<div class="col-md-12">
								<a href="{{url('backadmin/comments/')}}" class="btn btn-default btn-md ">Show All</a>
							</div>
							@else
							<div class="col-md-12">
								<img class="img-responsive no-record" src="{{url('/back_assets/img/no-record-found.jpg')}}" alt="">
							</div>
							@endif
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
				<form id="delete-foods" style="display:block;"  class="form-horizontal" action="" method="post" accept-charset="utf-8">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<input style="color:#000;" type="hidden" name="id" value="" id="delete-id"  />
				</form>
				<button onclick="event.preventDefault();
				document.getElementById('delete-foods').submit();"   class="btn btn-primary btn-lg pull-right mb-control-close">Yes</button>
				<button class="btn btn-default btn-lg pull-right mb-control-close">No</button>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT WRAPPER -->
@include('back.modal.add_foods')
@include('back.modal.edit_foods')
@include('back.modal._list_media')
@stop
@push('scripts')
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/foods_index.min.js')}}"></script>
@endpush