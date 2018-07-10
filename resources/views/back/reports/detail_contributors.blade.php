@extends('back.yield.app')
@section('content')
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li><a href="{{url('/backadmin/reports-contributors')}}">Reports</a></li>
	<li>Food Uploaded</li>
	<li class="active">{{$user_id}}</li>
</ul>
<!-- END BREADCRUMB -->
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title-box">
						<h3>Detail Comment Reviewers</h3>
					</div>
				</div>
				<div style="margin:20px 0;" class="col-md-12 filter">
					<form action="{{url('backadmin/print-contributors-detail')}}" method="post" class="form-horizontal" role="form">
						{{csrf_field()}}
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-2 label-control">Date From</label>
									<div class="col-md-10 input-group date"  id='datetimepicker1'>
										<input type='text' id="date_from" value="{{date('Y-m-d')}}" name="date_from" class="form-control" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="col-md-2 label-control">Date Until</label>
									<div class="col-md-10 input-group date"  id='datetimepicker2'>
										<input type='text' id="date_until" value="{{date('Y-m-d')}}" name="date_until" class="form-control" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
						</div>
						<input type="hidden" name="user_id" value="{{$user_id}}">
						<div style="margin-top: 20px;" class="col-md-2 no-padding pull-right">
							<div class="form-group">
								<div class="col-md-10">
									<button style="background:#02723b; border: 1px solid #02723b;" class="btn btn-md btn-primary btn-block pull-right" type="submit"><i class="fa fa-file-excel-o"></i>Export Data</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="panel-body panel-body-table">
					@if($user_foods->count()>0)
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Food Title</th>
									<th>Status</th>
									<th>Created At</th>
								</tr>
							</thead>
							<tbody>
								@foreach($user_foods as $row)
								<tr>
									<td>{{$row->title}}</td>
									<td>{{$row->status}}</td>
									<td>{{$row->created_at}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@else
					<img class="img-responsive no-record" src="{{url('/back_assets/img/no-record-found.jpg')}}" alt="">
					@endif
				</div>
				<div class="col-md-12">
					{{$user_foods->links()}}
				</div>
			</div>
			<!-- END PROJECTS BLOCK -->
		</div>
	</div>
	<!-- END PAGE CONTENT WRAPPER -->
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
	@stop
	@push('scripts')
	<script src='{{url('/back_assets/js/plugins/chartjs/chartjs.min.js')}}'></script>
	<script>
	$(function(){
		$('#datetimepicker1').datetimepicker({
			format: 'YYYY-MM-DD'
		});
		$('#datetimepicker2').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
	</script>
	@endpush