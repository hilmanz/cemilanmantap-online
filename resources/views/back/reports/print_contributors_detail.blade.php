<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Reports Foods Uploaded</title>
	</head>
	<body>
		<span class="text-center">Reports Total Foods Uploaded By {{$user->name}} From : <b>{{$date_from}}</b> Until : <b>{{$date_until}}</b></span>
		<br>
		<!-- =========================
								Table
		===========================-->
		<table class="table table-hover table-condensed">
			<thead>
				<tr>
					<th>Food Title</th>
					<th>Status</th>
					<th>Created At</th>
				</tr>
			</thead>
			<tbody>
				@foreach($user_foods as $row)
				<tr>
					<td>{{$row->title}}</td>
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