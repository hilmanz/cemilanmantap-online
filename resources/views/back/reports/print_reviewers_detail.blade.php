<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Reports Reviewers</title>
	</head>
	<body>
		<span class="text-center">Reports Total Comments/Rating By {{$user->name}} From : <b>{{$date_from}}</b> Until : <b>{{$date_until}}</b></span>
		<br>
		<!-- =========================
								Table
		===========================-->
		<table class="table table-hover table-condensed">
			<thead>
				<tr>
					<th>Food Title</th>
					<th style="width:100px;">Comment Text</th>
					<th>Rating</th>
					<th>Status</th>
					<th>Created At</th>
				</tr>
			</thead>
			<tbody>
				@foreach($user_comments as $row)
					<tr>
						<td><strong>{{$row->food->title}}</strong></td>
						<td>{!! $row->text !!}</td>
						<td>{{$row->rating}}</td>
						<td>{{$row->status}}</td>
						<td>{{$row->created_at}}</td>
					</tr>
					@endforeach
			</tbody>
		</table>
		<!-- =========================
		End Table
		===========================-->
	</body>
</html>