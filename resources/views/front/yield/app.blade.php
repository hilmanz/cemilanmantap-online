<!DOCTYPE html>
<html>
	@include('front.partials.head')
	<body  @if(Request::segment(1) === 'add-cemilan') class="layout-empty" @endif>
		@include('front.partials.header')
		<div class="page-wrapper
		@if(Request::segment(1) === 'videos' or
		Request::segment(1) === 'search-location' or
		Request::segment(1) === 'add-cemilan' or
		Request::segment(1) === 'category' and Request::segment(2) != null and Request::segment(3) != null or
		Request::segment(1) === 'food' and Request::segment(2) != null
		)
		@else
			idx
		@endif">
			@yield('content')
			@include('front.partials.footer')
		</div>
		@include('front.partials.js')
		@stack('scripts')
		<!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-99578766-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-99578766-1');
        </script>

		<script>
			function imgError(image) {
		        var url = window.location.origin;
		        image.onerror = "";
		        image.src = url+"/front_assets/user_default.jpeg";
		        return true;
		    }
		</script>
	</body>
</html>