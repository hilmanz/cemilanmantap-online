<div class="nav nav-pills secondary">
	<div class="nav-item user-avatar-wrapper">
		@if(Sentinel::getUser()->avatar == null)
		<a href="#" class="nav-link circle user-avatar-image" style="background-image: url('{{url('/front_assets')}}/user_default.jpeg'"></a>
		@else
		<a href="#" class="nav-link circle user-avatar-image" style="background-image: url('{{Sentinel::getUser()->avatar}}"></a>
		@endif
		<span class="user-avatar-name">{{str_limit(Sentinel::getUser()->name, 18)}}</span>
		{{-- <span class="user-avatar-status"></span> --}}
		<ul class="header-more-menu">
			<div class="user-logged-in-wrapper">
				<div class="user-logged-in-profile">
					<div class="user-logged-in-image">
						<div class="user-logged-in-circle-1"></div>
						<div class="user-logged-in-circle-2"></div>
						@if(Sentinel::getUser()->avatar == null)
						<img src="{{url('/front_assets')}}/user_default.jpeg" width="70" height="70" alt="{{Sentinel::getUser()->name}}">
						@else
						<img onerror="imgError(this);"  src="{{Sentinel::getUser()->avatar}}" width="70" height="70" alt="{{Sentinel::getUser()->name}}">
						@endif
					</div>
					<div class="user-logged-in-name">{{Sentinel::getUser()->name}}</div>
					<div class="user-logged-in-stats">
						<div class="user-logged-in-review">Total Review <span>{{$total_comment}}</span></div>
					</div>
					<div class="user-logged-in-actions">
						<a class="user-logged-in-btn tambah" href="{{url('/#tambah-referensi')}}">Add Cemilan</a>
						<a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  class="user-logged-in-btn keluar" href="#">Log Out</a>
	                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
	                        {{ csrf_field() }}
	                    </form>
					</div>
				</div>
			</div>
		</ul>
	</div>
</div>