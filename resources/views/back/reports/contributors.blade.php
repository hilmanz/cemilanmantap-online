@extends('back.yield.app')
@section('content')
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li><a href="#">Reports</a></li>
	<li class="active">Food Uploaded</li>
</ul>
<!-- END BREADCRUMB -->
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<div class="row">
		<div class="col-md-12">
			<!-- START PROJECTS BLOCK -->
			<div style="margin:20px 0;" class="col-md-12 filter">
				<form action="{{url('backadmin/print-contributors')}}" method="post" class="form-horizontal" role="form">
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
					<div style="margin-top: 20px;" class="col-md-2 no-padding pull-right">
						<div class="form-group">
							<div class="col-md-10">
								<button style="background:#02723b; border: 1px solid #02723b;" class="btn btn-md btn-primary btn-block pull-right" type="submit"><i class="fa fa-file-excel-o"></i>Export Data</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-title-box">
						<h3>Contributors</h3>
					</div>
				</div>
				<div class="panel-body panel-body-table">
					@if($contributors->count()>0)
					<div class="table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th>Total Foods Uploaded</th>
									<th>Status</th>
									<th>Role</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($contributors as $row)
								<tr>
									<td><strong>{{$row->user->name}}</strong></td>
									<td><span class="badge">{{$row->count}}</span></td>
									<td>@if($row->user->status == 1) active @else disabled @endif</td>
									<td>{{$row->user->role_user->roles->name}}</td>
									<td>
										<a href="{{url('/backadmin/reports-contributors/').'/'.$row->user->id}}">
											<i class="fa fa-eye btn btn-primary"></i>
										</a>
									</td>
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
					{{$contributors->links()}}
				</div>
			</div>
			<!-- END PROJECTS BLOCK -->
		</div>
	</div>
	<!-- END PAGE CONTENT WRAPPER -->
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