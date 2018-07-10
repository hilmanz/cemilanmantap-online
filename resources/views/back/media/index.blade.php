@extends('back.yield.app')
@section('content')
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li class="active">Media Library</li>
</ul>
<!-- END BREADCRUMB -->
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<!-- START WIDGETS -->
	<div class="row">
		<div class="col-md-12">
			@if ($message = Session::get('success'))
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>{{ $message }}</strong>
			</div>
			@elseif($message = Session::get('Failed'))
			<div class="alert alert-danger alert-block eror">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>{{ $message }}</strong>
			</div>
			@endif @if(count($errors)>0)
			<div class="alert alert-danger eror">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			<div class="panel panel-default">
				<div class="col-md-12">
					<a href="#" id="add-media" class="btn btn-lg btn-datatalk mbt10">
						<span class="fa fa-plus"></span>
						Add Media
					</a>
					<a  data-box="#delete" href="" id="delete-value" class="btn btn-lg btn-danger mbt10 disabled">
						<span class="fa fa-trash-o"></span>
						Deleted Selected
					</a>
				</div>
				<div class="panel-body panel-body-table">
					<!-- START CONTENT FRAME -->
					<div class="col-md-12">
						<input style="margin-bottom: 10px;" class="form-control" placeholder="Search Media by Name" type="text" id="search_keyword" name="search_keyword">
					</div>
					<div id="imagesList" class="content-frame">
					</div>
					<!-- END CONTENT FRAME -->
				</div>
				<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
					<div class="slides">
					</div>
					<h3 class="title"></h3>
					<a class="prev">‹</a>
					<a class="next">›</a>
					<a class="close">×</a>
					<a class="play-pause"></a>
					<ol class="indicator">
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- =========================
Danger with sound
===========================-->
<div class="message-box message-box-danger animated fadeIn" data-sound="fail" id="delete">
	<div class="mb-container">
		<div class="mb-middle">
			<div class="mb-title"><span class="fa fa-trash-o"></span> Confirm Delete!</div>
			<div class="mb-content">
				<p>Are you sure delete <b>this</b></p>
			</div>
			<div class="mb-footer">
				<button onclick="event.preventDefault();
				document.getElementById('delete-images').submit();"  class="btn btn-success btn-lg pull-right mb-control-close">Yes</button>
				<form id="delete-images" style="display:none"  class="form-horizontal" action="{{url('/backadmin/multi-delete-media')}}" method="post" accept-charset="utf-8">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<div class="array_delete"></div>
				</form>
				<button class="btn btn-default btn-lg pull-right cancel-delete-value">No</button>
			</div>
		</div>
	</div>
</div>
<!-- =========================
End danger with sound
===========================-->
<!-- =========================
Start Modal Sections
===========================-->
@include('back.modal.add_media')
<div id="edit-images" class="modal fade bd-example-modal-lg" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-pink">
				<h5 class="modal-title">
				Edit Media
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true" >&times;</span>
				</button>
				</h5>
			</div>
			<div class="modal-body">
				<div class="row">
					<div id="get-edit-images"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- =========================
End Modal Sections
===========================-->
@stop
@push('scripts')
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/media_index.min.js')}}"></script>
@endpush