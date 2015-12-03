@if ( Session::has('flash_message') )
	<div class="alert {{ Session::get('flash_type') }}">
		<div>{{ Session::get('flash_message') }}</div>
	</div>
@endif

<div class="pre-order">

<h3 class="client-pre-order"> Client request pre order </h3>
 
	<div class="form-group required">
		<label class="col-md-2 control-label" style="width:21.666667%; padding-left:6px;"><b>Select Customer</b></label>
		<div class="col-md-2">
			<select class="form-control" ng-model="customer" ng-change="customerChange()" ng-init="customer='-select-'" id="c-list">
			<option>-select-</option>
			@if(count($customers))
				@foreach($customers as $val)
					<option value="{{$val->id}}">{{$val->contact_name}}</option>
				@endforeach
			@endif
			</select>
		</div>
		<a href="{{URL::to('customers')}}/create" class="btn btn-success">Add New Customer</a>
		<a href="{{URL::to('customers')}}/@{{selectedCustomer.id}}/edit" class="btn btn-info c-edit" >Edit Details</a> 
	</div>
	 
  
<div class="content-ektimo ng-cloak"  ng-show="clientsContainer">
<div class="col-md-10">
<!--<div class="row col-md-8 col-md-offset-3" style="border:1px solid #ccccc8;box-shadow:0 0 5px #999;padding:0px 10px 10px 10px;margin-left:227px">
<h4 style="color:#5bc0de;">Customer Details</h4>
	<div class="col-md-8">
	<div class="row">
		<div class="col-md-6"><strong>Company Name</strong>
		</div>
		<div class="col-md-6">@{{selectedCustomer.company_name}}
		</div>
	</div>
	<div class="row">
		<div class="col-md-6"><strong>Address</strong>
		</div>
		<div class="col-md-6">@{{selectedCustomer.address}}
		</div>
	</div>
	<div class="row">
		<div class="col-md-6"><strong>Telephone Number</strong>
		</div>
		<div class="col-md-6">@{{selectedCustomer.telephone_number}}
		</div>
	</div>
	<div class="row">
		<div class="col-md-6"><strong>Email Address</strong>
		</div>
		<div class="col-md-6">@{{selectedCustomer.email_address}}
		</div>
	</div>
	</div>
</div>	-->
</div>

	<div class="form-group required clearfix">
		<label class="col-md-2 control-label" style="width:21.666667%; padding-left:6px;padding-top:10px;"><b>Select Site</b></label>
		<div class="col-md-8" style="padding-top:10px;">
			<div class="col-md-4 req-div">
			<select id="requestSite" class="form-control" ng-model="requestSite" ng-change="getLocation()" ng-init="requestSite=<?php  echo (Request::input('st')?Request::input('st'):0); ?>">
				<option value="0">-select-</option>
				<option   ng-selected="@{{site.id == requestSite}}" ng-repeat="site in siteDetails track by $index" value="@{{site.id}}" > @{{site.name }}</option>
			</select> 
			</div>
			<!--
			<select class="form-control" id="requestSite" required="required" ng-model="requestSite" ng-options="site.id as site.name for site in siteDetails" ng-change="getLocation()" ng-init="requestSite=<?php echo (Request::input('st') ? Request::input('st') :0); ?>">
			  <option value="0">--select--</option>
			</select>-->
			
			
			<a class="addButton btn btn-success" href="{{URL::to('customer')}}/siteDetail?c=@{{selectedCustomer.id}}">Add Site Detail</a>
			
			<a id="editsite" class="editButton btn btn-info" href="{{URL::to('customers')}}/siteEdit?st=@{{requestSite}}&c=@{{selectedCustomer.id}}" class="btn btn-info">Edit Details</a>  
		</div>
		
	</div>
<div class="form-group required clearfix">
		<label class="col-md-2 control-label req-label" style="width:21.666667%; padding-left:6px;padding-top:20px;"><b>Select Location</b></label>
		<div class="col-md-8" id="req-loc" style="padding-top:20px;">
			<div class="col-md-4 req-div">
			<select id="requestLocation" class="form-control" ng-model="requestLocation"  ng-change="locationInfo()"  ng-init="requestLocation=<?php  echo (Request::input('lc')?Request::input('lc'):0); ?>">
				<option value="0">-select-</option>
				<option  ng-selected="@{{ location.id == requestLocation }}"  ng-repeat="location in locationDetails track by $index" value="@{{location.id}}">@{{location.name }}</option>
			</select> 
			</div>
			<a style="display:none" id="testLocation" class="addButton btn btn-success" href="{{URL::to('customer')}}/testLocation?c=@{{selectedCustomer.id}}">Add Test Location</a>
			<a id="editlocation" class="editButton btn btn-info" href="{{URL::to('customers')}}/locationEdit?lc=@{{requestLocation}}&c=@{{selectedCustomer.id}}" class="btn btn-info">Edit Details</a>  
		</div>
	</div>
