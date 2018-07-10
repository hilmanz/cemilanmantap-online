@extends('back.yield.app')
@section('content')
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li><a href="{{url('/backadmin/users')}}">Users</a></li>
	<li class="active">Add</li>
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
				<div style="padding:20px;" class="col-md-12">
					<div class="panel-body panel-body-table">
						<form id="form-add-users" action="{{url('/backadmin/users/')}}" method="POST" class="form-horizontal" role="form">
							{{csrf_field()}}
							{!! method_field('POST') !!}
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
							<div class="col-md-12 mb-20 mt-20">
								<div class="form-group pilih-roles">
									<label class="col-md-2 control-label">Roles</label>
									<div class="col-md-10">
										<select style="width: 100%;" id="roles-select" name="role_id" class=" roles-select form-control" >
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Name</label>
									<div class="col-md-10">
										<input type="text" class="form-control" placeholder="Name" name="name"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Email</label>
									<div class="col-md-10">
										<input type="email" class="form-control" placeholder="Email" name="email"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Username</label>
									<div class="col-md-10">
										<input type="text" class="form-control" placeholder="Username" name="username"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Password</label>
									<div class="col-md-10">
										<input type="password" class="form-control" placeholder="Password" name="password"  value=""/>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">Password Confirmation</label>
									<div class="col-md-10">
										<input type="password" class="form-control" placeholder="Password Confirmation" name="password_confirmation"  value=""/>
									</div>
								</div>
								<div class="form-group pilih-roles">
									<label class="col-md-2 control-label">Status</label>
									<div class="col-md-10">
										<select style="width: 100%;" id="status-select" name="status" class=" status-select form-control" >
										<option value="1">Active</option>
										<option value="2">Disabled</option>
										</select>
									</div>
								</div>
								<div class="form-group pad-20-t">
									<div class="col-md-12">
										<label class="col-md-3 control-label"></label>
										<p class="text-right">
											<button type="submit" class="submit btn btn-primary bg-cokelat">Save Changes</button>
										</p>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT WRAPPER -->
	@stop
	@push('scripts')

<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/roles_select2.min.js')}}"></script>
	@endpush