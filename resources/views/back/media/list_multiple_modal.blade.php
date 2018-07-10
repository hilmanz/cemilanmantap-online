<div style="background: #fff;" class="col-md-12">
	@if($media->count()>0)
	<div class="pull-left push-up-10">
		<button class="btn btn-primary" id="media-multiple-toggle-items">Toggle All</button>
	</div>
	<div class="gallery" id="links">
		@foreach($media as $value)
		@php
		$url =	$value->link;
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		@endphp
		@if($value->type == 'video')
		<a class="gallery-item" href="{{$url}}" type="text/html" data-poster="{{url('/').'/media/originals/'.$value->filename}}" data-youtube="{{$my_array_of_vars['v']}}" title="{{$value->code}}" data-gallery>
			@else
			<a class="gallery-item" href="{{url('/').'/media/originals/'.$value->filename}}" title="{{$value->code}}" data-gallery>
				@endif
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
								<input type="checkbox" value="{{$value->id}}" name="id[]" class="icheckbox check-row"/>
							</label>
						</li>
					</ul>
				</div>
				<div class="meta">
					<span>{{$value->name}}</span>
				</div>
			</a>
			@endforeach
		</a>
		<div class="col-md-12 multiplr-ajax">
			{{$media->links()}}
		</div>
		@else
		<p style="padding:20px;" class="text-center">
			<b>
			<img class="img-responsive no-record" src="{{url('/back_assets/img/no-record-found.jpg')}}" alt="">
			</b>
		</p>
		@endif
<div class="col-md-12">
	<span id="choose-media-value" class="btn btn-lg btn-primary mbt10 pull-right disabled">Choose</span>
</div>
	</div>
</div>
<!-- END CONTENT FRAME BODY -->
<script type="text/javascript" src="{{url('/back_assets')}}/js/plugins.js"></script>
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/media_list_multiple_modal.min.js')}}"></script>
<script>
	$(document).ready(function(){
@if($media->count()>0)
document.getElementById('links').onclick = function (event) {
	event = event || window.event;
	var target = event.target || event.srcElement;
	var link = target.src ? target.parentNode : target;
	var options = {index: link, event: event,onclosed: function(){
		setTimeout(function(){
			$("body").css("overflow","");
		},200);
	}};
	var links = this.getElementsByTagName('a.gallery-item');
	blueimp.Gallery(links, options);
};
@endif
	$('.gallery-item-controls').on('ifChecked', function(event){
		check_true();
	});
	$('.gallery-item-controls').on('ifUnchecked', function(event){
		check_true();
	});
	/* Gallery Items */
	$(".gallery-item .iCheck-helper").on("click",function(){
		var wr = $(this).parent("div");
		if(wr.hasClass("checked")){
			$(this).parents(".gallery-item").addClass("active");
		}else{
			$(this).parents(".gallery-item").removeClass("active");
		}
	});
	$(".gallery-item-remove").on("click",function(){
		$(this).parents(".gallery-item").fadeOut(400,function(){
			$(this).remove();
		});
		return false;
	});
	$("#gallery-toggle-items").on("click",function(){
		$(".gallery-item").each(function(){
			var wr = $(this).find(".iCheck-helper").parent("div");
			if(wr.hasClass("checked")){
				$(this).removeClass("active");
				wr.removeClass("checked");
				wr.find("input").prop("checked",false);
				check_true();
			}else{
				$(this).addClass("active");
				wr.addClass("checked");
				wr.find("input").prop("checked",true);
				check_true();
			}
		});
	});
	function check_true(){
		if($('.check-row').is(':checked')){
			$('#choose-media-value').removeClass("disabled");
		}else{
			$('#choose-media-value').addClass("disabled");
		}
	}
});
/* END Gallery Items */
</script>