<div class="form-group required clearfix">
		<label class="col-md-2 control-label req-label" style="width:21.666667%; padding-left:6px;padding-top:20px;"><b>Select Interval</b></label>
		<div class="col-md-8" style="padding-top:20px;">
			<div class="col-md-4 req-div">
			<select id="Interval" class="form-control" name="interval">
				<option value="0">-select-</option>
				<option value="single">Single</option>
				<option value="duplicate">Duplicate</option>
				<option value="triplicate">Triplicate</option>
			</select>  
			</div>
			
		</div>
	</div>
	<div class="form-group required clearfix">
		<label class="col-md-2 control-label" style="width:21.666667%; padding-left:6px;padding-top:20px;"><b>Select client manager</b></label>
		<div class="col-md-2" style="padding-top:20px;">
			<select id="requestTo" class="form-control" ng-model="requestTo" ng-change="getInfo()" ng-init="requestTo=0">
			<option value="0">-select-</option>
			<option ng-repeat="client in clients track by $index" value="@{{client.id}}">@{{client.name }}</option>
			</select> 
		</div>
	</div>

	<div class="clearfix"></div>
	<p ng-show="clientDetails" class="ng-cloak">
	<strong class="colr-head">Client details:</strong> <br/>
	 Name : <span>@{{name}}</span><br/>
	</p>

  
 
<div class="previous-section ng-cloak">
<strong class="colr-head">Previous orders:</strong>
	<hr/>
	<div style="border-bottom:1px solid #CCC;margin:5px;" ng-repeat="order in previousOrders track by $index">
		<div class="pre-vious">
		<div class="row">
				<div class="col-md-2"><strong>Order Id</strong></div>				
				<div class="col-md-3"><strong>Total Amount</strong></div>
				<div class="col-md-3"><strong>Order Date</strong></div>
				<div class="col-md-2"><strong>Order Status</strong></div>
				<div class="col-md-2"><strong></strong></div>
			</div>
			<div class="row">
				<div class="col-md-2">#@{{order.id}}
				</div>				
				<div class="col-md-3">$@{{order.total}}
				</div>
				<div class="col-md-3">@{{ order.created_at }}
				</div>
				<div class="col-md-2">				
				<span class="bg-success" ng-if="order.status == 1 ">Approved</span>
				<span class="bg-info" ng-if="order.status == 0 ">Pending </span>
				</div>
				<div style="margin-bottom:4px;" class="col-md-2"><button type="button" class="toggleDetail btn btn-success yes-btn" onclick="toggle(@{{order.id}})">view</button></div>
			</div>
			
			<div id="orderDetail@{{order.id}}" class="orderDetail" style="display:none;">
			<div class="row col-md-10" style="background-color:#fff;border:1px solid #ccccc8;box-shadow:0 0 5px #999;padding:10px;margin:15px;">
				<h4 style="color:#5bc0de;">Details</h4>
				<div class="order-re-q">
				<table class="table">
				<thead>
					<tr class="order-head">
						<th>Location Id </th>
						<th>Location Name</th>
						<th>Location Type </th>
						<th>Test Method </th>
						<th>Qty</th>
						<th>Amount</th>
					</tr>
				</thead>
			
					<!--<div class="pre-order-req">
					</div>-->
				</div>
				<tbody ng-repeat="item in order.details track by $index" ng-init="last=item.location_id">
					<tr>
						<td ng-if="last != item.location_id || $index == 0">@{{item.location_id}}</td>
						<td ng-if="last != item.location_id || $index == 0">@{{item.location_name}}</td>
						<td ng-if="last != item.location_id || $index == 0">@{{item.location_type}}</td>
						<td>@{{item.method}}</td>
						<td>@{{ item.quantity}}</td>
						<td>@{{ item.price}}</td>
					</tr>
					
				</tbody>
				</table>
			</div>
			<div class="pull-right pre-vious">
				<span class="pull-right pre-vious"> Use again? <button type="button" class="btn btn-success yes-btn" ng-click="repeatOrder(@{{order.id}})">yes</button></span>
			</div>
			<div class="clearfix"></div>
			</div>
		</div>
		<!--<div class="pull-left pre-vious">
			<span ng-repeat="item in order.details">@{{item.id}}</span><br/>
		</div>-->
		
	</div>
	
	<div style=""  ng-if="previousOrders.length==0">No Orders Yet</div> 
	 
