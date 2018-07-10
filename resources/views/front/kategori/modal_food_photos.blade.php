@if($foods_media->count()>0)
<div class="w100 modal-photos">
	@foreach($foods_media as $data)
	<div style="overflow:hidden;" class="col-md-4 col-lg-4 col-sm-6 col-xs-6 padding-1-px relative">
		@if(!empty($data->media->filename))
		<img class="w100" img alt="Waimea cliff jump" src="{{url('/media/thumbnail/').'/'.$data->media->filename}}" >
		<a class="fancybox-modal-food-photos" data-fancybox-group="gallery" href="{{url('/media/originals/').'/'.$data->media->filename}}">
			<div class="absolute-play">
				<center>
				<img class="w70px" src="{{url('/front_assets')}}/assets/img/icon_view_white.png" alt="">
				</center>
			</div>
		</a>
		@else
		<img class="w100" img alt="Waimea cliff jump" src="{{url('/back_assets/img/no_image.jpg')}}" >
		<a class="fancybox-modal-food-photos" data-fancybox-group="gallery" href="{{url('/back_assets/img/no_image.jpg')}}">
			<div class="absolute-play">
				<center>
				<img class="w70px" src="{{url('/front_assets')}}/assets/img/icon_view_white.png" alt="">
				</center>
			</div>
		</a>
		@endif
	</div>
	@endforeach
	{{$foods_media->links()}}
</div>
@else
<div class="col-md-12">
	<p style="text-align: center;" class="text-center">No Record Found</p>
</div>
@endif
<script>
var base_url = window.location.origin;
$('.modal-photos').jscroll({
    autoTrigger: false,
    loadingHtml: '<div class="col-md-12"><div style="width:100px; padding:20px; margin:auto;overflow:hidden;"><img style="width:100%;" src="'+base_url+'/front_assets/loader.gif" alt="loading..."></div></div>',
    padding: 20,
    nextSelector: 'a.js-link',
    contentSelector: 'div.modal-photos',
});
</script>