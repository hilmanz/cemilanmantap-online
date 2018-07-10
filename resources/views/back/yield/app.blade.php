<!DOCTYPE html>
<html lang="en">
	@include('back.partials.head')
	<body>
		<!-- START PAGE CONTAINER -->
		<div class="page-container">
			@include('back.partials.header')
			<!-- PAGE CONTENT -->
			<div class="page-content">
				@include('back.partials.nav_top')
				@yield('content')
			</div>
			<!-- END PAGE CONTENT -->
		</div>
		<!-- END PAGE CONTAINER -->
		@include('back.partials.footer')
		@include('back.partials.js')
		@stack('scripts')
		<script>
			function imgError(image) {
				image.onerror = "";
				image.src = "{{url('/back_assets/img/')}}/no_image.jpg";
				return true;
			}
		</script>
	</body>
</html>