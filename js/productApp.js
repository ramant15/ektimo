	function Product($scope,$parse,$http){
		
		$scope.item_types = item_types
		$scope.suppliers = suppliers;
		$scope.bar_items = [];
		$scope.images = [];
		$scope.customers = [];
		$scope.breaks = [];
		$scope.product_options = [];
		$scope.qtn_b = '';
		$scope.inc_gst = 0.00;
		
		if( typeof productObj != 'undefined'){	
			$scope.supplier_code = productObj.supplier_code;
			$scope.cost = productObj.product_cost;
			$scope.product_options = productObj.product_options;
			var product_id = productObj.product_id;
		}
		  
		$scope.item_type = item_types[0].name;
		
		$scope.add_barcode = function(){
			$scope.bar_items.push($scope.barcodes);
		}
		$scope.add_images = function(){
			$scope.images.push($scope.image);
		}
		$scope.remove_barocde = function(array,index){
			array.splice(index, 1);
		}
		$scope.remove_image = function(array,index){
			array.splice(index, 1);
		}
		$scope.fillCode = function(){			
			$scope.supplier_code = suppliers[$scope.supplierscode].code;
		}
		$scope.$watch('cost', function (newValue, oldValue) {
			var cost = parseFloat(newValue);
			if(!isNaN(cost)){
				var inc =  COUNT_INC_GST(cost);
				$scope.inc_gst = inc;
			}
			else {
				$scope.inc_gst = '';
			}
		});
		
		$scope.add_item_type = function(){
			$scope.msg = '';
			if (!$scope.new_item_type) {
				$scope.msg = 'Please fill name.';
				return false;
			}
			$http.post('{{URL::to("products")}}/add_item_type', {'name': $scope.new_item_type,'_token':csrf_token,'_method':'POST'}
			).success( function(res, status, headers, config) {
				 
				console.log($scope.item_types);
				if (res.status == 200){
					
					$scope.item_types.push(res.data);
					$scope.success = true;
					$scope.new_item_type = '';
					console.log(res.data['name']);
					$scope.item_type = res.data['name'];
					 
				}  
				 
			}).error(function(res, status) {  
				//$scope.responseMessage = status;
			});
			
		}
		$scope.add_customer_type = function(){
			$scope.msg = '';
			if (!$scope.new_customer_type) {
				$scope.msg = 'Please fill name.';
				return false;
			}
			
			$http.post('{{URL::to("products")}}/add_customer_type', {'name': $scope.new_customer_type,'_token':csrf_token,'_method':'POST'}
			).success( function(res, status, headers, config) {
 
				if (res.status == 200){
					$scope.customers.push(res.data);
					$scope.success = true;
					$scope.new_customer_type = '';
					
				} 
			}).error(function(res, status) {  
				//$scope.responseMessage = status;
			});
			 
		};
		
		$scope.add_btybreaks = function(){
			$scope.nextBreak = $scope.nextBreak+1;
			$scope.breaks.push($scope.qtn_b);
		}
		
		$('body').on('keyup','.customer_type', function(){
			var customer_type_cost = parseFloat($(this).val());
			var str =  'customer_inc_gst_'+$(this).attr('model');
			var GP  = 'customer_gp_'+$(this).attr('model');
			var gp_model = $parse(GP);
			var model = $parse(str);
			 
			var gp_percentage = parseFloat(((customer_type_cost - $scope.cost)/customer_type_cost)*100).toFixed(2);
				
			// Assigns a value to it
			var inc_gst = COUNT_INC_GST($(this).val());
			if(isNaN(inc_gst)){
				inc_gst = '';
				gp_percentage = '';
			}
			$scope.$apply(function(){
				model.assign($scope, inc_gst);
				gp_model.assign($scope,gp_percentage);
			});
			
		});
		
		$scope.gp_percentage = function(e,n){
			var str = 'customer_ex_gst_'+n;
			var str1 = 'customer_inc_gst_'+n;
			var ex_gst_model = $parse(str);
			var inc_gst_model = $parse(str1);
			var ex_gst_val =  parseFloat($scope.cost*e/100) + parseFloat($scope.cost);
			ex_gst_model.assign($scope,ex_gst_val);
			var inc_gst = COUNT_INC_GST(ex_gst_val);
			inc_gst_model.assign($scope,inc_gst);
			  
		}
		
		//add product options
		$scope.add_option = function(){
			if($scope.option){
				var response = $http.get(siteUrl+"/products/getOptionValues/"+$('#options').val());
				response.success(function(res, status, headers, config) {
					if(res.status == 200){
						res.data[0].required = 0;
						$scope.product_options.push(res.data[0]);
						$scope.option = '';
					}
					 
				});
			}
			else {
				alert('Please add option.');
			}
		}
		//delete option
		$scope.delete_option =  function(array,index,option){
			 
			if( typeof product_id != 'undefined'){
				var response = $http.get(siteUrl+"/products/delete_product_option/"+product_id+"/"+option.id);
				response.success(function(res, status, headers, config) {
					array.splice(index,1); 
				});
			}
			else {
				array.splice(index,1);
			}
				 
		}
		
		$scope.productCode =  function(){
			var response = $http.get(siteUrl+"/products/getProductCodes/"+$scope.linked_product);
			response.success(function(res, status, headers, config) {
				$("#link_to_stock").typeahead({
				   source: res
				});
			});
			 
		}
		 
	}
	
	function COUNT_INC_GST(ex){
		var inc_gst = parseFloat(ex*10/100);
		return (inc_gst += parseFloat(ex)).toFixed(2);
	}
 
	$(document).ready(function() {
		$("#options").typeahead({
		   source: options
		});
    });