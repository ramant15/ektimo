<html> 
	<body> 
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Parameter</th>
					<th>State</th>
					<th>Method type</th>
					<th>Test Method</th>
					<th>Sampling</th>
					<th>Analysis</th>
					<th>Quantity</th>
					@foreach($test_processes as $key=>$item)
					<th>Kit-{{$key+1}}</th>
					@endforeach
				</tr>
			</thead>
			@foreach($order['details'] as $value)
				<tr>
					<td>{{$value->parameter}}</td>
					<td>{{$value->state}}</td>
					<td>{{$value->method_type}}</td>
					<td>{{$value->method}}</td>
					<td>{{$value->sampling}}</td>
					<td>{{$value->Analysis}}</td>
					<td>{{$value->quantity}}</td>
				@foreach($test_processes as $key=>$item)
					<td>{{$item->name}} <img src="public/ItemImages/{{$item->image}}" width="50" height="100" /></td>
				@endforeach
				</tr>
			@endforeach	
		</table> 
	</body> 
</html>