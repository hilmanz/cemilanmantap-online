<div style="width:100%;">
	@if($count_comments >0)
	<div class="row">
		<div class="col-xs-12 col-md-12 text-center">
			<div class="col-md-4">
				<h1 class="rating-num text-left">{{number_format($rating_food['total_rating'],1)}}</h1>
			</div>
			<div style="margin-top:15px;" class="col-md-8">
				<div class="rating text-left">
					@php
					$stars = number_format($rating_food['total_rating'],0);
					@endphp
					@if($stars>=5)
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
					@elseif($stars>=4)
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					@elseif($stars>=3)
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					@elseif($stars>=2)
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					<span class="glyphicon glyphicon-star-empty"></span>
					@elseif($stars>=1)
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
				</div>
				<div class="text-left">
					<span class="glyphicon glyphicon-user"></span>{{number_format($count_comments,0)}} total
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-12">
			<div class="row rating-desc">
				<div class="col-xs-3 col-md-3 text-right">
					<span class="glyphicon glyphicon-star"></span>5
				</div>
				<div class="col-xs-8 col-md-9">
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
							aria-valuemin="0" aria-valuemax="100" style="width: {{($five_stars/$count_comments)*100}}%">
							<span class="sr-only">{{($five_stars/$count_comments)*100}}%</span>
							<p class="text-center">&nbsp {{number_format($five_stars)}}</p>
						</div>
					</div>
				</div>
				<!-- end 5 -->
				<div class="col-xs-3 col-md-3 text-right">
					<span class="glyphicon glyphicon-star"></span>4
				</div>
				<div class="col-xs-8 col-md-9">
					<div class="progress">
						<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20"
							aria-valuemin="0" aria-valuemax="100" style="width: {{($four_stars/$count_comments)*100}}%">
							<span class="sr-only">{{($four_stars/$count_comments)*100}}%</span>
							<p class="text-center">&nbsp {{number_format($four_stars)}}</p>
						</div>
					</div>
				</div>
				<!-- end 4 -->
				<div class="col-xs-3 col-md-3 text-right">
					<span class="glyphicon glyphicon-star"></span>3
				</div>
				<div class="col-xs-8 col-md-9">
					<div class="progress">
						<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
							aria-valuemin="0" aria-valuemax="100" style="width: {{($three_stars/$count_comments)*100}}%">
							<span class="sr-only">{{($three_stars/$count_comments)*100}}%</span>
							<p class="text-center">&nbsp {{number_format($three_stars)}}</p>
						</div>
					</div>
				</div>
				<!-- end 3 -->
				<div class="col-xs-3 col-md-3 text-right">
					<span class="glyphicon glyphicon-star"></span>2
				</div>
				<div class="col-xs-8 col-md-9">
					<div class="progress">
						<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20"
							aria-valuemin="0" aria-valuemax="100" style="width: {{($two_stars/$count_comments)*100}}%">
							<span class="sr-only">{{($two_stars/$count_comments)*100}}%</span>
							<p class="text-center">&nbsp {{number_format($two_stars)}}</p>
						</div>
					</div>
				</div>
				<!-- end 2 -->
				<div class="col-xs-3 col-md-3 text-right">
					<span class="glyphicon glyphicon-star"></span>1
				</div>
				<div class="col-xs-8 col-md-9">
					<div class="progress">
						<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80"
							aria-valuemin="0" aria-valuemax="100" style="width: {{($one_stars/$count_comments)*100}}%">
							<span class="sr-only">{{($one_stars/$count_comments)*100}}%</span>
							<p class="text-center">&nbsp {{number_format($one_stars)}}</p>
						</div>
					</div>
				</div>
				<!-- end 1 -->
			</div>
			<!-- end row -->
		</div>
	</div>
	@else
	<p style="padding:20px;" class="text-center">
		<b>
		<img class="img-responsive no-record" src="{{url('/back_assets/img/no-record-found.jpg')}}" alt="">
		</b>
	</p>
	@endif
</div>