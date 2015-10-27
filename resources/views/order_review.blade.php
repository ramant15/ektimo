@extends('app')
@section('content')
<link href="{{ asset('/css/daterangepicker.css') }}" rel="stylesheet">
<script src="{{asset('/js/moment.js')}}" type="text/javascript"></script>
<script src="{{asset('/js/daterangepicker.js')}}" type="text/javascript"></script>
<link href="{{ asset('/css/jquery.fancybox.css') }}" rel="stylesheet">
<script src="{{asset('/js/jquery.fancybox.js')}}" type="text/javascript"></script>

<div class="container" ng-app="" ng-controller="Order">			
	<div class="row">
		@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
			</ul>
		</div>
		@endif
		<div class="col-md-10 col-md-offset-1">
		<form id="order-reviewed" action="{{URL::to('home/complete-order')}}" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="hidden" name="_method" value="POST">
			<input type="hidden" name="id" value="{{$order->id}}">
			<div class="panel panel-default">
				<div class="panel-heading">Review Order
				<a href="{{URL::to('home')}}" class="btn btn-default pull-right" style="margin-top: -7px;">Back</a>
				</div>
				<div class="panel-body">
					<div class="row info">
						<div class="col-md-7">
							<div class="row">
								<div class="col-md-4 info-head">
									<ul class="list-unstyled">
										<li>Order #</li>
										<li>Customer</li>
										<li>Site</li>
										<li>Interval of tests</li>
										<li>Client Manager</li>
									</ul>
								</div>
								<div class="col-md-4 info-val"><ul class="list-unstyled">
										<li>{{$order->id}}</li>
										<li>{{$order->customer['contact_name']}}</li>
										<li>{{$order->site['name']}}</li>
										<li>{{$order->interval}}</li>
										<li>{{Auth::user()->name}}</li>
									</ul>
								</div>
							</div>
							
						</div>
						<div class="col-md-5">
							<a class="calendar btn btn-default" data-fancybox-type="iframe" href="/work-schedule?order_id={{$order->id}}">Assign and Schedule Technician</a>
							
							<!--<input name="schedule" type="text" id="scheduling">-->
							<br>
						<?php 
						$detail = Request::input('detail'); 
						if($detail== 'true'){ ?>
						<p class="tech">Assigned Technician: <span><b>{{$tech->name}}</b></span></p>
						<?php } ?>
						</div>
						
					</div>
					<br>
					
					<div>
					<table class="table table-bordered">
					<thead>
					<tr>
						<th>Location-ID</th>
						<th>Location Name</th>
						<th>Location Type</th>
						<th>Test Method</th>
						<th>Qty</th>
						<th>Amount</th>
					</tr>
					</thead>
					<tbody ng-repeat="order in OrderDetails track by $index" ng-cloak >
					
						<tr ng-repeat="item in order.details track by $index" ng-cloak >
							<td>@{{item.location_id}}</td>
							<td>@{{item.location_name}}</td>
							<td >@{{item.location_type}}</td>
							<td >@{{item.method}}</td>
							<td style="width:10%"><input type="text" class="form-control"  id = "qty_@{{ item.test_id}}" name="quantity[@{{item.id}}]" value="@{{item.quantity}}"/></td>
							<td style="width:10%" ><input type="text" class="form-control"  id = "price_@{{ item.test_id}}" name="price[@{{item.id}}]" value="@{{item.price}}"/></td>
							<input type="hidden" name="detail_id" value="@{{item.id}}">
						</tr>
						
					</tbody>
					</table>
					<?php 
					if($detail== 'true'){
						?>
						<input type="hidden" name="edit" value="true">
						<a id="update"  class="btn btn-primary pull-right" href="#" role="button"><i class="glyphicon glyphicon-edit"></i> Update </a>&nbsp;
					<?php }else{ ?>
						<a id="approve"  class="btn btn-primary pull-right" href="#" role="button"><i class="glyphicon glyphicon-edit"></i> Approve </a>&nbsp;
					<?php } ?>
					<a class="btn btn-primary pull-right" href="javascript:void()" onclick="cancelOrder({{$order->id}})" role="button"><i class="glyphicon glyphicon-edit"></i>Cancel</a>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<style>

.btn {
    margin-left: 10px;
}
.comment{
	width:270px;
}
.tech{
	padding-top: 10px;
	padding-left: 10px;
}
.tech span{
	color:green;
}
</style>
<script>
<?php if(isset($tech_schedule)){ ?>
	$('#scheduling').val('<?php echo  $tech_schedule['start_date'].' - '. $tech_schedule['end_date']; ?>');
<?php } ?>
function Order($scope,$http){
	$scope.OrderDetails = []; 
	var orderId = {{$order->id}};
	var response = $http.get(siteUrl+"/order/getOrder/"+orderId);
	response.success(function(data, status, headers, config){	
		if(Object.keys(data).length > 0){
			//$scope.OrderDetails = data;
			$scope.OrderDetails.push(data[0]);
		}
	});
	
}
$(function() {
	unavailable = []; 
	curr_date = '';
	range(unavailable);
	
	$('#tech_sech').change(function(){
		//$('input[name="schedule"]').data('daterangepicker').remove();
		var tech_id = $(this).val();
		unavailable = []; 
		$.ajax({
			type : 'POST',
			url: 'http://54.79.23.80/home/get-booked',
			data : {'tech_id': tech_id,'_token':'{{ csrf_token() }}'},
			success: function(resp){
				var booked = JSON.parse(resp);
				for(i in booked){
					var startDate = booked[i].start_date;
					var endDate = booked[i].end_date;
					// populate the array
					for (var d = new Date(startDate); d <= new Date(endDate); d.setDate(d.getDate() + 1)) {
						unavailable.push(d.toJSON().substring(0,10));
					}
				}
				range(unavailable);
			}
			
		})

	});
	
	function range(unavailable){
		$('input[name="schedule"]').daterangepicker({
			timePicker: true,
			locale: {
				format: 'YYYY-MM-DD h:mm A'
			},
			isInvalidDate :  
				function(date){
					var curr_date = date.format('YYYY-MM-DD');
					if (unavailable.indexOf(curr_date) > -1){ 
						//console.log(unavailable);
						return true;        
					}else{
						return false;        
					}
						
				}
				
		});
	}
	
	$('#approve').click(function(){
		$('#order-reviewed').submit();
	});
   
   $('#update').click(function(){
		$('#order-reviewed').submit();
	});
});
$(".calendar").fancybox({
		minWidth    : 1100,
        minHeight   : 650,
		fitToView   : true,
        autoSize    : true,
        closeClick  : false,
        openEffect  : 'none',
        closeEffect : 'none',
		helpers : {
			title: null,
			overlay : {
				css : { 'background' : 'rgba(120, 120, 121, 0.60)' },
				locked : false 
			}
		}

});
function cancelOrder(order_id) {
    if (confirm("Are you sure to delete order from list?")) {
		window.location.href = "/home/cancel-order/"+order_id;
    }
    return false;
}
</script>

@endsection