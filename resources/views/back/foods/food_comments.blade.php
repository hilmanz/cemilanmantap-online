@if($comments->count()>0)
<ul class="media-list">
	@foreach($comments as $komen)
	<li style="background: #fff; border: 1px solid #e6e3e3; margin-bottom: 0;" class="media panel panel-default">
		<div style="padding: 0;" class="col-md-1 col-sm-1 col-lg-1 col-xs-1">
			@if(!empty($komen->user->avatar))
			<img class="media-object img-text img-responsive" style="width:100%;" src="{{url('/media/thumbnail/').'/'.$komen->user->avatar}}" alt="">
			@else
			<img class="media-object img-text img-responsive"  style="width:100%;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
			@endif
		</div>
		<div class="col-md-11 col-sm-11 col-lg-11 col-xs-11">
			<div class="post-row">
				<div class="post-info pull-right">
					<span class="text-mute">{{$komen->created_at}}</span> &nbsp
					<span class="btn @if($komen->status == 'draft') btn-danger @else btn-default @endif btn-sm mt-10 mb-10"> {{$komen->status}} </span>&nbsp
					<button data-id="{{$komen->id}}" data-box="#comments-delete" class="delete-comments btn btn-danger btn-sm">
					<i class="fa fa-trash-o"></i>
					</button>
				</div>
			</div>
			<h4 class="media-heading">{{$komen->user->name}}</h4>
			<h5 class="media-heading"><b>{{$komen->title}}</b></h5>
			<p>
				@if($komen->rating>=5)
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				@elseif($komen->rating>=4)
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				@elseif($komen->rating>=3)
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				@elseif($komen->rating>=2)
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				@elseif($komen->rating>=1)
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				@else
				<span class="glyphicon glyphicon-star-empty"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				@endif
			</p>
			<p>{{$komen->text}}</p>
		</div>
		<!-- Media Comment -->
		<div class="media">
			<div style="padding: 2px;" class="col-lg-4 col-md-4 col-sm-4 col-xs-6 gallery" id="links" href="#">
				@foreach($komen->comments_role_media as $val )
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
	@endforeach
</ul>
<div class="col-md-12 comments-ajax">
	{{$comments->links()}}
</div>
@else
<div class="col-md-12">
	<img class="img-responsive no-record" src="{{url('/back_assets/img/no-record-found.jpg')}}" alt="">
</div>
@endif