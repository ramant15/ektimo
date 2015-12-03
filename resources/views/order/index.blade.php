@extends('layouts.order')
@section('content')
@include('order/header')

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Delete Client Request
            </div>
            <div class="modal-body">
                Are you sure want to delete?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a href="javascript:void(0);" class="btn btn-danger btn-ok" id="danger">Delete</a>
            </div>
        </div>
    </div>
</div>	
<script>
$(document).on("click", ".delete-request", function(event){   
 $("#danger").attr('rowId', $(this).attr('dval')); 
});
$(document).on("click", "#danger", function(event){		
	var rowId = $(this).attr('rowId');
	$('#row_'+rowId).remove();
	$('#confirm-delete').modal('hide');
});
</script>	

	<div class="add-listing ng-cloak" ng-show="ordersContainer">
	<div class="listing-req pull-right" >Add to request listing? <button type="button" class="btn btn-success yes-btn" id="request-list">yes</button> </div>
	
		
<form class="form-horizontal" method="POST" id="order_form" action="{{URL::to('order/saveClientOrder')}}">
	
	<input type="hidden" name="_token" value="{{ csrf_token() }}">  
	<input type="hidden" name="_method" value="POST">
	<div class="loa-der">
 
	<div class="collapse navbar-collapse bs-example-js-navbar-collapse drop-downs" id="drop-row">
	<ul class="nav navbar-nav drop-nav">
		<li class="dropdown dropdown-bg">
		  
		  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" id="param-collapse" class="action-head">
			Parameter
			<span class="caret"></span></a>
			<input type="text" class="form-control filters-input" id="parameter"  style="display:none;" placeholder = "Type Parameter" autocomplete="off">
		  
		  
		  <div id="collapseOne" class="panel-collapse collapse para-meter-input" role="tabpanel" aria-labelledby="headingOne"> 
		  
			
			<input type="hidden" id="param_id">
			
			<ul class=" list-unstyled dropdown-list param-dropdown">			
			<div id="parameter_container">
			 
					<li role="presentation" ng-model="requestParam"  ng-init="requestParam=0" ng-repeat="parameter in parameters track by $index">
					<a href="javascript:void(0);" type="param" id="param_@{{parameter.id}}" class="param-link" tabindex="-1" role="menuitem" >@{{ parameter.name}}</a>
					</li>
				
		    </div>
			
			</ul>
			
			</div>
		  
		</li>
		
		<li class="dropdown dropdown-bg">
		  
		  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne"id="state-collapse" class="action-head">
			State
			<span class="caret"></span>
		</a>
			<input type="text" class="form-control filters-input" id="state"  style="display:none;" placeholder = "Type State" autocomplete="off">
		  
		  
		  <div id="collapseTwo" class="panel-collapse collapse para-meter-input" role="tabpanel" aria-labelledby="headingOne"> 
		  
				<input type="hidden" id="state_id">
		
				<ul class=" list-unstyled dropdown-list state-dropdown">
					<div id="state_container">
				
					
					</div>
				</ul>
				
			</div>
		  
		</li>
		
		<li class="dropdown dropdown-bg">
		  
		  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThr" aria-expanded="true" aria-controls="collapseOne"id="method-collapse" class="action-head">
			Test Method
			<span class="caret"></span></a>
			<input type="text" class="form-control filters-input" id="method"  style="display:none;" placeholder = "Type Method" autocomplete="off">
		  
			<input type="hidden" id="tmethod_id">
			<input type="hidden" id="test_id">
			<input type="hidden" id="test_price">
		  <div id="collapseThr" class="panel-collapse collapse para-meter-input" role="tabpanel" aria-labelledby="headingOne"> 
		  
			<input type="hidden" id="method_id">
			
		  <ul class="list-unstyled dropdown-list method-dropdown">
			
			<div id="method_container">
			
				
		    </div>
			</ul>
			</div>
		  
		</li>
		
		<!--<li class="dropdown dropdown-bg">
		  
		  <a data-toggle="collapse" data-parent="#accordion" href="#collapseFr" aria-expanded="true" aria-controls="collapseFr"id="tmethod-collapse" class="action-head">
			Test Method
			<span class="caret"></span></a>
			<input type="text" class="form-control filters-input" id="tmethod"  style="display:none;" placeholder = "Type Test Method" autocomplete="off">
		  
		  
		  <div id="collapseFr" class="panel-collapse collapse para-meter-input" role="tabpanel" aria-labelledby="headingOne"> 
		 
			<input type="hidden" id="tmethod_id">
			<input type="hidden" id="test_id">
			<input type="hidden" id="test_price">
			
		  <ul class="list-unstyled dropdown-list tmethod-dropdown">
			
			<div id="tmethod_container">
			 
				
		    </div>
			</ul>
			</div>
		  
		</li>-->
		</ul>
          
        </div>
