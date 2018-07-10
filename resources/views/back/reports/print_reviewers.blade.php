<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Reports Reviewers</title>
	</head>
	<body>
		<span class="text-center">Reports Total Comments/Rating Reviewers From : <b>{{$date_from}}</b> Until : <b>{{$date_until}}</b></span>
		<br>
		<!-- =========================
								Table
		===========================-->
		<table class="table table-hover table-condensed">
			<thead>
				<tr>
					<th>Name</th>
					<th>Total Comment/Rating</th>
					<th>Status</th>
					<th>Role</th>
					<th>Total Media Upload</th>
				</tr>
			</thead>
			<tbody>
				@foreach($reviewers as $row)
				<tr>
					<td><strong>{{$row->user->name}}</strong></td>
					<td><span class="badge">{{$row->count}}</span></td>
					<td>@if($row->user->status == 1) active @else disabled @endif</td>
					<td>{{$row->user->role_user->roles->name}}</td>
					<td>{{$row->total_media}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<!-- =========================
		End Table
		===========================-->
	</body>
</html>