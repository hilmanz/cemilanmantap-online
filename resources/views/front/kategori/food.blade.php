@extends('front.yield.app')
@section('content')
<div class="main-wrapper">
    <div class="main">
        <div class="main-inner padtop20">
            <div style="max-width: 900px;" class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content">
                            <div class="content-title">
                                <div class="row">
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                        <h6>Cari Cemilan Favoritmu</h6>
                                    </div><!-- /.col -->

                                    <div class="col-md-4 col-sm-4 col-xs-10 col-xs-push-1">
                                        <form id="form-locations" class="form-horizontal relative form-locations" action="{{url('/search-location')}}" method="get">
                                        {{csrf_field()}}
                                            <div class="form-group">
                                                <select style="padding-left: 10px;" class="form-control city-select" name="keyword" id="">
                                                    <option @if(!empty($city)) @if($city == 'all') selected @endif @endif value="all">Semua Kota</option>
                                                    @foreach($stores_city as $data)
                                                    <option value="{{$data->city}}">{{$data->city}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" class="place_id" name="place_id">
                                                {{-- <div class="input-group-btn">
                                                    <button type="submit" class="btn btn-tertiary" >
                                                    <i class="fa fa-2x fa-map-marker"></i>
                                                    </button>
                                                </div> --}}
                                                <!-- /.input-group-btn -->
                                                <!-- /.input-group -->
                                            </div>
                                            <div class="suggestions"></div>
                                            <!-- /.form-group -->
                                        </form>
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.content-title -->
                        </div><!-- /.content -->
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="filter-listing">
                            <div class="filter-listing-form">
                                <div class="container no-padding">
                                    <div class="ln-letters in-page">
                                        @foreach($categories_abjad as $data)
                                            @if($loop->last)
                                                <a data-name="{{$data->name}}" class="abjad-button ln-last">{{$data->name}}</a>
                                            @else
                                                <a data-name="{{$data->name}}" class="abjad-button">{{$data->name}}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div><!-- /.container -->
                            </div><!-- /.filter-listing-form -->
                        </div><!-- /.filter-listing -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                    <div class="listing-detail">
                        <div class="post">
                            <div class="post-image">
                                @if(!empty($foods->media->filename))
                                    <a href="{{url('/media/originals/').'/'.$foods->media->filename}}" data-fancybox-group="gallery" class="fancybox-food post-image-link" style="background-image: url('{{url('/media/originals/').'/'.$foods->media->filename}}');"></a>
                                @else
                                    <a href="{{url('/back_assets/img/no_image.jpg')}}" data-fancybox-group="gallery" class="fancybox-food post-image-link" style="background-image: url('{{url('/back_assets/img/no_image.jpg')}}');"></a>
                                @endif
                                @if($photos->count()>0)
                                    <div class="post-thumbnail-wrapper">
                                        @foreach($photos as $data)
                                            @if(!empty($data->media->filename))
                                            <span class="post-image-thumbnail">
                                                <a class="fancybox-food" data-fancybox-group="gallery" href="{{url('/media/thumbnail/').'/'.$data->media->filename}}" style="background-image: url('{{url('/media/thumbnail/').'/'.$data->media->filename}}');"></a>
                                            </span><!-- /.post-author-image -->
                                            @else
                                            <span class="post-image-thumbnail">
                                                <a class="fancybox-food" data-fancybox-group="gallery" href="{{url('/back_assets/img/no_image.jpg')}}" style="background-image: url('{{url('/back_assets/img/no_image.jpg')}}');"></a>
                                            </span><!-- /.post-author-image -->
                                            @endif
                                        @endforeach
                                        @if($q_photos->count()>2)
                                        <span class="post-thumbnail-num">
                                            <a class="view-food-photos" data-id="{{$foods->id}}" href="#">
                                                {{$q_photos->count()}} photos
                                            </a>
                                        </span>
                                        @endif
                                    </div><!-- /.post-thumbnail-wrapper -->
                                @endif
                            </div><!-- /.post-image -->

                            <div class="post-title">
                                <h2><a href="#">{{$foods->title}}</a></h2>
                            </div><!-- /.post-title -->
                            <div class="post-rating">
                                <div id="get-food-rating" data-id={{$foods->id}} class="post-rating-content">
                                    <img style="width:30px;" src="{{url('/back_assets/img/loading_button.gif')}}" alt="">
                                </div>
                            </div><!-- /.post-rating -->

                            <div class="post-meta">
                                <div class="post-meta-item">
                                    <i class="fa fa-comment"></i> Review <span>{{$count_comments}}</span>
                                </div><!-- /.post-meta-item -->

                                <div class="post-meta-item">
                                    <i class="fa fa-money"></i> Price <span>{{number_format($foods->price,0)}}</span>
                                </div><!-- /.post-meta-item -->

                                <div class="post-meta-item">
                                    @if(!Empty($foods->store->phone_number))
                                    <i class="fa fa-phone"></i> Phone Number <span>{{$foods->store->phone_number}}</span>
                                    @else
                                    <i class="fa fa-phone"></i> Phone Number <span>Removed From Database</span>
                                    @endif
                                </div><!-- /.post-meta-item -->
                            </div><!-- /.post-meta -->

                            <div class="post-location">
                            @if(!Empty($foods->store->address))
                                <i class="fa fa-map-marker"></i> <span>{{$foods->store->address}}</span>
                                <i class="fa fa-location-arrow"></i>
                                @if($foods->store->url_use == 'url')
                                <a target="_blank" href="{{$foods->store->url}}">Direction</a>
                                @else
                                <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{$foods->store->latitude}},{{$foods->store->longtitude}}">Direction</a>
                                @endif
                            @else
                                Removed From Database
                            @endif
                            </div><!-- /.post-location -->
                            <div style="overflow: hidden;" class="post-content">
                                <p>
                                    {!! $foods->text !!}
                                </p>
                            </div><!-- /.post-content -->

                            <div class="post-share">
                                <a href="#" id="share-facebook" class="btn color-grey"><i class="fa fa-lg fa-share-square-o"></i> Share </a>
                            </div><!-- /.post-share -->
                        </div><!-- /.post -->
                        <div class="card">
                            <div class="card-content">
                                <h1>Photos</h1>
                                <div class="photos-gallery">
                                    <h3 class="text-right">{{number_format($count_food_photos_comments,0)}} Photos</h3>
                                    <div id="photos-gallery" style="display:none;">

                                    </div>
                                    <div class="swiper-container photos_comments">
                                        <div id="photos-comments" class="swiper-wrapper"></div>
                                        <!-- Add Pagination -->
                                    </div>
                                </div><!-- /.photos-gallery -->
                            </div><!-- /.card-content -->
                        </div><!-- /.card -->
                        <div class="comment-create">
                            <h2 class="no-margin">Write a Review</h2>
                            @if(Sentinel::check())
                            <form id="form-add-comments" action="{{ url('/add-comments') }}" method="post" class="form-horizontal" enctype="multipart/form-data" role="form">
                                {{ csrf_field() }}
                                {{ method_field('POST') }}
                                <div class="col-lg-12">
                                  <div class="star-rating">
                                    <span class="fa fa-star-o" data-rating="1"></span>
                                    <span class="fa fa-star-o" data-rating="2"></span>
                                    <span class="fa fa-star-o" data-rating="3"></span>
                                    <span class="fa fa-star-o" data-rating="4"></span>
                                    <span class="fa fa-star-o" data-rating="5"></span>
                                    <input type="hidden" name="rating" class="rating-value" value="3">
                                  </div>
                                </div>
                                <div class="w100">
                                    <div class="pesan" style="display:block; overflow: hidden;"></div>
                                </div>
                                <div class="form-group">
                                    <label>Review</label>
                                    <textarea name="komentar" class="form-control" rows="5"></textarea>
                                </div><!-- /.form-group -->
                                <div class="file-upload-previews"></div><!-- /.file-upload-previews -->
                                <div class="file-upload">
                                    <input type="file" name="filename[]" class="file-upload-input with-preview" multiple title="Click to add files" maxlength="10" accept="gif|jpg|png|gif">
                                    <span>Click to add images</span>
                                </div>
                                {!! NoCaptcha::display() !!}
                                <!-- /.file-upload -->
                                <input type="hidden" name="food_id" value="{{$foods->id}}">
                                <div class="w100">
                                    <div class="preview"></div>
                                    <div class="progress" style="display:none; overflow: hidden;">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                            aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                            0%
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group-btn">
                                    <button type="button" class="btn btn-primary btn-large submit-comment">Submit Review</button>
                                    <img class="loading-button" style="width:20px; display: none;" src="{{url('/back_assets')}}/img/loading_button.gif" alt="">
                                </div><!-- /.form-group-btn -->
                            </form>
                            @else
                            <p class="text-center">
                            <b>LOGIN : </b><br>
                            <a href="{{url('/login/auth/facebook')}}" class="btn btn-small btn-facebook-large"></a>
                            </p>
                            @endif
                        </div><!-- /.comment-create -->

                        <!-- <h2>3 comments in this topic</h2> -->
                        <div class="infinite-scroll">
                        <ul class="comments">
                            @foreach($comments as $data)
                            <li>
                                <div class="comment">
                                    <div class="comment-author">
                                        @if($data->user->avatar != null)
                                        <a href="#" style="background-image: url('{{$data->user->avatar}}');"></a>
                                        @else
                                         <a href="#" style="background-image: url('{{url('/back_assets/img/no_image.jpg')}}');"></a>
                                        @endif
                                    </div><!-- /.comment-author -->

                                    <div class="comment-content">
                                        <div class="comment-meta">
                                            <div style="margin-bottom:10px;" class="comment-meta-author">
                                                {{$data->user->name}}
                                            </div><!-- /.comment-meta-author -->
                                            <div class="comment-rating">
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
                                            </div><!-- /.comment-rating -->
                                        </div><!-- /.comment-meta -->

                                        <div class="comment-body">
                                            {{$data->text}}
                                        </div><!-- /.comment-body -->
                                        {!! $data->photos_comment($data->id) !!}
                                    </div><!-- /.comment-content -->
                                </div><!-- /.comment -->
                            </li>
                            @endforeach
                        </ul>
                        {{$comments->links()}}
                        </div>
                        <h2>Similar</h2>
                        <div class="row no-margin">
                            {!! $foods->similar($food_categories, $foods->id) !!}
                        </div>
                    </div><!-- /.listing-detail -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->
