@if($photos->count()>0)
@foreach($photos as $val)
<div style="width:50%; float:left;">
	<div class="relative">
		@if(!empty($val->media->filename))
		<a class="gallery-item" href="{{url('/').'/media/originals/'.$val->media->filename}}" title="{{$val->media->filename}}" data-gallery>
			<img style="width:100%;" src="{{url('/media/thumbnail/').'/'.$val->media->filename}}" alt="">
		</a>
		@else
		<a class="gallery-item" href="{{url('/back_assets/img/no_image.jpg')}}" title="Image Not Found" data-gallery>
			<img style="width:100%;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
		</a>
		@endif
		<div style="height:auto;" class="absolute">
			<div style="cursor: pointer;margin-top: 5px;" class="delete-photos" data-id="{{$val->id}}" data-box="#photos-delete">
				<span>
					&nbsp <i class="fa fa-times color-white cursor-pointer"></i>
				</span>
			</div>
		</div>
	</div>
</div>
@endforeach
<div class="col-md-12 photos-ajax">
	{{$photos->links()}}
</div>
@else
<div class="col-md-12">
	<p style="padding:20px;" class="text-center">
		<b>
		<img class="img-responsive no-record" src="{{url('/back_assets/img/no-record-found.jpg')}}" alt="">
		</b>
	</p>
</div>
@endif