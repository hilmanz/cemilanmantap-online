@extends('front.yield.app')
@section('content')
<div class="wide-header">
    <div class="background-image-holder" style="background:url('{{url('/front_assets')}}/assets/img/about-header.jpg')">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wide-headline">
                    TENTANG CEMILAN
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-wrapper">
    <div class="main">
        <div class="main-inner">
            <div class="container">
                <div class="row">
					<div class="col-md-10 col-md-push-1">
                        <div class="content">
                            <div class="content-title">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                        <h6>Cari Cemilan Favoritmu</h6>
                                    </div><!-- /.col -->
                                    {{-- <div class="col-md-4 col-sm-12 col-xs-12 ">
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
                                    <input type="hidden" class="city-select" name="keyword" value="all">
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
                <div class="row push-top-bottom">
                    <div class="col-md-12">
                        <div class="post-detail center">
							<h3>CEMILAN MANTAP</h3>
							<p style="margin-bottom:80px">
								Ragam cemilan yang ada di Indonesia menjadi salah satu warisan kuliner yang harus dilestarikan, ini menjadi misi kami untuk merangkumnya dalam sebuah kamus cemilan.
							</p>
							<h3>“ABC OF CEMILAN MANTAP”</h3>
							<p>
								Kamus di mana kalian bisa menemukan inspirasi cemilan terbaik Indonesia yang cocok dinikmati dengan mantapnya Kopi ABC di segala waktu dan suasana. Berisi segala jenis cemilan Indonesia dari A sampai Z hasil dari rekomendasi terbaik #TemanMantap saat mencari cemilan khas suatu daerah/wilayah berdasarkan <i>top reviewer</i>, <i>top rating</i>, maupun <i>trending topics</i>.
							</p>
                            <p>Kamu pun bisa berpartisipasi dalam memperkaya daftar kamus “ABC OF CEMILAN MANTAP” dan dukung misi kami dengan cara memberikan <i>likes</i>, <i>review</i> serta menambahkan cemilan favorit versimu di </p>
                            <a href="https://www.cemilanmantap.com.">www.cemilanmantap.com</a>
						</div><!-- /.post-detail -->
                    </div><!-- /.col-* -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.main-inner -->
    </div><!-- /.main -->
</div><!-- /.main-wrapper -->
@stop
@push('scripts')
@endpush