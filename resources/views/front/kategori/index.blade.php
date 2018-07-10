@extends('front.yield.app')
@section('content')
@if(!empty($categoriesAbjad->media->filename))
<img alt="{{$categoriesAbjad->name}}" class="w100" src="{{url('/media/originals/').'/'.$categoriesAbjad->media->filename}}" alt="">
@else
<img alt="Background Image" class="w100" src="{{url('/back_assets/img/no_image.jpg')}}" alt="">
@endif
<div class="main-wrapper">
    <div class="main">
        <div class="main-inner" style="margin-top: 30px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="content">
                            <div class="content-title">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                        <h6>Cari Cemilan Favoritmu</h6>
                                    </div><!-- /.col -->
                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                        <form id="form-locations" class="form-horizontal relative form-locations" >
                                            <div class="form-group">
                                                <select style="padding-left: 10px;" class="form-control city-select change-city-index" name="keyword" id="">
                                                    <option @if(!empty($city)) @if($city == 'all') selected @endif @endif value="all">Semua Kota</option>
                                                    @foreach($stores_city as $data)
                                                    <option @if(!empty($city)) @if($city == $data->city) selected @endif @endif value="{{$data->city}}">{{$data->city}}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" class="place_id" name="place_id">
                                                <input type="hidden" class="abjad-input" value="{{$abjad}}" name="abjad">
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
                    </div><!-- /.col -->
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="filter-listing">
                            <div class="filter-listing-form">
                                <div class="container">
                                    <div class="ln-letters in-page">
                                        @foreach($categories_abjad as $data)
                                            @if($loop->last)
                                                <a data-name="{{$data->name}}" class="abjad-button ln-last @if($abjad == $data->name) active @endif">{{$data->name}}</a>
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
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="cards-wrapper">
                            @if($categories->count(0)>0)
                            <div class="infinite-scroll">
                                @foreach($categories as $data)
                                <div class="col-xs-12 col-sm-6 col-lg-6 col-md-6 p5">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                            @if(!empty($data->media->filename))
                                                <div class="card-image home no-line" style="background-image: url('{{url('/media/thumbnail/').'/'.$data->media->filename}}');">
                                                    <a href="{{url('/category/abjad=').$categoriesAbjad->name.'&city='.$city.'/categories='.$data->slug}}"></a>
                                                </div><!-- /.card-image -->
                                            @else
                                                <div class="card-image home no-line" style="background-image: url('{{url('/back_assets/img/no_image.jpg')}}');">
                                                    <a href="{{url('/category/abjad=').$categoriesAbjad->name.'&city='.$city.'/categories='.$data->slug}}"></a>
                                                </div><!-- /.card-image -->
                                            @endif
                                            </div>

                                            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                                <div class="card-content">
                                                    <h2><a href="{{url('/category/abjad=').$categoriesAbjad->name.'&city='.$city.'/categories='.$data->slug}}">{{$data->name}}</a></h2>
                                                    <p>{{str_limit($data->short_text, 90)}}</p>
                                                </div><!-- /.card-content -->
                                            </div><!-- /.col-* -->
                                        </div><!-- /.row .no-gutters -->
                                    </div><!-- /.card -->
                                </div><!-- /.col-* -->
                                @endforeach
                                <div class="static">
                                    {{$categories->links()}}
                                </div>
                            </div><!-- /.row -->
                            @else
                            <p style="text-align:center;" class="text-center">Tidak ada data</p>
                            @endif
                        </div><!-- /.card-wrapper -->
                    </div><!-- /.col-* -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->
</div><!-- /.main-wrapper -->
@stop
@push('scripts')
<script type="text/javascript" src="{{url('/').mix('front_assets/assets/js/custom.min.js')}}"></script>
@endpush