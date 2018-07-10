<ul class="col-md-12">
	@foreach($location as $data)
	<li data-main_text="{{$data['main_text']}}" data-description="{{$data['description']}}" data-place_id="{{$data['place_id']}}">
		<div class="col-md-12 wrap">
			<p class="main-text">
				<i class="fa fa-map-marker"></i>
				<b>{{$data['main_text']}}</b>
				<span class="description">{{$data['description']}}</span>
			</p>
		</div>
	</li>
	@endforeach
</ul>