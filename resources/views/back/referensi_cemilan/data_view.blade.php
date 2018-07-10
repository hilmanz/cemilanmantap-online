@if($referensi_cemilan->count()>0)
<ul class="media-list">
	<li class="media">
		<div style="padding: 0;" class="col-md-1 col-sm-1 col-lg-1 col-xs-1">
			@if(!empty($referensi_cemilan->user->avatar) and $referensi_cemilan->created_by != NULL )
			<img class="media-object img-text img-responsive" style="width:100%;" src="{{url('/media/thumbnail/').'/'.$referensi_cemilan->user->avatar}}" alt="">
			@else
			<img class="media-object img-text img-responsive"  style="width:100%;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
			@endif
		</div>
		<div class="col-md-11 col-sm-11 col-lg-11 col-xs-11">
			<div class="post-row">
				<div class="post-info pull-right">
					<span>{{$referensi_cemilan->created_at}}</span>
					&nbsp
					<button href="#" title="Delete" data-id="{{$referensi_cemilan->id}}" data-box="#mb-delete" class="button-delete btn btn-sm btn-default">
					<i class="fa fa-trash-o"></i>
					</button>
				</div>
			</div>
			@if($referensi_cemilan->created_by != NULL )
			<h4 class="media-heading">{{$referensi_cemilan->user->name}}</h4>
			@else
			<h4 class="media-heading">Anonymous</h4>
			@endif
		</div>
		<div class="col-md-12">
			<h5 class="media-heading"><b>{{$referensi_cemilan->name}}</b></h5>
			<p>{{$referensi_cemilan->review_text}}</p>
			<p>Lokasi : <i>{{$referensi_cemilan->lokasi}}</i></p>
			<p>No Telp : <i>{{$referensi_cemilan->no_telp}}</i></p>
			<p>Harga : <i>{{$referensi_cemilan->harga}}</i></p>
		</div>
		<!-- Media Comment -->
		<div class="media">
			<div style="padding: 2px;" class="col-lg-4 col-md-4 col-sm-4 col-xs-6 gallery" id="links" href="#">
				@foreach($referensi_cemilan->referensi_cemilan_role_media as $val )
				@if(!empty($val->media->filename))
				<a class="gallery-item" href="{{url('/').'/media/originals/'.$val->media->filename}}" title="{{$val->media->filename}}" data-gallery>
					<img class="media-object img-text img-responsive" style="width:100%;" src="{{url('/media/thumbnail/').'/'.$val->media->filename}}" alt="">
				</a>
				@else
				<a class="gallery-item" href="{{url('/back_assets/img/no_image.jpg')}}" title="Image Not Found" data-gallery>
					<img class="media-object img-text img-responsive" style="width:100%;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="Image Not Found">
				</a>
				@endif
				@endforeach
			</div>
		</div>
		<!-- ./Media Comment -->
	</li>
</ul>
@else
<div class="col-md-12">
	<img class="img-responsive no-record" src="{{url('/back_assets/img/no-record-found.jpg')}}" alt="">
</div>
@endif