<div class="row info">
	<div class="col-md-2 info-head">
		<ul class="list-unstyled">
			<li>Customer</li>
			<li>Site</li>
			<li>Interval of tests</li>
			<li>Client Manager</li>
		</ul>
	</div>
	<div class="col-md-2 info-val"><ul class="list-unstyled">
			<li id="client"></li>
			<li id="site"></li>
			<li id="interval"></li>
			<li id="manager"></li>
		</ul></div>
</div>
<div class="req-uest-preorder"> 

<strong class="colr-head">Client request pre order</strong>
 
<div class="order-re-q">
<div class="row order-head">
<table class="table table-bordered">
	<thead>
	<tr>
		<th>Location-ID</th>
		<th>Location Name</th>
		<th>Location Type</th>
		<th>Test Method</th>
		<th>Qty</th>
		<th>Amount</th>
		<th>Qty</th>
	</tr>
	</thead>
<tbody ng-repeat="order in OldOrder track by $index" ng-cloak >
	<tr ng-repeat="item in order.details track by $index" ng-init="lastLoc=item.location_id" id="row_@{{ item.test_id}}" >
		<td class="" ng-if="lastLoc != item.location_id || $index == 0">@{{item.location_id}}</td>
		<td class="" ng-if="lastLoc != item.location_id || $index == 0">@{{item.location_name}}</td>
		<td class="" ng-if="lastLoc != item.location_id || $index == 0">@{{item.location_type}}</td>
		<td class="">@{{item.method}}</td>
		<td style="width:10%" class=""><input type="text" class="form-control"  id = "qty_@{{ item.test_id}}" name="qty[@{{ item.test_id}}]" value="1"/></td>
		<td class="">$@{{ item.price}}</td>
		<td class="">
			<a href="javascript:void(0);" data-href="@{{ item.test_id}}" dval = "@{{ item.test_id}}" data-toggle="modal" data-target="#confirm-delete" class="delete-request"><span class="glyphicon glyphicon-remove" aria-hidden="true" id="delete_@{{ item.test_id}}"></span></a>
		</td>
		<input type="hidden" value="@{{ item.test_id}}" name="testArr[@{{ item.test_id}}]" />
		<input type="hidden" value="@{{ item.price}}" id="baseprice_@{{ item.test_id}}" />
		<input type="hidden" name="test_location_id" value="@{{item.location_id}}" />
	</tr>

</tbody>
	<tbody id="client_request"></tbody>
</table>
</div>
</div>

</div>

<div class="sutmit-req pull-right submit-request" style="display:none;">Submit client request? <button type="submit" class="btn btn-success yes-btn">yes</button> 
</div>
<input type="hidden" name="user_id" id="requestedTo" />
<input type="hidden" id="customer_id" name="customer_id" />
<input type="hidden" id="requestSiteId" name="site_id" value="">
<input type="hidden" id="interval1" name="interval" value="">
<input type="hidden" id="requestLocationId" name="test_location_id" value="@{{item.location_id}}" />
</form>
</div>
</div>

 

<div id="" class="loader-img overlay" style="display:none;">
	<div class="popup">
		<div class="content">
			<img class="" src="images/ajax-loader.gif" style="">
		</div>
	</div>
</div>
 
 <script>
