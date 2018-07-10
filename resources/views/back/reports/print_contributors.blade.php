<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Reports Food Uploaded</title>
	</head>
	<body>
		<span class="text-center">Reports Total Food Uploaded Contributors From : <b>{{$date_from}}</b> Until : <b>{{$date_until}}</b></span>
		<br>
		<!-- =========================
								Table
		===========================-->
		<table class="table table-hover table-condensed">
			<thead>
				<tr>
					<th>Name</th>
					<th>Total Foods Uploaded</th>
					<th>Status</th>
					<th>Role</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($contributors as $row)
				<tr>
					<td><strong>{{$row->user->name}}</strong></td>
					<td><span class="badge">{{$row->count}}</span></td>
					<td>@if($row->user->status == 1) active @else disabled @endif</td>
					<td>{{$row->user->role_user->roles->name}}</td>
					<td>
						<a href="{{url('/backadmin/reports-reviewers/').'/'.$row->user->id}}">
							<i class="fa fa-eye btn btn-primary"></i>
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<!-- =========================
		End Table
		===========================-->
	</body>
</html>