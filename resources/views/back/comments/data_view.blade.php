@if($comments->count()>0)
<ul class="media-list">
	<li class="media">
		<div style="padding: 0;" class="col-md-1 col-sm-1 col-lg-1 col-xs-1">
			@if(!empty($comments->user->avatar))
			<img class="media-object img-text img-responsive" style="width:100%;" src="{{url('/media/thumbnail/').'/'.$comments->user->avatar}}" alt="">
			@else
			<img class="media-object img-text img-responsive"  style="width:100%;" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
			@endif
		</div>
		<div class="col-md-11 col-sm-11 col-lg-11 col-xs-11">
			<div class="post-row">
				<div class="post-info pull-right">
					<span>{{$comments->created_at}}</span>
					&nbsp
					<button href="#" title="Delete" data-id="{{$comments->id}}" data-box="#mb-delete" class="button-delete btn btn-sm btn-default">
					<i class="fa fa-trash-o"></i>
					</button>
				</div>
			</div>
			<h4 class="media-heading">{{$comments->user->name}}</h4>
			<h5 class="media-heading"><b>{{$comments->title}}</b></h5>
			<p>
				@if($comments->rating>=5)
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				@elseif($comments->rating>=4)
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				@elseif($comments->rating>=3)
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				@elseif($comments->rating>=2)
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				<span class="glyphicon glyphicon-star-empty"></span>
				@elseif($comments->rating>=1)
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
			<p>{{$comments->text}}</p>
			<p>Store : <i>{{$comments->food->store->name}}</i></p>
			<p class="btn btn-primary btn-sm">{{$comments->food->title}}</p>
			<span class="btn @if($comments->status == 'draft') btn-danger @else btn-success @endif btn-sm mt-10 mb-10"> {{$comments->status}} </span>
		</div>
		<!-- Media Comment -->
		<div class="media">
			<div style="padding: 2px;" class="col-lg-4 col-md-4 col-sm-4 col-xs-6 gallery" id="links" href="#">
				@foreach($comments->comments_role_media as $val )
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