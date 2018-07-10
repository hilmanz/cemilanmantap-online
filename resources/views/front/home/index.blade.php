@extends('front.yield.app')
@section('content')
<div class="main-wrapper">
    <div class="main">
        <div class="main-inner">
            <div class="content">
                <div id="home-slider">
                    <div class="swiper-container">
	                    <div class="swiper-wrapper">
	                    @foreach($home_sliders as $data)
	                        <div class="swiper-slide">
								@if(!empty($data->media->filename))
								<img class="w100" src="{{url('/media/originals/').'/'.$data->media->filename}}" alt="">
								@else
								<img class="w100" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
								@endif
	                        </div>
	                      @endforeach
	                    </div>
                        <!-- Add Pagination -->
                       <!--  <div class="swiper-pagination"></div> -->

                        <div class="hero-form colored">
                            <div class="container-home-abjad">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- <h6 class="center text-sm-center text-xs-center">CARI REFERENSI CEMILAN DARI A SAMPAI Z SEKARANG!</h6> -->
                                        <form id="form-locations" class="relative" action="#" method="">

                                            <div style="margin-bottom: 16px;" class="input-group first col-md-8 col-md-push-2 col-xs-10 col-xs-push-1">
                                                {{-- <input type="text" autocomplete="on" name="keyword" class="form-control" placeholder="Sort by City"> --}}
                                                <select style="padding-left: 10px;" class="form-control city-select" name="keyword" id="">
                                                	<option value="all">Semua Kota</option>
                                                	@foreach($stores_city as $data)
                                                	<option value="{{$data->city}}">{{$data->city}}</option>
                                                	@endforeach
                                                </select>
                                                {{-- <input type="hidden" class="place_id" name="place_id"> --}}
                                            </div>
                                            {{-- <div class="form-group last col-md-1 col-xs-2">
                                                <span class="btn btn-tertiary btn-block click-dropdown-city"><i class="fa fa-1-5x fa-map-marker"></i></span>
                                            </div> --}}
                                            <div class="suggestions"></div>

				                                <div class="hero-form-sub">
				                                    <div class="ln-letters">
					                                @foreach($categories_abjad as $data)
						                                @if($loop->last)
						                                    <a data-name="{{$data->name}}" class="abjad-button ln-last">{{$data->name}}</a>
					                                    @else
					                                    	<a data-name="{{$data->name}}" class="abjad-button">{{$data->name}}</a>
					                                 	@endif
					                                @endforeach
					                                </div>
				                                </div>

                                        </form>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->

                            </div><!-- /.container -->
                        </div><!-- /.hero-form -->
                    </div>
				</div><!-- /.home-slider -->

				<div class="container mt40">
                    <div class="row aligncenter push-bottom no-padding">
                            <h2 style="margin-bottom: 0;"><b>DAPATKAN HADIAH MANTAP</b></h2>
                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 p5 p50-xs">
                            <img src="{{url('/front_assets')}}/assets/img/hadiah-handphone.png" class="img-responsive w100" alt="HP OPPO">
                        </div><!-- /.col-* -->
                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 p5 p50-xs">
                            <img src="{{url('/front_assets')}}/assets/img/hadiah-dua-nintendo.png" class="img-responsive w100" alt="NINTENDO">
                        </div><!-- /.col-* -->
                        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 p5 p50-xs">
                            <img src="{{url('/front_assets')}}/assets/img/hadiah-j2-samsung.png" class="img-responsive w100" alt="HP SAMSUNG">
                        </div><!-- /.col-* -->
                        <div style="margin-top: 30px;" class="col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3 col-sm-12 col-xs-12 p5 p50-xs hidden-xs hidden-sm visible-md visible-lg">
                            <img src="{{url('/front_assets')}}/assets/img/jbl.png" class="img-responsive w100" alt="HP OPPO">
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
					<div class="row no-gutters">
                        <div class="col-sm-12 col-md-4 col-xl-4">
							<div class="cards-wrapper p5">
								<div class="row">
									<div class="col-sm-12 col-md-12">
										<div class="page-title">
											<h4>Top Reviewer</h4>
										</div>
									</div><!-- /.col-* -->
									@if($top_reviewers->count()>0)
									@foreach($top_reviewers as $data)
									<div class="col-sm-12 col-md-12">
										<div class="card">
											<div class="row no-gutters">
												<div class="review-home">
													<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
														<div class="review-profile-home">
														@if($data->user->avatar != null)
															<img onerror="imgError(this);" src="{{$data->user->avatar}}" alt="">
														@else
															<img src="{{url('/front_assets')}}/user_default.jpeg" alt="">
														@endif
															<div class="review-profile-content-home">
																<div title="{{$data->user->name}}" class="profile-name">{{str_limit($data->user->name, 8)}}</div>
																{{-- <div class="profile-level">Newbie Reviewer</div> --}}
															</div><!-- /.review-profile-home -->
														</div><!-- /.review-profile-home -->
													</div><!-- /.col -->
													<div class="col-xs-6 col-sm-6 col-md-6 col-lg-8">
														<div class="review-rating-home">
															@if($data->rating>=5)
																<i class="md-icon">star</i>
																<i class="md-icon">star</i>
																<i class="md-icon">star</i>
																<i class="md-icon">star</i>
																<i class="md-icon">star</i>
															@elseif($data->rating>=4)
																<i class="md-icon">star</i>
																<i class="md-icon">star</i>
																<i class="md-icon">star</i>
																<i class="md-icon">star</i>
																<i class="md-icon">star_border</i>
															@elseif($data->rating>=3)
																<i class="md-icon">star</i>
																<i class="md-icon">star</i>
																<i class="md-icon">star</i>
																<i class="md-icon">star_border</i>
																<i class="md-icon">star_border</i>
															@elseif($data->rating>=2)
																<i class="md-icon">star</i>
																<i class="md-icon">star</i>
																<i class="md-icon">star_border</i>
																<i class="md-icon">star_border</i>
																<i class="md-icon">star_border</i>
															@else
																<i class="md-icon">star</i>
																<i class="md-icon">star_border</i>
																<i class="md-icon">star_border</i>
																<i class="md-icon">star_border</i>
																<i class="md-icon">star_border</i>
															@endif
														</div><!-- /.review-rating-home -->
														<div class="review-text-home">
															{{str_limit($data->text, 100)}}
														</div><!-- /.review-text-home -->
													</div><!-- /.col -->
												</div><!-- /.review-home -->
											</div><!-- /.row -->
										</div><!-- /.card -->
									</div><!-- /.col-* -->
									@endforeach
									@else
									<div class="col-sm-12 col-md-12">
									<p class="text-center">Tidak ada data</p>
									</div>
									@endif

								</div><!-- /.row -->
							</div><!-- /.card-wrapper -->
						</div><!-- /.col-* -->

						<div class="col-sm-12 col-md-4 col-xl-4">
							<div class="cards-wrapper p5">
								<div class="row">
									<div class="col-sm-12 col-md-12">
										<div class="page-title">
											<h4>Top Rating</h4>
										</div>
                                        <a href="{{url('food').'/'.$data->slug}}">
                                        </a>
									</div><!-- /.col-* -->
									@if($top_rating->count()>0)
									@foreach($top_rating as $data)
									<div class="col-sm-12 col-md-12">
										<div class="card">
											<div class="row no-gutters">
												<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
													@if(!empty($data->media->filename))
													<div class="card-image home no-line" style="background-image: url('{{url('/media/thumbnail/').'/'.$data->media->filename}}');">
														<a href="{{url('food').'/'.$data->slug}}"></a>
													</div><!-- /.card-image -->
													@else
													<div class="card-image home no-line" style="background-image: url('{{url('/back_assets/img/no_image.jpg')}}');">
														<a href="{{url('food').'/'.$data->slug}}"></a>
													</div><!-- /.card-image -->
													@endif
													<div class="card-home-rating-icon">
														{{$data->rating}} <i class="md-icon">star</i>
													</div><!-- /.card-home-rating-icon -->
												</div>

												<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
													<div class="card-content">
														<h2><a href="{{url('food').'/'.$data->slug}}">{{str_limit($data->title, 14)}}</a></h2>
														<p>{{str_limit($data->short_text, 90)}}</p>
														<a href="{{url('food').'/'.$data->slug}}" class="card-action-btn btn btn-transparent">Show More</a>
													</div><!-- /.card-content -->
												</div><!-- /.col-* -->
											</div><!-- /.row .no-gutters -->
										</div><!-- /.card -->
									</div><!-- /.col-* -->
									@endforeach
									@else
									<div class="col-sm-12 col-md-12">
									<p class="text-center">Tidak ada data</p>
									</div>
									@endif
								</div><!-- /.row -->
							</div><!-- /.card-wrapper -->
						</div><!-- /.col-* -->

						<div class="col-sm-12 col-md-4 col-xl-4">
							<div class="cards-wrapper p5">
								<div class="row">
									<div class="col-sm-12 col-md-12">
										<div class="page-title">
											<h4>Trending Topics</h4>
										</div>
									</div><!-- /.col-* -->
									@if($top_trending ->count()>0)
									@foreach($top_trending as $data)
									<div class="col-sm-12 col-md-12">
										<div class="card">
											<div class="row no-gutters">
												<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
													@if(!empty($data->food->media->filename))
													<div class="card-image home no-line" style="background-image: url('{{url('/media/thumbnail/').'/'.$data->food->media->filename}}');">
														<a href="{{url('food').'/'.$data->food->slug}}"></a>
													</div><!-- /.card-image -->
													@else
													<div class="card-image home no-line" style="background-image: url('{{url('/back_assets/img/no_image.jpg')}}');">
														<a href="{{url('food').'/'.$data->food->slug}}"></a>
													</div><!-- /.card-image -->
													@endif
													<div class="card-home-rating-icon">
														{{$data->food->rating}} <i class="md-icon">star</i>
													</div><!-- /.card-home-rating-icon -->
												</div>

												<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
													<div class="card-content">
														<h2><a href="{{url('food').'/'.$data->food->slug}}">{{str_limit($data->food->title, 14)}}</a></h2>
														<p>{{str_limit($data->food->short_text, 90)}}</p>
														<a href="{{url('food').'/'.$data->food->slug}}" class="card-action-btn btn btn-transparent">Show More</a>
													</div><!-- /.card-content -->
												</div><!-- /.col-* -->
											</div><!-- /.row .no-gutters -->
										</div><!-- /.card -->
									</div><!-- /.col-* -->
									@endforeach
									@else
									<div class="col-sm-12 col-md-12">
									<p class="text-center">Tidak ada data</p>
									</div>
									@endif
								</div><!-- /.row -->
							</div><!-- /.card-wrapper -->
						</div><!-- /.col-* -->
					</div><!-- /.row -->
                    <div id="tambah-referensi" class="row">
						<div class="col-md-12">
                                <div class="box-small center">
                                    <div class="row">
                                        <div class="col-md-8 col-md-push-2">

                                            <h4><b>Cemilan favoritmu belum ada di referensi Cemilan Mantap?</b></h4>
                                            <h6 class="sub-title">kirimkan referensi cemilan favoritmu di kolom berikut untuk melengkapinya</h6>
				                            <form id="form-add-referensi-cemilan" action="{{ url('/add-referensi-cemilan') }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
				                                {{ csrf_field() }}
				                                {{ method_field('POST') }}
		                                        <div class="w100">
		                                            <div class="pesan" style="display:block; overflow: hidden;"></div>
		                                        </div>
                                                <div class="form-group">
                            						<input type="text" class="form-control" name="name" placeholder="Nama Cemilan">
                            					</div><!-- /.form-group -->
                            					<div class="form-group">
                            						<input type="text" class="form-control" name="lokasi" placeholder="Lokasi Cemilan">
                            					</div>
												{!! NoCaptcha::display() !!}
		                                        <div class="w100">
		                                            <div class="preview"></div>
		                                            <div class="progress" style="display:none; overflow: hidden;">
		                                                <div class="progress-bar" role="progressbar" aria-valuenow="0"
		                                                    aria-valuemin="0" aria-valuemax="100" style="width:0%">
		                                                    0%
		                                                </div>
		                                            </div>
		                                        </div>
                                                <div class="form-group-btn" style="z-index:999">
                        							<button type="button" class="btn btn-primary btn-large btn-poppins submit-referensi-cemilan">Submit</button>
                                                <img class="loading-button" style="width:20px; display: none;" src="{{url('/back_assets')}}/img/loading_button.gif" alt="">
                        						</div><!-- /.form-group-btn -->
                                            </form>
                                        </div><!-- /.col-* -->
                                    </div><!-- /.row -->
                                </div><!-- /.card -->
                        </div><!-- /.col-* -->
                    </div><!-- /.row -->
				</div><!-- /.container -->
            </div><!-- /.content -->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->
</div><!-- /.main-wrapper -->

@stop
@push('scripts')
<script type='text/javascript' src='{{url('/back_assets')}}/js/form.js'></script>
<script type="text/javascript" src="{{url('/back_assets')}}/js/plugins/scrolltotop/scrolltopcontrol.js"></script>
<script type="text/javascript" src="{{url('/').mix('front_assets/assets/js/add_cemilan/add_cemilan.min.js')}}"></script>
<script>
var swiper = new Swiper('#home-slider .swiper-container', {
  spaceBetween: 30,
  pagination: {
    el: '#home-slider  .swiper-pagination',
    clickable: true,
  },
  autoplay: {
    delay: 5000,
  },
  simulateTouch:true,
  speed: 2000,
  spaceBetween: 0,
  loop: false
});
</script>
@endpush