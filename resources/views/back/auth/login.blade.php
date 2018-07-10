<!DOCTYPE html>
<html lang="en" class="body-full-height">
	<head>
		<!-- META SECTION -->
		<title>Admin Cemilan Mantap</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="{{url('/back_assets')}}/img/cemilanmantap/icons/icon.png" type="image/x-icon" />
		<!-- END META SECTION -->
		<!-- CSS INCLUDE -->
		<link rel="stylesheet" type="text/css" id="theme" href="{{url('/back_assets')}}/css/theme-default.css"/>
		<!-- EOF CSS INCLUDE -->
	</head>
	<body>
		<div class="login-container">
			<div class="login-box animated fadeInDown">
				<a href="{{url('/')}}">
					<div class="login-logo"></div>
				</a>
				<div class="login-body">
					<div class="login-title"><strong>Welcome</strong>, Please login</div>
					<form action="{{url('login')}}" method="post" id="form-login" class="form-horizontal">
						{{csrf_field()}}
						<div class="form-group">
							<div class="col-md-12 text-center">
								@if ($message = Session::get('success'))
								<div class="alert alert-success alert-block">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<p>{{ $message }}</p>
								</div>
								@endif
								@if($message = Session::get('error'))
								<div class="alert alert-danger alert-block eror">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<p>{{ $message }}</p>
								</div>
								@endif
								@if($message = Session::get('error_activate'))
								<div class="alert alert-danger alert-block eror">
									<p>Your Account Is Not Active!. Check Your Mail Box For Activations Or Resend Code Token For Activate  <br><a style="color:#fff; font-weight: 800;" href="{{ url('/re_send_activation').'/'.$message}}">Klik here</a>
								</p>
							</div>
							@endif
							@if(count($errors)>0)
							<div class="alert alert-danger eror text-left">
								<ul>
									@foreach($errors->all() as $error)
									<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
							@endif
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<input type="text" class="form-control" placeholder="Username Or Email" name="email_username" value="{{ old('email_username') }}" placeholder="">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<input type="password" class="form-control" placeholder="Password" name="password"/>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6">
							<a href="#" class="btn btn-link btn-block">Forgot your password?</a>
						</div>
						<div class="col-md-6">
							<button class="btn btn-info btn-block">Log In</button>
						</div>
					</div>
				</form>
			</div>
			<div class="login-footer">
				<div class="pull-left">
					&copy; {{date('Y')}} Cemilan Mantap CMS
				</div>
				<div class="pull-right">
					<a target="_blank" href="https://www.genjer.com">About</a> |
					<a target="_blank" href="https://www.genjer.com">Privacy</a> |
					<a target="_blank" href="https://www.genjer.com">Contact Us</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>