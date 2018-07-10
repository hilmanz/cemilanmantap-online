@extends('front.yield.app')
@section('content')
<div class="main-wrapper">
            <div class="main">
                <div class="main-inner padtop20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="content">
                                    <div class="content-title">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                <h6>Cari Cemilan Favoritmu</h6>
                                            </div><!-- /.col -->

                                            <div class="col-md-3 col-sm-4 col-xs-10 col-xs-push-1">
                                                <form id="form-locations" class="form-horizontal relative form-locations" action="{{url('/search-location')}}" method="get">
                                                {{csrf_field()}}
                                                    <div class="form-group">
                                                        <select style="padding-left: 10px;" class="form-control city-select change-city-detail" name="keyword" id="">
                                                            <option @if(!empty($city)) @if($city == 'all') selected @endif @endif value="all">Semua Kota</option>
                                                            @foreach($stores_city as $data)
                                                            <option @if(!empty($city)) @if($city == $data->city) selected @endif @endif value="{{$data->city}}">{{$data->city}}</option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <input type="text" autocomplete="off" name="keyword" class="form-control location-city-front" placeholder="Sort by City"> --}}
                                                        <input type="hidden" class="place_id" name="place_id">
                                                        <input type="hidden" class="abjad-input" value="{{$abjad}}" name="abjad">
                                                        <input type="hidden" class="categories-input" value="{{$categories_slug}}" name="categories">
                                                        {{-- <div class="input-group-btn">
                                                            <button type="button" class="btn btn-tertiary" >
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
                            </div><!-- /.col-* -->
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="filter-listing">
                                    <div class="filter-listing-form">
                                        <div class="container">
                                            <div class="ln-letters in-page">
                                                 @foreach($categories_abjad as $data)
                                                    @if($loop->last)
                                                        <a data-name="{{$data->name}}" class="abjad-button ln-last @if($abjad == $data->name) active  @endif">{{$data->name}}</a>
                                                    @else
                                                        <a data-name="{{$data->name}}" class="abjad-button @if($abjad == $data->name) active  @endif">{{$data->name}}</a>
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
                                <div class="page-header center">
                                    <h2><b>{{$category->name}}</b></h2>
                                </div>
                            </div><!--/.col -->

                            <div class="col-xs-12 col-sm-12 col-md-12">
                            @if($food_role_categories->count()>0)
                                <div class="cards-wrapper">
                                    <div class="infinite-scroll">
                                        <!-- Start Coloumt -->
                                        @foreach($food_role_categories as $data)
                                        <div class="col-sm-12 col-md-6 col-lg-6 p5 pb24">
                                            <div class="card">
                                                <div class="row no-gutters">
                                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                        @if(!empty($data->food->media->filename))
                                                        <div class="card-image home left no-line" style="background-image: url('{{url('/media/thumbnail/').'/'.$data->food->media->filename}}');">
                                                            <a href="{{url('food').'/'.$data->food->slug}}"></a>
                                                        </div><!-- /.card-image -->
                                                        @else
                                                        <div class="card-image home left no-line" style="background-image: url('{{url('/back_assets/img/no_image.jpg')}}');">
                                                            <a href="{{url('food').'/'.$data->food->slug}}"></a>
                                                        </div><!-- /.card-image -->
                                                        @endif
                                                        <div class="card-home-rating-icon">
                                                            {{$data->food->rating}} <i class="md-icon">star</i>
                                                        </div><!-- /.card-home-rating-icon -->
                                                    </div>

                                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                        <div style="min-height:80px;" class="card-content">
                                                            <h2><a href="{{url('food').'/'.$data->food->slug}}">{{$data->food->title}}</a></h2>
                                                            <h6>
                                                                Di review oleh:
                                                                <span>
                                                                {{$data->food->contributor}}
                                                                </span>
                                                            </h6>
                                                            <p>{{str_limit($data->food->short_text, 90)}}</p>
                                                        </div><!-- /.card-content -->
                                                        <div class="listing-actions">
                                                            <a href="#" class="listing-action-icon">
                                                            <i class="fa fa-sm fa-star"></i></a>
                                                            <a href="#" class="listing-action-icon"><i class="fa fa-sm fa-comment"></i></a>
                                                            <a href="#" class="listing-action-icon @if($data->food->status_recomended == 1)selected @endif"><i class="fa fa-sm chef-hat"></i></a>
                                                        </div><!-- /.listing-actions -->
                                                    </div><!-- /.col-* -->
                                                </div><!-- /.row .no-gutters -->
                                            </div><!-- /.card -->
                                            <div class="row">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="card">
                                                        @if(!empty($data->singleComent($data->food_id)))
                                                        <div class="row no-gutters">
                                                            <div style="display:block;" class="review-listing">
                                                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                                                    <div class="review-profile-listing">
                                                                        @if($data->singleComent($data->food_id)->user->avatar != null)
                                                                            <img onerror="imgError(this);" src="{{$data->singleComent($data->food_id)->user->avatar}}" alt="">
                                                                        @else
                                                                            <img src="{{url('/front_assets')}}/user_default.jpeg" alt="">
                                                                        @endif
                                                                        <div class="review-profile-content-listing">
                                                                            <div class="profile-name">{{$data->singleComent($data->food_id)->user->name}}</div>
                                                                        </div><!-- /.review-profile-content-listing -->
                                                                    </div><!-- /.review-profile-listing -->
                                                                </div><!-- /.col -->
                                                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                                    <div class="review-listing-meta">
                                                                        <div class="review-rating-listing">
                                                                            @if($data->singleComent($data->food_id)['rating']>=5)
                                                                                <i class="md-icon">star</i>
                                                                                <i class="md-icon">star</i>
                                                                                <i class="md-icon">star</i>
                                                                                <i class="md-icon">star</i>
                                                                                <i class="md-icon">star</i>
                                                                            @elseif($data->singleComent($data->food_id)['rating']>=4)
                                                                                <i class="md-icon">star</i>
                                                                                <i class="md-icon">star</i>
                                                                                <i class="md-icon">star</i>
                                                                                <i class="md-icon">star</i>
                                                                                <i class="md-icon">star_border</i>
                                                                            @elseif($data->singleComent($data->food_id)['rating']>=3)
                                                                                <i class="md-icon">star</i>
                                                                                <i class="md-icon">star</i>
                                                                                <i class="md-icon">star</i>
                                                                                <i class="md-icon">star_border</i>
                                                                                <i class="md-icon">star_border</i>
                                                                            @elseif($data->singleComent($data->food_id)['rating']>=2)
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
                                                                        </div><!-- /.review-rating-listing -->
                                                                        <div class="review-meta-date">
                                                                            <span>{{date('d/m/Y', strtotime($data->singleComent($data->food_id)['created_at']))}}</span>
                                                                        </div><!-- /.review-meta-date -->
                                                                    </div><!-- /.review-listing-meta -->
                                                                    <div style="min-height: 41px;" class="review-text-listing">
                                                                        {{str_limit($data->singleComent($data->food_id)['text'], 90)}}
                                                                    </div><!-- /.review-text-listing -->
                                                                </div><!-- /.col -->
                                                            </div><!-- /.review-listing -->
                                                            <div class="review-listing-actions">
                                                                <a href="{{url('food').'/'.$data->food->slug}}" class="card-action-btn btn btn-transparent">Lihat {{$data->food->count_comments($data->food_id)}} Review</a>
                                                            </div>
                                                        </div><!-- /.row -->
                                                        @else
                                                        <div style="padding-top:20px" class="row no-gutters">
                                                            <div style="display:block;" class="review-listing">
                                                                <div class="review-listing-meta">
                                                                    <p style="margin-bottom:15px;" class="text-center">Tidak ada komentar</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="review-listing-actions">
                                                            <a href="{{url('food').'/'.$data->food->slug}}" class="card-action-btn btn btn-transparent">Berikan Review</a>
                                                        </div>
                                                        @endif
                                                    </div><!-- /.card -->
                                                </div><!-- /.col-* -->
                                            </div><!-- /.row -->
                                        </div>
                                        @endforeach
                                        <!-- End Coloumt -->
                                        <p>{{$food_role_categories->links()}}</p>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.card-wrapper -->
                                @else
                                <p class="text-center">Tidak Ada Data</p>
                                @endif
                            </div>
                            <!-- /.col-* -->
                            <div class="aligncenter">
                                <a href="{{url('/#tambah-referensi')}}" class="btn btn-large btn-orange">TAMBAHKAN CEMILAN FAVORITMU</a><br>
                            </div><!-- /.center -->
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div><!-- /.main-inner -->
            </div><!-- /.main -->
        </div><!-- /.main-wrapper -->
@stop
@push('scripts')
<script type="text/javascript" src="{{url('/').mix('front_assets/assets/js/custom.min.js')}}"></script>
@endpush