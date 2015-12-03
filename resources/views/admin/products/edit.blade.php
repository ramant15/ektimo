@extends('app')
@section('content')
 
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
				 
				<H4>Update Product</H4>
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
				
				<form class="form-horizontal" method="POST" action="{{URL::to('admin/products')}}/{{ $product->id }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">  
					<input type="hidden" name="_method" value="PUT">
					
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Details</legend>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="name">Name</label>
							<div class="col-md-4">
								<input type="text" id="name" class="form-control" name="name" value="{{ $product->name }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="sku">Sku</label>
							<div class="col-md-4">
								<input type="text" id="sku" class="form-control" name="sku" value="{{ $product->sku }}">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="price">price</label>
							<div class="col-md-4">
								<input type="text" id="price" class="form-control" name="price" value="{{ $product->price }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="link_to_product">Link to product</label>
							<div class="col-md-4">
								<input type="text" id="link_to_product" class="form-control" name="link_to_product" value="{{$product->link_to_product }}">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="shipping_cost_swiss">Shipping cost swiss</label>
							<div class="col-md-4">
								<input type="text" id="shipping_cost_swiss" class="form-control" name="shipping_cost_swiss" value="{{ $product->shipping_cost_swiss }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="shipping_cost_dutch">Shipping cost dutch</label>
							<div class="col-md-4">
								<input type="text" id="shipping_cost_dutch" class="form-control" name="shipping_cost_dutch" value="{{ $product->shipping_cost_dutch }}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="marketplace">Marketplace</label>
							<div class="col-md-4">
								 
								<select name="marketplace_id" id="marketplace" class="form-control">
									@if($marketplaces)
										@foreach($marketplaces as $key => $val)
											<option value="{{$key}}" @if($key == $product->marketplace_id) selected @endif >{{$val}}</option>
										@endforeach
									@endif
								</select> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="tags">Tags</label>
							<div class="col-md-8">
								<textarea name="tags" id="tags" cols="50">{{ $product->tags }}</textarea> comma separated ex: abc,xyz 
							</div>
						</div>
						
						</fieldset> 
					 
						<div class="pull-right">
							<div class="col-md-12">
								<input type="submit" class="btn btn-primary" name="add" value="Update">
								&nbsp;
								<a href="{{URL::to('admin/products')}}" class="btn btn-primary">Cancel</a>
							</div>
						</div>  
						
				</form>
					
				</div>
				
			</div>
		</div>
		  
    </div>
 
@endsection