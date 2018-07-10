<div class="profile-card-frame">
	<div class="profile-card-center">
		<div class="profile-card-mobile">
			<div class="profile-card-image">
				<div class="circle-1"></div>
				<div class="circle-2"></div>
				@if(Sentinel::getUser()->avatar == null)
				<img src="{{url('/front_assets')}}/user_default.jpeg" width="70" height="70" alt="{{Sentinel::getUser()->name}}">
				@else
				<img onerror="imgError(this);"  src="{{Sentinel::getUser()->avatar}}" width="70" height="70" alt="{{Sentinel::getUser()->name}}">
				@endif
			</div>
			<div class="profile-card-name">{{Sentinel::getUser()->name}}</div>
		</div>
		<div class="profile-card-stats">
			<div class="profile-card-box">
				<span class="profile-card-box-value">Total Review</span>
				<span class="profile-card-box-parameter">{{$total_comment}}</span>
			</div>
		</div>
		<div class="profile-card-actions">
			<a href="{{url('/#tambah-referensi')}}" class="profile-card-btn add-cem">Add Cemilan</a>
			<a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"   class="profile-card-btn logmeout">Log Out</a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
		</div>
	</div>
</div>