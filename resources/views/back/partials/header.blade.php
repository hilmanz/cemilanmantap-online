<!-- START PAGE SIDEBAR -->
<div class="page-sidebar">
	<!-- START X-NAVIGATION -->
	<ul class="x-navigation">
		<li class="xn-logo">
			<a style=" padding:0;" href="{{url('/backadmin/dashboard')}}">
				<img style="height: 100%;" src="{{url('/back_assets')}}/img/cemilanmantap/img/logo-cemilanmantap.png" alt="DataTalk">
			</a>
			<a href="#" class="x-navigation-control"></a>
		</li>
		<li class="xn-profile">
			<a style="background:#fff;" href="#" class="profile-mini">
				<img src="{{url('/back_assets')}}/img/cemilanmantap/icons/icon.png" alt="Cemilan Mantap"/>
			</a>
			<div class="profile">
				<div class="profile-data">
					<div class="profile-data-name">{{Sentinel::getUser()->name}}</div>
					<div class="profile-data-title">{{Sentinel::getUser()->email}}</div>
				</div>
			</div>
		</li>
		<li class="xn-title">Navigation</li>
		@if (Sentinel::hasAnyAccess(['dashboard']))
		<li class="@if( Request::segment(2) === null or Request::segment(2) === 'dashboard') active @endif">
			<a href="{{url('/backadmin/dashboard')}}"><span class="fa fa-desktop"></span> <span class="xn-text">Dashboard</span></a>
		</li>
		@endif
		<li class="xn-openable
			@if(Request::segment(2) === 'categories' or
			Request::segment(2) === 'categories-abjad')
			active
			@endif">
			<a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Categories</span></a>
			<ul>
				@if (Sentinel::hasAnyAccess(['categories']))
				<li class="@if(Request::segment(2) === 'categories') active @endif">
					<a href="{{url('/backadmin/categories')}}"><span class="fa fa-circle-o"></span> <span class="xn-text">Food Categories</span></a>
				</li>
				@endif
				@if (Sentinel::hasAnyAccess(['categories_abjad']))
				<li class="@if(Request::segment(2) === 'categories-abjad') active @endif"><a href="{{url('/backadmin/categories-abjad')}}"><span class="fa fa-circle"></span> Abjad Categories</a></li>
				@endif
			</ul>
		</li>
		@if (Sentinel::hasAnyAccess(['stores']))
		<li class="@if(Request::segment(2) === 'stores') active @endif">
			<a href="{{url('/backadmin/stores')}}"><span class="fa fa-building"></span> <span class="xn-text">Stores</span></a>
		</li>
		@endif
		@if (Sentinel::hasAnyAccess(['referensiCemilan']))
		<li class="@if(Request::segment(2) === 'referensi-cemilan') active @endif">
			<a href="{{url('/backadmin/referensi-cemilan')}}"><span class="fa fa-circle"></span> <span class="xn-text">Referensi Cemilan</span></a>
		</li>
		@endif
		@if (Sentinel::hasAnyAccess(['mediaLibrary']))
		<li class="@if(Request::segment(2) === 'media') active @endif">
			<a href="{{url('/backadmin/media')}}"><span class="fa fa-image"></span> <span class="xn-text">Media Library</span></a>
		</li>
		@endif
		@if (Sentinel::hasAnyAccess(['subscribers']))
		<li class="@if(Request::segment(2) === 'subscribers') active @endif">
			<a href="{{url('/backadmin/subscribers')}}">
				<span class="fa fa-envelope"></span>
				<span class="xn-text">Subscribers</span>
			</a>
		</li>
		@endif
		@if (Sentinel::hasAnyAccess(['comments']))
		<li class="@if(Request::segment(2) === 'comments') active @endif">
			<a href="{{url('/backadmin/comments')}}">
				<span class="fa fa-comments"></span>
				<span class="xn-text">Comments</span>
			</a>
		</li>
		@endif
		<li class="xn-openable
			@if(Request::segment(2) === 'home-sliders' or
			Request::segment(2) === 'videos' or
			Request::segment(2) === 'foods')
			active
			@endif">
			<a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Pages</span></a>
			<ul>
				@if (Sentinel::hasAnyAccess(['homeSliders']))
				<li class="@if(Request::segment(2) === 'home-sliders') active @endif"><a href="{{url('/backadmin/home-sliders')}}"><span class="fa fa-circle"></span> Home Sliders</a></li>
				@endif
				@if (Sentinel::hasAnyAccess(['videos']))
				<li class="@if(Request::segment(2) === 'videos') active @endif"><a href="{{url('/backadmin/videos')}}"><span class="fa fa-circle"></span> Videos</a></li>
				@endif
				@if (Sentinel::hasAnyAccess(['foods']))
				<li class="@if(Request::segment(2) === 'foods') active @endif"><a href="{{url('/backadmin/foods')}}"><span class="fa fa-circle"></span> Foods</a></li>
				@endif
			</ul>
		</li>
		<li class="xn-openable
			@if(Request::segment(2) === 'reports-reviewers' or
			Request::segment(2) === 'reports-contributors')
			active
			@endif">
			<a href="#"><span class="fa fa-print"></span> <span class="xn-text">Reports</span></a>
			<ul>
				@if (Sentinel::hasAnyAccess(['reports']))
				<li class="@if(Request::segment(2) === 'reports-reviewers') active @endif"><a href="{{url('/backadmin/reports-reviewers')}}"><span class="fa fa-circle"></span> Submit Review</a></li>
				<li class="@if(Request::segment(2) === 'reports-contributors') active @endif"><a href="{{url('/backadmin/reports-contributors')}}"><span class="fa fa-circle"></span> Foods Uploaded</a></li>
				@endif
			</ul>
		</li>
		@if (Sentinel::hasAnyAccess(['roles']) || Sentinel::hasAnyAccess(['users']))
		<li class="xn-title">Settings</li>
		<li class="xn-openable
			@if(Request::segment(2) === 'instagram-feed' or
			Request::segment(2) === 'roles' or
			Request::segment(2) === 'users')
			active
			@endif">
			<a href="#"><span class="fa fa-cogs"></span> <span class="xn-text">Settings</span></a>
			<ul>
				@if (Sentinel::hasAnyAccess(['roles']))
				<li class="@if(Request::segment(2) === 'roles') active @endif">
					<a href="{{url('/backadmin/roles')}}"><span class="fa fa-circle"></span> Roles</a>
				</li>
				@endif
				@if (Sentinel::hasAnyAccess(['users']))
				<li class="@if(Request::segment(2) === 'users') active @endif">
					<a href="{{url('/backadmin/users')}}"><span class="fa fa-users"></span> Users</a>
				</li>
				@endif
			</ul>
		</li>
		@endif
		<li class="xn-title">Cemilan Mantap CMS <br> version 1.0 </li>
	</ul>
	<!-- END X-NAVIGATION -->
</div>
<!-- END PAGE SIDEBAR -->