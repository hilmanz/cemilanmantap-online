@if($foods_similar->count() >0 )
@foreach($foods_similar as $fd)
<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 p5">
	<div class="card">
		@if(!empty($fd->media->filename))
		<div class="card-image similar no-line" style="background-image: url('{{url('/media/thumbnail/').'/'.$fd->media->filename}}');">
		@else
		<div class="card-image similar no-line" style="background-image: url('{{url('/back_assets/img/no_image.jpg')}}');">
		@endif
			<a href="{{url('food').'/'.$fd->slug}}"></a>
			<div class="card-image-rating">
				<span>{{number_format($fd->rating,1)}}</span>
				<i class="md-icon">star</i>
			</div>
			<!-- /.card-image-rating -->
		</div>
		<!-- /.card-image -->
		<div style="min-height: 92px;" class="card-content">
			<h2><a href="{{url('food').'/'.$fd->slug}}">{{$fd->title}}</a></h2>
			<p>{{str_limit($fd->short_text, 90)}}</p>
		</div>
		<!-- /.card-content -->
		<div class="card-actions">
			<a href="{{url('food').'/'.$fd->slug}}" class="card-action-btn btn btn-transparent">Show More</a>
		</div>
		<!-- /.card-actions -->
	</div>
	<!-- /.card -->
</div>
<!-- /.col-* -->
@endforeach
@else
<div class="col-md-12">
	<p style="text-align: center">Tidak Ada Data</p>
</div>
@endif