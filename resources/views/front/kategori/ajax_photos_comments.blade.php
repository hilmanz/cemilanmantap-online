@if($photos_food_comments->count()>0)
@foreach($photos_food_comments as $photo)
@if(!empty($photo->media->filename))
<div class="swiper-slide">
	<a href="{{url('/media/originals/').'/'.$photo->media->filename}}" class="fancybox-photos-food-comments" data-fancybox-group="gallery">
		<img class="w100 br-10 swiper-lazy" alt="Lemon Slice" src="{{url('/media/thumbnail/').'/'.$photo->media->filename}}">
	</a>
</div>
@else
<div class="swiper-slide">
	<a href="{{url('/back_assets/img/no_image.jpg')}}" class="fancybox-photos-food-comments" data-fancybox-group="gallery">
		<img class="w100 br-10 swiper-lazy" alt="Lemon Slice" src="{{url('/back_assets/img/no_image.jpg')}}" >
	</a>
</div>
@endif
@endforeach
<div style="display: none" class="swiper-slide">
{{$photos_food_comments->links()}}
</div>
@else
<p class="text-center col-md-12">Tidak Ada Data</p>
@endif