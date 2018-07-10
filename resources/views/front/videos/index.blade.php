@extends('front.yield.app')
@section('content')
<div class="main-wrapper">
    <div class="main">
        <div class="main-inner padtop20">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="content">
                            <div class="content-title">
                                <div class="row">
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                        <h6>Cari Cemilan Favoritmu</h6>
                                    </div>
                                    <!-- /.col -->
                                    {{-- <div class="col-md-4 col-sm-4 col-xs-10 col-xs-push-1">
                                        <form id="form-locations" class="form-horizontal relative form-locations" action="{{url('/search-location')}}" method="get">
                                        {{csrf_field()}}
                                            <div class="form-group">
                                                <div class="input-group">
                                                <input type="text" autocomplete="off" name="keyword" class="form-control location-city-front" placeholder="Sort by City">
                                                <input type="hidden" class="place_id" name="place_id">
                                                    <div class="input-group-btn">
                                                        <button type="submit" class="btn btn-tertiary" >
                                                        <i class="fa fa-2x fa-map-marker"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="suggestions"></div>
                                        </form>
                                    </div> --}}
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.content-title -->
                        </div>
                        <!-- /.content -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="filter-listing">
                            <div class="filter-listing-form">
                                <div class="container">
                                    <div class="ln-letters in-page">
                                    <input type="hidden" class="city-select" name="keyword" value="all">
                                        @foreach($categories_abjad as $data)
                                            @if($loop->last)
                                                <a data-name="{{$data->name}}" class="abjad-button ln-last">{{$data->name}}</a>
                                            @else
                                                <a data-name="{{$data->name}}" class="abjad-button">{{$data->name}}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /.container -->
                            </div>
                            <!-- /.filter-listing-form -->
                        </div>
                        <!-- /.filter-listing -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="center"><b>VIDEO</b></h2>
                        @if($videos->count()>0)
                        <div class="w100 infinite-scroll">
                            @foreach($videos as $data)
                            <div style="overflow:hidden;" class="col-md-4 col-lg-4 col-sm-6 col-xs-6 padding-1-px relative">
                                @if(!empty($data->media->filename))
                                <img class="w100" img alt="Waimea cliff jump" src="{{url('/media/thumbnail/').'/'.$data->media->filename}}" >
                                @else
                                <img class="w100" img alt="Waimea cliff jump" src="{{url('/back_assets/img/no_image.jpg')}}" >
                                @endif
                                <a href="{{$data->media->link}}" data-lity>
                                    <div class="absolute-play">
                                        <center>
                                        <img class="w70px" src="{{url('/front_assets')}}/assets/img/icon_play_white.png" alt="">
                                        </center>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                            {{$videos->links()}}
                        </div>
                        @else
                        <div class="col-md-12">
                            <p style="text-align: center;" class="text-center">Tidak ada data</p>
                        </div>
                        @endif
                        <!-- /#video-gallery -->
                    </div>
                    <!-- /.col-* -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.main-inner -->
    </div>
    <!-- /.main -->
</div>
@stop
@push('scripts')
<script type="text/javascript" src="{{url('/front_assets')}}/assets/js/lity.min.js"></script>
<script type="text/javascript" src="{{url('/').mix('front_assets/assets/js/custom.min.js')}}"></script>
<script>
$(document).ready(function() {
    $("#video-gallery").unitegallery({
        gallery_theme: "tilesgrid",
        tile_width: 270,                    //tile width
        tile_height: 270,                   //tile height
        theme_gallery_padding: 0,           //padding from sides of the gallery
        theme_navigation_type: "arrows",
        grid_padding:3,                     //set padding to the grid
        grid_space_between_cols: 3,         //space between columns
        grid_space_between_rows: 3,         //space between rows
        tile_enable_border:false,
        tile_enable_shadow:false,
        lightbox_show_textpanel: false,
    });
});
</script>
@endpush