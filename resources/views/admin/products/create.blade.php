@extends('app')
@section('content')
 
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
				 <H4>Create New Product</H4>
				</div>
				<div class="panel-body">
				
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
				
				<form class="form-horizontal" method="POST" action="{{URL::to('admin/products')}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">  
					<input type="hidden" name="_method" value="POST">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Details</legend>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="name">Name</label>
							<div class="col-md-4">
								<input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="sku">Sku</label>
							<div class="col-md-4">
								<input type="text" id="sku" class="form-control" name="sku" value="{{ old('sku') }}">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="price">price</label>
							<div class="col-md-4">
								<input type="text" id="price" class="form-control" name="price" value="{{ old('price') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="link_to_product">Link to product</label>
							<div class="col-md-4">
								<input type="text" id="link_to_product" class="form-control" name="link_to_product" value="{{ old('link_to_product') }}">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="shipping_cost_swiss">Shipping cost swiss</label>
							<div class="col-md-4">
								<input type="text" id="shipping_cost_swiss" class="form-control" name="shipping_cost_swiss" value="{{ old('shipping_cost_swiss') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="shipping_cost_dutch">Shipping cost dutch</label>
							<div class="col-md-4">
								<input type="text" id="shipping_cost_dutch" class="form-control" name="shipping_cost_dutch" value="{{ old('shipping_cost_dutch') }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="marketplace">Marketplace</label>
							<div class="col-md-4">
								 
								<select name="marketplace_id" id="marketplace" class="form-control">
									@if($marketplaces)
										@foreach($marketplaces as $key => $val)
											<option value="{{$key}}">{{$val}}</option>
										@endforeach
									@endif
								</select> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="tags">Tags</label>
							<div class="col-md-8">
								<textarea name="tags" id="tags" cols="50">{{ old('tags') }}</textarea> comma separated ex: abc,xyz 
							</div>
						</div>
						
						</fieldset> 
						 
						<div class="pull-right">
							<div class="col-md-12">
								<input type="submit" class="btn btn-primary" name="add" value="Add">
								&nbsp;
								<a href="{{URL::to('admin/products')}}" class="btn btn-primary">Cancel</a>
							</div>
						</div>  
						
					</form>
					
				</div>
				
				</div>
			</div>
		  
	</div>
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Product</h4>
                </div>
            
                  <div class="modal-body">
					Are you sure want to delete?
				  </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger" id="danger">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection