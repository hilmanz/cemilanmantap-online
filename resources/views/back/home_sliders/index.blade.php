@extends('back.yield.app')
@section('content')
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li class="active">Home Slider</li>
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
					<button id="add-slider" class="btn btn-lg btn-datatalk mbt10">New Home Slider</button>
				</div>
				<div class="panel-body panel-body-table">
					<div class="table-responsive">
						<table class="table table-striped table-bordered text-center">
							<thead>
								<tr>
									<th>Desktop Image</th>
									<th>Mobile Image</th>
									<th>Name</th>
									<th>status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@if($home_sliders->count()>0)
								@foreach($home_sliders as $data)
								<tr>
									<td>
									@if(!empty($data->media->filename))
									<img style="width:100px;" src="{{url('/media/originals/').'/'.$data->media->filename}}" alt="">
									@else
									<img style="width:100px;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
									@endif
									</td>
									<td>
									@if(!empty($data->mobile_media->filename))
									<img style="width:100px;" src="{{url('/media/originals/').'/'.$data->mobile_media->filename}}" alt="">
									@else
									<img style="width:100px;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
									@endif
									</td>
									<td>{{$data->name}}</td>
									<td><span class="badge">{{$data->status}}</span></td>
									<td>
										<button data-id="{{$data->id}}" class="edit-slider btn btn-sm btn-default">
										<i class="fa fa-pencil"></i>
										</button>
										<button href="#" title="Delete" data-id="{{$data->id}}" data-box="#mb-delete" class="button-delete btn btn-sm btn-danger">
										<i class="fa fa-trash-o"></i>
										</button>
									</td>
								</tr>
								@endforeach
								@else
								<tr>
									<td colspan="5">
										<img class="img-responsive no-record" src="{{url('/back_assets/img/no-record-found.jpg')}}" alt="">
									</td>
								</tr>
								@endif
							</tbody>
						</table>
						<div class="col-md-12">
							{{$home_sliders->links()}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="mb-delete">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-trash-o"></span>Delete Confirm!</div>
			<div class="mb-content">
				<p>Are you Sure delete this <b>data</b></p>
			</div>
			<div class="mb-footer">
				<form id="delete-home-sliders" style="display:block;"  class="form-horizontal" action="" method="post" accept-charset="utf-8">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<input style="color:#000;" type="hidden" name="id" value="" id="delete-id"  />
				</form>
				<button onclick="event.preventDefault();
				document.getElementById('delete-home-sliders').submit();"  class="btn btn-primary btn-lg pull-right mb-control-close">Yes</button>
				<button class="btn btn-default btn-lg pull-right mb-control-close">No</button>
			</div>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT WRAPPER -->
@include('back.modal.add_home_slider')
@include('back.modal.edit_home_slider')
@include('back.modal._list_media')
@stop
@push('scripts')
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/home_sliders_index.min.js')}}"></script>
@endpush