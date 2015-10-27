@extends('app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Requested Orders</div>
				<div class="panel-body">
				<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Order #</th>
						<th>Customer</th>
						<th>Site Name</th>
						<th>$ Total</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php $i = 1 ; ?>
				@foreach($orders as $key => $value)
				@if($value->status ==0)
					<tr>
						<td>#{{ $value->id }}</td>
						<td>{{ $value->customer['contact_name']}}</td>
						<td>{{ $value->site['name']}}</td>
						<td>0.00</td>
						<td>
						@if($value->status)
							<span class="bg-success">Approved</span>
						@else
							<span class="bg-info">Pending </span>
						@endif
						 </td>
		 
						<td>
						<!--<a class="btn btn-primary" href="{{URL::to('home/edit-order')}}/{{$value->id}}" role="button"><i class="glyphicon glyphicon-edit"></i> Edit </a> -->
						@if($value->status == 0) 
							<a class="btn btn-primary" href="{{URL::to('home/order-reveiw')}}/{{$value->id}}" role="button"><i class="glyphicon glyphicon-edit"></i> Review </a>
						@elseif($value->status == 1) 
							<a class="btn btn-primary review" href="javascript:void(0)" role="button"><i class="glyphicon glyphicon-edit"></i>Review </a>
						
						@endif
						</td>
					</tr>
					@endif
					<?php $i++; ?>
				@endforeach
				</tbody>
				</table> 
				</div>
			</div>
			<div class="review-panel panel panel-default">
				<div class="panel-heading progress-heading">Orders in Progress</div>
				<div class="panel-body">
				<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Order #</th>
						<th>Customer</th>
						<th>Site Name</th>
						<th>Field Tech</th>
						<th>Scheduled</th>
						<th>Comments</th>
						<th>Action</th>
					</tr>
				</thead>
				
				<tbody>
				
				@foreach($orders as $key => $value)
					@if($value->status == 1)
						<tr>
						<td>#{{ $value->id }}</td>
						<td>{{ $value->customer['contact_name']}}</td>
						<td>{{ $value->site['name']}}</td>
						<td>@if(isset($technician[$value->id]))
							{{ $technician[$value->id]->name}} 
						@endif
						</td>
						<td>@if(isset($technician[$value->id]))
							{{ $technician[$value->id]->date_start}} {{ $technician[$value->id]->time_start}} - {{ $technician[$value->id]->date_end}} {{$technician[$value->id]->time_end}}
						@endif</td>
						<td>@if(isset($technician[$value->id]))
							{{ $technician[$value->id]->description }}
						@endif</td>
						<td><a class="btn btn-primary" href="{{URL::to('home/order-reveiw')}}/{{$value->id}}?detail=true" role="button"><i class="glyphicon glyphicon-edit"></i> Detail </a></td>
					</tr>
					@endif
				@endforeach
				</tbody>
				</table> 
				</div>
			</div>
		</div>
	</div>
</div>
<style>
.progress-heading{
	background-color:green !important;
	color:#fff !important;
}
</style>
<script>
$(document).ready(function(){
   $('.review').click(function(){
		$( "html, body" ).animate({
				scrollTop: $('.review-panel').offset().top,
		}, 1000);
   });
});
</script>
@endsection
