@extends('app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Completed Orders</div>
				<div class="panel-body">
				<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Booking date</th>
						<th>Job Title</th>
						<th>Order #</th>
						<th>Job Description</th>
						<th>Detail</th>
						
					</tr>
				</thead>
				<tbody>
				@foreach($complete_events as $key => $value)
					<tr>
						<td>{{ date('d-m-Y',strtotime($value->create_date)) }}</td>
						<td>{{ $value->title}}</td>
						<td>#{{ $value->order_id }}</td>
						<td>{{ $value->description}}</td>
						<td><a href="lab_detail/{{$value->order_id}}">Detail</a></td>
					</tr>
				@endforeach
				</tbody>
				</table> 
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection
