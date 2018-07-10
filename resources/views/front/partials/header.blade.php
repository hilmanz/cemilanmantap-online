<header class="stay-top
@if(Request::segment(1) === 'videos' or
	Request::segment(1) === 'search-location' or
	Request::segment(1) === 'category' and Request::segment(2) != null and Request::segment(3) != null or
	Request::segment(1) === 'food' and Request::segment(2) != null)
	colored-bkg
@endif">
	<div class="header-wrapper">
		<a id="logo" class="logo-mobile" href="{{url('/')}}"><img alt="Cemilan Mantap" src="{{url('/front_assets')}}/assets/img/logo-cemilanmantap2018.png"></a>
		<div class="hamburger-icon">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
	<div class="navigation-wrapper">
		<nav>
			<a id="logo"  class="logo-desktop"  href="{{url('/')}}"><img alt="Cemilan Mantap" src="{{url('/front_assets')}}/assets/img/logo-cemilanmantap2018.png"></a>
			<ul>
				<li id="user-info-mobile" class="profile-card-logged-nav"></li>
				<li class="@if(Request::segment(1) === null or Request::segment(1) === 'home') active @endif">
					<a href="{{url('/')}}">
						Home
					</a>
				</li>
				<li class="@if(Request::segment(1) === 'videos') active @endif">
					<a href="{{url('/videos')}}">
						Video
					</a>
				</li>
				<li class="@if(Request::segment(1) === 'tentang-cemilan') active @endif">
					<a href="{{url('/tentang-cemilan')}}">
						Tentang Cemilan
					</a>
				</li>
				@if(!Sentinel::check())
				<li>
					<a class="login has-dropdown" href="{{url('/login/auth/facebook')}}">
						Login
					</a>
					<ul>
						<li class="sub-menu-title">LOGIN<li>
						<li>
						<a href="{{url('/login/auth/facebook')}}" class="btn btn-small btn-facebook"></a>
						</li>
					</ul>
				</li>
				@endif
				<li class="social-list">
					<!-- <hr> -->
					<a><i class="fa fa-envelope"></i></a>
					<a><i class="fa fa-facebook"></i></a>
					<a><i class="fa fa-twitter"></i></a>
					<a><i class="fa fa-instagram"></i></a>
				</li>
				@if(Sentinel::check())
				<li id="user-info" class="user-logged-in"></li>
				@endif
				</ul>
			</nav>
		</div>
	</header>