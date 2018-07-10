@extends('back.yield.app')
@section('content')
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li class="active">Dashboard</li>
</ul>
<!-- END BREADCRUMB -->
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<!-- START WIDGETS -->
	<div class="row">
		<div class="col-md-3">
			<!-- START WIDGET CLOCK -->
			<div class="widget widget-info widget-padding-sm">
				<div class="widget-big-int plugin-clock">00:00</div>
				<div class="widget-subtitle plugin-date">Loading...</div>
				<div class="widget-controls">
					<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
				</div>
			</div>
			<!-- END WIDGET CLOCK -->
		</div>
		<div class="col-md-3">
			<!-- START WIDGET MESSAGES -->
			<div class="widget widget-default widget-item-icon" >
				<div class="widget-item-left">
					<span class="fa fa-envelope"></span>
				</div>
				<div class="widget-data">
					<div class="widget-int num-count">{{$count_subscribers}}</div>
					<div class="widget-title">New Subsribers</div>
					<div class="widget-subtitle">In your database</div>
				</div>
			</div>
			<!-- END WIDGET MESSAGES -->
		</div>
		<div class="col-md-3">
			<!-- START WIDGET REGISTRED -->
			<div class="widget widget-default widget-item-icon" >
				<div class="widget-item-left">
					<span class="fa fa-user"></span>
				</div>
				<div class="widget-data">
					<div class="widget-int num-count">{{$count_users}}</div>
					<div class="widget-title">Registred users</div>
					<div class="widget-subtitle">On your database</div>
				</div>
			</div>
			<!-- END WIDGET REGISTRED -->
		</div>
		<div class="col-md-3">
			<!-- START WIDGET REGISTRED -->
			<div class="widget widget-default widget-item-icon" >
				<div class="widget-item-left">
					<span class="fa fa-image"></span>
				</div>
				<div class="widget-data">
					<div class="widget-int num-count">{{$count_media_image}}</div>
					<div class="widget-title">Images</div>
					<div class="widget-subtitle">On your database</div>
				</div>
			</div>
			<!-- END WIDGET REGISTRED -->
		</div>
		<div class="col-md-3">
			<!-- START WIDGET REGISTRED -->
			<div class="widget widget-default widget-item-icon" >
				<div class="widget-item-left">
					<span class="fa fa-film"></span>
				</div>
				<div class="widget-data">
					<div class="widget-int num-count">{{$count_media_video}}</div>
					<div class="widget-title">Videos</div>
					<div class="widget-subtitle">On your database</div>
				</div>
			</div>
			<!-- END WIDGET REGISTRED -->
		</div>
		<div class="col-md-3">
			<!-- START WIDGET REGISTRED -->
			<div class="widget widget-default widget-item-icon" >
				<div class="widget-item-left">
					<span class="fa fa-cutlery"></span>
				</div>
				<div class="widget-data">
					<div class="widget-int num-count">{{$count_foods}}</div>
					<div class="widget-title">Foods</div>
					<div class="widget-subtitle">On your database</div>
				</div>
			</div>
			<!-- END WIDGET REGISTRED -->
		</div>
		<div class="col-md-6">
			<!-- START WIDGET REGISTRED -->
			<div class="widget widget-default widget-item-icon bg-red" >
				<div class="widget-item-left">
					<span class="fa fa-lemon-o"></span>
				</div>
				<div class="widget-data">
					<div class="widget-int num-count">{{$count_categories_foods}}</div>
					<div class="widget-title">Foods Categories</div>
					<div class="widget-subtitle color-white">On your database</div>
				</div>
			</div>
			<!-- END WIDGET REGISTRED -->
		</div>
	</div>
	<!-- END WIDGETS -->
	<div class="row">
		<div class="col-md-12 mar-top-20">
			<h3>Top 5 Rating</h3>
			<canvas style="width:100%;" id="toprating" height="50"></canvas>
		</div>
		<div class="col-md-12 mar-top-20">
			<h3>Top 5 Tranding Topic</h3>
			<canvas style="width:100%;" id="toptrandingtopic" height="50"></canvas>
		</div>
		<div class="col-md-12 mar-top-20">
			<h3>Top 5 Reviewers</h3>
			<canvas style="width:100%;" id="topreviewer" height="50"></canvas>
		</div>
		<div class="col-md-6">
			<!-- START PROJECTS BLOCK -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title-box">
						<h3>Latest Food</h3>
						<span>10 last Foods Uploaded</span>
					</div>
					<ul class="panel-controls" style="margin-top: 2px;">
						<li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
					</ul>
				</div>
				<div class="panel-body panel-body-table">
					@if($foods->count()>0)
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="50%">Title</th>
									<th width="50%">Category</th>
									<th width="20%">Status</th>
									<th width="30%">Created At</th>
									<th width="30%">Created By</th>
								</tr>
							</thead>
							<tbody>
								@foreach($foods as $row)
								<tr>
									<td><strong>{{$row->title}}</strong></td>
									<td>
										@foreach($row->food_role_categories as $val)
										@if(!empty($val->categories->name))
										<span class="badge">{{$val->categories->name}}</span>
										@endif
										@endforeach
									</td>
									<td><span class="badge">{{$row->status}}</span></td>
									<td>{{$row->created_at}}</td>
									<td>{{$row->user->username}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@else
					<img class="img-responsive no-record" src="{{url('/back_assets/img/no-record-found.jpg')}}" alt="">
					@endif
				</div>
			</div>
			<!-- END PROJECTS BLOCK -->
		</div>
		<div class="col-md-6">
			<!-- START PROJECTS BLOCK -->
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title-box">
						<h3>Categories</h3>
						<span>10 last Foods Category</span>
					</div>
					<ul class="panel-controls" style="margin-top: 2px;">
						<li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
					</ul>
				</div>
				<div class="panel-body panel-body-table">
					@if($food_categories->count()>0)
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="50%">Name</th>
									<th width="20%">Status</th>
									<th width="30%">Created At</th>
									<th width="30%">Created By</th>
								</tr>
							</thead>
							<tbody>
								@foreach($food_categories as $data)
								<tr>
									<td>{{$data->name}}</td>
									<td><span class="badge">{{$data->status}}</span></td>
									<td>{{$data->created_at}}</td>
									<td>{{$data->user->name}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@else
					<img class="img-responsive no-record" src="{{url('/back_assets/img/no-record-found.jpg')}}" alt="">
					@endif
				</div>
			</div>
			<!-- END PROJECTS BLOCK -->
		</div>
	</div>
</div>
<!-- END PAGE CONTENT WRAPPER -->
@stop
@push('scripts')
<script src='{{url('/back_assets/js/plugins/chartjs/chartjs.min.js')}}'></script>
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/dashboard_index.min.js')}}"></script>
@endpush