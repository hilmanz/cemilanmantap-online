@if($photos_comments->count()>0)
<div class="post-thumbnail-wrapper reviewer">
	@foreach($photos_comments as $val)
	<span class="post-image-thumbnail">
		@if(!empty($val->media->filename))
	    <a class="fancybox-photos-comments" href="{{url('/media/originals/').'/'.$val->media->filename}}" data-fancybox-group="gallery" style="background-image: url('{{url('/media/thumbnail/').'/'.$val->media->filename}}');"></a>
	    @else
	    <a class="fancybox-photos-comments" href="{{url('/back_assets/img/no_image.jpg')}}" data-fancybox-group="gallery" style="background-image: url('{{url('/back_assets/img/no_image.jpg')}}');"></a>
	    @endif
	</span>
	<!-- /.post-author-image -->
	@endforeach
	@if($count_photos_comments>3)
	<span class="post-thumbnail-num">
		<a class="fancybox view-comment-food-photos" data-id="{{$val->comments->id}}"  href="#">
			{{$count_photos_comments}} photos
		</a>
	</span>
	@endif
</div>
<!-- /.post-thumbnail-wrapper -->
@endif