</div><!-- /.main-wrapper -->
<div id="view-food-photos" class="modal fade bd-example-modal-lg" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div style="background-color: rgba(255,255,255,0.89);" class="modal-content">
            <div class="modal-header bg-pink">
                <h5 class="modal-title text-center">
                <b>Food Photos</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" >&times;</span>
                </button>
                </h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="get-food-photos"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="view-comment-food-photos" class="modal fade bd-example-modal-lg" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div style="background-color: rgba(255,255,255,0.89);" class="modal-content">
            <div class="modal-header bg-pink">
                <h5 class="modal-title text-center">
                <b>Comment Photos</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" >&times;</span>
                </button>
                </h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="get-comment-food-photos"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@push('scripts')
<script type='text/javascript' src='{{url('/back_assets')}}/js/form.js'></script>
<script type="text/javascript" src="{{url('/back_assets')}}/js/plugins/moment.min.js"></script>
<script type="text/javascript" src="{{url('/back_assets')}}/js/plugins/scrolltotop/scrolltopcontrol.js"></script>
<script type="text/javascript" src="{{url('/front_assets')}}/assets/js/jQuery.MultiFile.min.js"></script>
<script type='text/javascript' src='{{url('/front_assets')}}/assets/libraries/fancyBox/source/jquery.fancybox.js'></script>
<script type="text/javascript" src="{{url('/').mix('front_assets/assets/js/custom.min.js')}}"></script>
<script type="text/javascript" src="{{url('/').mix('front_assets/assets/js/kategori/food.min.js')}}"></script>
@endpush