</div>
</div> 
</div>
<div class="pre-order ng-cloak" ng-show="clientsContainer">
<div class="previous-section">
<strong class="colr-head">Previous Items:</strong>
	<div ng-repeat="order in previousOrders track by $index">
			<div class="row col-md-12" style="">
				<span ng-repeat="item in order.details">
					<div  style="border-bottom:1px solid #CCC;margin:5px;"  class="row">
					<div class="col-md-6 ">
					<div class="">
					@{{ item.parameter}}, @{{item.state}}, @{{item.method}},  @{{item.test_method}}</div>
					</div>
					<div class="col-md-3">
						<div class="">
						<p><b>Order date</b></p>
						@{{ order.created_at }}
						</div>
					</div>
					
					<div class="col-md-3 ">
						<div class="">
						<div class="pull-right pre-vious">
						<span class="pull-right pre-vious"> add to request listing? <button type="button" class="btn btn-success yes-btn" ng-click="repeatItem(@{{ item}})">yes</button></span>
					</div>
						</div>
					</div>					
					</div>
				</span>
			</div>
			
			<div class="clearfix"></div>
			
		</div>
		<!--<div class="pull-left pre-vious">
			<span ng-repeat="item in order.details">@{{item.id}}</span><br/>
		</div>-->
		
	
	<hr/>
	<div style=""  ng-if="previousOrders.length==0">No Items</div> 
	</div>
</div>
<style>
.form-group {
  margin-bottom: 0; 
}
.req-div{
	padding: 0px; 
	width: 142px;
}
.addButton{
  margin-left :15px;
  width: 145px;
}
</style>
<script>
var loc = [];
function toggle(id){
 var order = 'orderDetail'+id;
  $('.orderDetail').slideUp();
   //$('#'+order+'').slideToggle('slow');
   if($('#'+order+'').is( ":visible")){
		$('#'+order+'').slideUp('slow');
   }else{
	 $('#'+order+'').slideDown('slow');
   }
}	
var default_customer = '<?php echo Request::input('c'); ?>';
var site_id = '<?php echo Request::input('st'); ?>';
var location_id = '<?php echo Request::input('lc'); ?>';

