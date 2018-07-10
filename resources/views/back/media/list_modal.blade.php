@if($media->count()>0)
<div id="choose-image-radio" class="gallery" >
	@foreach($media as $value)
	<label id="{{$value->id}}" class="gallery-item" title="{{$value->name}}" >
		<div class="image">
			@if($value->filename)
			<img onerror="imgError(this);" src="{{url('/').'/media/thumbnail/'.$value->filename}}" alt="{{$value->name}}"/>
			@else
			<img onerror="imgError(this);" src="{{url('/back_assets/img/')}}/no_image.jpg" alt="No Image"/>
			@endif
			@if($value->type =='video')
			<span><img class="icon-video" src="{{url('/back_assets/img/')}}/icon_video.png" alt=""></span>
			@endif
			<ul class="gallery-item-controls">
				<li>
					<label class="check">
						<input type="radio" for="{{$value->id}}" value="{{$value->id}}" name="media_id[]" class="icheckbox check-row"/>
					</label>
				</li>
			</ul>
		</div>
		<div class="meta">
			<strong>{{$value->name}}</strong>
		</div>
	</label>
	@endforeach
</div>
<div class="col-md-12 ajax">
	{{$media->links()}}
</div>
@else
<p style="padding:20px;" class="text-center"><b>No Data Record</b></p>
@endif
<div class="form-group">
	<label class="col-md-3 control-label"></label>
	<p class="text-right">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	</p>
</div>
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/media_list_modal.min.js')}}"></script>