window.onload= function(){
setTimeout(function(){
	var location_text = $('#requestSite option:selected').html();
	  $('#site').text(location_text);
},1000); 

};	
	

	$(function(){
		$('#parameter').fastLiveFilter('#parameter_container');
		$('#state').fastLiveFilter('#state_container');
		$('#method').fastLiveFilter('#method_container');
		$('#tmethod').fastLiveFilter('#tmethod_container');
	});
	var loc_info = []; 
		$(document).ready(function() {
               
			$(".param-link").on( "click", function() { 
			$(".loader-img").show();
			$("#request-list").attr('disabled',false);
			var paramValue = $(this).text();
			var paramStr = $(this).attr('id');
			var paramId = paramStr.split('_');
			var siteId = $("#requestSite").val();
			$('#parameter').val(paramValue).show();
			$('#param_id').attr('value',paramId[1]);
			var state_id = "<?php echo $state_id; ?>";
			var postData = {'param_id' :paramId[1],'state_id':state_id,'site_id':siteId,'_token' : '{{csrf_token()}}'};	
			var html1 = '';
			
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "order/getState", //Relative or absolute path to 
				data: postData,
				success: function(data) { 
				
				$.each(data, function(key, value){ 
				var name= value.name;
				html1 += '<li><a href="javascript:void(0);" type="state" id="state_'+value.state_id+'" class="state-link" tabindex="-1" role="menuitem">'+name.substring(0, 21)+'</a></li>';
				});
				$('#parameter').attr('value',paramValue).show();
				
				$('#param-collapse').trigger('click');
				$('#state').val("");
				$('#state').attr('placeholder','Type State').show();
				$('#state_container').empty().html(html1);				
				$('#state-collapse').trigger('click');
				
				if ($('#state-collapse').hasClass('collapsed')) {
					//$('#state-collapse').trigger('click');
				}
				$('#state').fastLiveFilter('#state_container');
				$('#method').hide();
				$('#tmethod').hide();
				$('#method_container').empty();
				$('#tmethod_container').empty();
				$(".loader-img").hide();
				}
			});
				
			});
			
			var user_id = $("#requestTo option:selected").val();
			$("#requestedTo").val(user_id);
			$('#requestTo').change(function(){
				$("#requestedTo").val($(this).val());
				var manager = $(this).find(":selected").text();
				$('#manager').text(manager);
			});
			
			
			$('#client').text($('#c-list').find(":selected").text());
			$('#c-list').change(function(){
				$('#requestSite').val(0);
				$('#site').text('');
				if(($(this).val()) != '-select-' ){
					$('.c-edit').show();
				}else{
					$('.c-edit').hide();
				}
				var manager = $('#c-list').find(":selected").text();
				$('#client').text(manager);
			});
	
			$("#requestSiteId").val(site_id);
			
			$('#requestSite').change(function(){
				$("#requestSiteId").val($(this).val());
				var site = $(this).find(":selected").text();
				$('#site').text(site);
			});
			
			$("#requestLocationId").val(location_id);
			$('#requestLocation').change(function(){
				$("#requestLocationId").val($(this).val());
				if($(this).val() != 0){
					$('#editlocation').show();
				}else{
					
					$('#editlocation').hide();
				}
				
				for(i in loc){
					if(loc[i].id == $('#requestLocation').val()){
						loc_info = loc[i];
					}
				}
			
			});
			
			var interval = $("#Interval option:selected").val();
			$("#interval").val(interval);
			$('#Interval').change(function(){
				
				$("#interval").val($(this).val());
				$("#interval1").val($(this).val());
				var interval = $(this).find(":selected").text();
				$('#interval').text(interval);
			});
		});	
		
		$("#order_form").submit(function() {	 
			if($("#requestedTo").val() == '' || $("#requestedTo").val() == 0){
				alert('Please select client');
				return false;
			}
		});
		
		$(document).on("click", ".state-link" , function() {
			$(".loader-img").show();		
			//$(".state-link").on( "click", function() { 
			var paramValue = $(this).text();
			var paramStr = $(this).attr('id');
			var stateId = paramStr.split('_');
			var paramId = $('#param_id').val();
			$('#state').val(paramValue).show();
			$('#state_id').attr('value',stateId[1]);			
			$('#tmethod_container').empty();
			var postData = {'state_id' :stateId[1],'param_id' : paramId,'_token' : '{{csrf_token()}}'};	
			var html1 = '';
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "order/getMethod", //Relative or absolute path to 
				data: postData,
				success: function(data) { 
					$.each(data['method'], function(key, value) { 
					var name= value.name;
					var testname = data['test_method'].name;
						$('#test_price').attr('value',value.price);
						$('#tmethod_id').attr('value',data['test_method'].id);
						$('#test_id').attr('value',value.id);
					html1 += '<li><a href="javascript:void(0);" type="state" id="method_'+value.method_id+'" class="method-link" tabindex="-1" role="menuitem">'+name.substring(0, 21)+' - '+testname.substring(0, 21)+'</a></li>';
					});
					$('#state-collapse').trigger('click');				
					$('#method').val("");
					$('#method').attr('placeholder','Type Method').show();
					$('#method_container').empty().html(html1);
					$('#method-collapse').trigger('click');
					$('#method').fastLiveFilter('#method_container');
					$('#tmethod').hide();				
					$('#tmethod_container').empty();
					$(".loader-img").hide();
				}
			});
				
			});
		
		$(document).on("click", ".method-link" , function() {
			$(".loader-img").show();	
			var paramValue = $(this).text();
			var paramStr = $(this).attr('id');
			var methodId = paramStr.split('_');
			var paramId = $('#param_id').val();
			var stateId = $('#state_id').val();
			$('#method').val(paramValue).show();
			$('#method_id').attr('value',methodId[1]);
			//$('#param-collapse').trigger('click');
			$('#method-collapse').trigger('click');
			$(".loader-img").hide();
			/*	var postData = {'method_id' :methodId[1],'param_id' : paramId,'state_id' : stateId,'_token' : '{{csrf_token()}}'};	
			var html1 = '';
			$.ajax({
				type: "POST",
				dataType: "json",
				url: "order/getTestMethod", //Relative or absolute path to 
				data: postData,
				success: function(data) { 
				
				$.each(data, function(key, value) { 
				var name= value.name;
				html1 += '<li><a href="javascript:void(0);" type="state" id="tmethod_'+value.test_method_id+'" class="tmethod-link" tabindex="-1" role="menuitem" main="'+value.id+'" price="'+value.price+'" >'+name.substring(0, 21)+'</a></li>';
				});
				$('#method-collapse').trigger('click');
				$('#tmethod').val("");
				$('#tmethod').attr('placeholder','Type Test Method').show();
				$('#tmethod_container').empty().html(html1);
				$('#tmethod-collapse').trigger('click');				
				$('#tmethod').fastLiveFilter('#tmethod_container');
				$(".loader-img").hide();
				}
			});
				*/
			});
			
		/*$(document).on("click", ".tmethod-link" , function() {	
			$(".loader-img").show();
			var paramStr = $(this).attr('id');
			var paramValue = $(this).text();
			var tmethodId = paramStr.split('_');
			var testId = $(this).attr('main');
			var testPrice = $(this).attr('price');
			$('#tmethod').val(paramValue).show();
			$('#tmethod_id').attr('value',tmethodId[1]);
			$('#test_id').attr('value',testId);
			$('#test_price').attr('value',testPrice);
			$('#tmethod-collapse').trigger('click');
			$(".loader-img").hide();
		});	
		*/

		$('#collapseOne').on('show.bs.collapse', function () {
			
			$("#parameter").show();
		
		});
		
		$('#collapseTwo').on('show.bs.collapse', function () {			
			if($('#param_id').val() == ''){
			return false;
			}
		});
		$('#collapseThr').on('show.bs.collapse', function () {
			if($('#param_id').val() == '' || $('#state_id').val() == ''){
			return false;
			}
		});
		$('#collapseFr').on('show.bs.collapse', function () {
			if($('#param_id').val() == '' || $('#state_id').val() == '' || $('#method_id').val() == ''){
			return false;
			}
		});
			
		$(document).on("click", "#request-list" , function() {
			if($('#requestLocation').val() == 0){
				$( "html, body" ).animate({
					scrollTop: 0,
				}, 2000);
				alert('Please select location');
				return false;
			}
			$(this).attr('disabled',true);			
			var testId = $('#test_id').val();
			if(testId == ''){
			alert('Listing will be added after selections of Parameter/State/Test Method');			
			return false;
			}
			var testPrice = $('#test_price').val();
			var orderStr = $('#parameter').val()+', '+$('#state').val()+', '+$('#method').val()+', '+$('#tmethod').val();
			
			$("div #drop-row").find('input').attr('value','');
			$("div #drop-row").find('input').hide();
			var method = $('#method').val();
			var test_param = $('#parameter').val();
			
			var row = '<tr  ng-init="lastLoc='+loc_info.location_id+'" id="row_'+testId+'"><td ng-if="last != '+loc_info.location_id+' || $index == 0">'+loc_info.location_id+'</td><td ng-if="last !=  '+loc_info.location_id+' || $index == 0">'+loc_info.name+'</td><td ng-if="last !=  '+loc_info.location_id+' || $index == 0">'+loc_info.type+'</td><td>'+method+'</td><td><input type="text" class="form-control"  id = "qty_'+testId+'" name="qty['+testId+']" value="1"/></td><td  id="price_'+testId+'">$'+testPrice+'</td><td><a href="javascript:void(0);" data-href="'+testId+'" dval = "'+testId+'" data-toggle="modal" data-target="#confirm-delete" class="delete-request"><span class="glyphicon glyphicon-remove" aria-hidden="true" id="delete_'+testId+'"></span></a>&nbsp;&nbsp;</td><input type="hidden" value="'+testId+'" name="testArr['+testId+']" /><input type="hidden" value="'+testPrice+'" id="baseprice_'+testId+'" /></tr>';
 
			var req = $('#client_request').text();
			
			if(req==''){
			$('#client_request').html(row);
			
			$( "html, body" ).animate({
				scrollTop: $("#row_"+testId).offset().top-90,
			}, 1000);
			
			$('.submit-request').show();
			}else{
			var already = 0;
				$('input[name^="testArr"]').each(function(){
				var checkTest = $(this).val();				
				if(testId == checkTest){
					already =1;
				}
				});
				
				if(already ==1){
					alert('Same request is already added to list');
					return false;
				}else {
					$('#client_request').append(row);
					$( "html, body" ).animate({
								scrollTop: $("#row_"+testId).offset().top-90,
													
					}, 1000);
				}
				
			}
			$("#request-list").attr('disabled',false);
			
		});	

        $(document).on("focus", "#parameter" , function() {	
			
			if ($('#collapseTwo').hasClass('in')) {
				$('#state-collapse').trigger('click');
			}
			
			if ($('#collapseThr').hasClass('in')) {
				$('#method-collapse').trigger('click');
			}
			if ($('#collapseFr').hasClass('in')) {
				$('#tmethod-collapse').trigger('click');
			}
			
			if ($('#param-collapse').hasClass('collapsed')) {
				$('#param-collapse').trigger('click');
			}
			
		});
		
		$(document).on("focus", "#state" , function() {	
			
			if ($('#collapseOne').hasClass('in')) {
				$('#param-collapse').trigger('click');
			}
			
			if ($('#collapseThr').hasClass('in')) {
				$('#method-collapse').trigger('click');
			}
			if ($('#collapseFr').hasClass('in')) {
				$('#tmethod-collapse').trigger('click');
			}
			
			if ($('#state-collapse').hasClass('collapsed')) {
				$('#state-collapse').trigger('click');
			}
			
		});
		$(document).on("focus", "#method" , function() {	
			
			if ($('#collapseTwo').hasClass('in')) {
				$('#state-collapse').trigger('click');
			}
			
			if ($('#collapseFr').hasClass('in')) {
				$('#tmethod-collapse').trigger('click');
			}
			if ($('#collapseOne').hasClass('in')) {
				$('#param-collapse').trigger('click');
			}
			if ($('#method-collapse').hasClass('collapsed')) {
				$('#method-collapse').trigger('click');
			}
			
		});
		$(document).on("focus", "#tmethod" , function() {	
			
			if ($('#collapseTwo').hasClass('in')) {
				$('#state-collapse').trigger('click');
			}
			if ($('#collapseThr').hasClass('in')) {
				$('#method-collapse').trigger('click');
			}
			if ($('#collapseOne').hasClass('in')) {
				$('#param-collapse').trigger('click');
			}
			if ($('#tmethod-collapse').hasClass('collapsed')) {
				$('#tmethod-collapse').trigger('click');
			}
			
		});
		
		$(document).on("keyup", "input[name^='qty']" , function() {	
		var qtyData = $(this).attr('id');
		var row = qtyData.split('_');
		var id = row[1];
		var qty = $(this).val();
		if(qty==0){
				alert('Quantity for order cannot be 0');
				$(this).val(1);
				return false;
				}
		var basePrice = $('#baseprice_'+id).val();
		var calPrice = eval(qty*basePrice);
		$('#price_'+id).empty().html('$'+calPrice.toFixed(2) );
		});	
		
		 
		/*$("#order_form").submit(function(e) {
		var noQty = 0;
			$('input[name^="qty"]').each(function(){
				var checkTest = $(this).val();				
				if(checkTest == 0){
					noQty =1;
				}
				});
				
				if(noQty==1){
				alert('Quantity for order cannot be empty.');
				return false;
				}else{
				$(this).submit();
				}
		});*/	

		 </script>
	
	<!-- Modal -->
<style>
.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(252, 252, 252, 0.7);
  transition: opacity 500ms;
  opacity: 1;
}
.popup {
   position: fixed;
    right: 50%;
    width: 100px;
    height: 100px;
    margin-top: -50px;
    margin-right: -50px;
    top: 50%;
	transition: all 2s ease-in-out;
}
.popup .content {
    text-align: center;
}
.info{
	margin-top:28%;
	margin-bottom: 20px;
}
.info-head{
font-weight:bold;
}
.info-val li{
  border: 1px solid #E4DDDD;
  padding: 4px;
  height: 28px;
}
.info-head li{
	padding:4px;
}
.param-dropdown{
	height: auto;
    overflow-y: auto;
}

</style>
@endsection