function User($scope,$http){

	$scope.getLocation = function(){ 
		$scope.locationDetails = false;
		if(site_id){
			var s_id = site_id
		}else{
			var s_id = $scope.requestSite
		}
		var lResponse = $http.get(siteUrl+"/customers/siteTestLocation/"+s_id);
		lResponse.success(function(data, status, headers, config){
			$scope.locationDetails = [];
			$scope.slocation = [];	
			loc = data;
			
			if(Object.keys(data).length > 0){
				$scope.locationDetails = data;
			}			 
		});
		
		var getParam = $http.post(siteUrl+"/order/getParameter/"+s_id);
		getParam.success(function(data, status, headers, config){
			$scope.parameters = []; 
			if(Object.keys(data).length > 0){
				$scope.parameters = data;
			}
			//$("div #drop-row").find('input').attr('value',' ');
			$("#parameter").attr('value','');
			$('#parameter').attr('placeholder','Type Parameter');
			$('#parameter').show();
			$("div #drop-row").find('input').hide();
			if ($('#collapseOne').hasClass('in')) {
				$('#param-collapse').trigger('click');
			}
			if ($('#collapseTwo').hasClass('in')) {
				$('#state-collapse').trigger('click');
			}
			if ($('#collapseThr').hasClass('in')) {
				$('#method-collapse').trigger('click');
			}
			if ($('#collapseFr').hasClass('in')) {
				$('#tmethod-collapse').trigger('click');
			}
		});
	}
	
	$scope.locationInfo = function(){
		for(i in $scope.locationDetails){
			if($scope.locationDetails[i].id == $scope.requestLocation){
				$scope.slocation = $scope.locationDetails[i];
				//console.log($scope.slocation);
			}
		}
	}
	
	if(site_id){
		$scope.getLocation();
		$scope.requestSite = site_id;
		var getParam = $http.post(siteUrl+"/order/getParameter/"+$scope.requestSite);
		getParam.success(function(data, status, headers, config){
			$scope.parameters = []; 
			if(Object.keys(data).length > 0){
				$scope.parameters = data;
			}
			//$("div #drop-row").find('input').attr('value',' ');
			$("#parameter").attr('value','');
			$('#parameter').attr('placeholder','Type Parameter');
			$('#parameter').show();
			$("div #drop-row").find('input').hide();
			if ($('#collapseOne').hasClass('in')) {
				$('#param-collapse').trigger('click');
			}
			if ($('#collapseTwo').hasClass('in')) {
				$('#state-collapse').trigger('click');
			}
			if ($('#collapseThr').hasClass('in')) {
				$('#method-collapse').trigger('click');
			}
			if ($('#collapseFr').hasClass('in')) {
				$('#tmethod-collapse').trigger('click');
			}
		});
	}
	if(location_id){
		$scope.locationInfo();
		$scope.requestLocation = location_id;
		var lResponse = $http.get(siteUrl+"/customers/siteTestLocation/"+$scope.requestSite);
		lResponse.success(function(data, status, headers, config){
			$scope.locationDetails = [];
			$scope.slocation = [];	
			loc = data;
			if(Object.keys(data).length > 0){
				for(i in loc){
					if(loc[i].id == location_id){
						loc_info = loc[i];
					}
				}
				$scope.locationDetails = data;
			}			 
		});
		
	}
	$scope.lastLocation = 0;
	$scope.OldOrder = []; 
	$scope.locationDetails = [];
	$scope.clients  = JSON.parse('<?php echo json_encode($users); ?>');
	$scope.customers  = JSON.parse('<?php echo json_encode($customers); ?>');
	$scope.parameters  = JSON.parse('<?php echo json_encode($parameters); ?>');
	
	$scope.selectedCustomer  = '';
	$scope.previousOrders = []; 
	$scope.getInfo = function(){
		$scope.clientDetails = false;
		for(i in users){
			if(users[i].id == $scope.requestTo){
				$scope.name = users[i].name;
				break;
			}
		}
	}

	$scope.customerChange = function(){ 
		$('#customer_id').val($scope.customer);
		$scope.clientsContainer = true;
		$scope.ordersContainer = true;
		
		if($scope.customer == '-select-'){
			$scope.clientsContainer = false;
			$scope.ordersContainer = false;
		}
		for(i in $scope.customers){
			if($scope.customers[i].id == $scope.customer){
				$scope.selectedCustomer = $scope.customers[i];
				break;
			}
		}
		var response = $http.get(siteUrl+"/order/customer-orders/"+$scope.customer);
		response.success(function(data, status, headers, config){
			$scope.previousOrders = []; 
			//console.log(data.order);
			if(Object.keys(data.order).length > 0){
				$scope.previousOrders = data.order;
				console.log($scope.previousOrders);
			}
			if(Object.keys(data.site).length > 0){
				$scope.siteDetails = data.site;
				//console.log($scope.siteDetails);
			}
			 
		});
	}
	
	
	if(default_customer){
		$scope.customer = default_customer;
		$scope.customerChange();
	}
	
	$scope.repeatOrder = function(orderId){
	//alert(orderId);
		var response = $http.get(siteUrl+"/order/getOrder/"+orderId);
		response.success(function(data, status, headers, config){
			//$scope.OldOrder = []; 
			
			if(Object.keys(data).length > 0){
				//$scope.OldOrder = data;
				$scope.OldOrder.push(data[0]);
			}
			$( "html, body" ).animate({
				scrollTop: $('.req-uest-preorder').offset().top,						
					}, 1000);
			$('.submit-request').show();
		});
	}
	
	$scope.repeatItem = function(item){
		var  details_item = [];
		details_item.push(item);
		var data  = {details:details_item};
		$scope.OldOrder.push(data);
		$( "html, body" ).animate({
			scrollTop:$('.req-uest-preorder').offset().top
			//scrollTop: $('.req-uest-preorder').offset().top+600,						
		}, 1000);
		$('.submit-request').show();
	}
	
}
$(function(){
	if(default_customer){
		$('#c-list').val(default_customer).attr("selected", "selected");
	}
	
});

  $(document).ready(function() {
	$('.editButton').hide();
	$('.c-edit').hide();
	if(($('#c-list').val()) != '-select-' ){
		$('.c-edit').show();
	}
	$("#requestLocation").click(function(){
		if( $('#requestSite').val() == 0) { 
			alert('please select site first');
			return false
		}
	});

	if( site_id != 0 && $.isNumeric(site_id)){ 
			$('#editsite').show();
			$("#testLocation").show();
			
	}
	$('#testLocation').click(function(){
		var site = $("#requestSite option:selected").val();
		var href = $(this).attr("href"); 
		if(site != ""){
			$('#testLocation').attr('href', href +'&s='+site);
		}
		
	});
    $("#requestSite").change(function(){
		var site = $("#requestSite option:selected").val();
		var href = $('#testLocation').attr("href"); 
		var c_id = $('#c-list').val();
		if(site != 0){
			$('#editsite').show();
			$("#testLocation").show();
			$('#testLocation').attr('href', href +'&s='+site);
		}else{
			$('#editsite').hide();
			$("#testLocation").hide();
			$('#testLocation').attr('href', href);
		}
		//window.location = 'order?c='+c_id+'&st='+site; // red
		
    });
	
	
  });

</script>