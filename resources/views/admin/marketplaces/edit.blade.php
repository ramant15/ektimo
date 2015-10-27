@extends('app')
@section('content')
 
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
				 
				<H4>Update Marketplace</H4>
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
				
				<form class="form-horizontal" method="POST" action="{{URL::to('admin/marketplaces')}}/{{ $marketplace->id }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">  
					<input type="hidden" name="_method" value="PUT">
					
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Details</legend>
						
						<div class="form-group">
							<label class="col-md-2 control-label" for="name">Name</label>
							<div class="col-md-4">
								<input type="text" id="name" class="form-control" name="name" value="{{$marketplace->name}}">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="commission">Commission</label>
							<div class="col-md-4">
								<input type="text" id="commission" class="form-control" name="commission" value="{{$marketplace->commission}}">
							</div>%
						</div>
						<div class="form-group">
							<label class="col-md-2 control-label" for="shipping_category">Shipping category</label>
							<div class="col-md-4">
								<input type="text" id="shipping_category" class="form-control" name="shipping_category" value="{{ $marketplace->shipping_category }}">
							</div>
						</div>
						
						</fieldset> 
					 
						<div class="pull-right">
							<div class="col-md-12">
								<input type="submit" class="btn btn-primary" name="add" value="Update">
								&nbsp;
								<a href="{{URL::to('admin/marketplaces')}}" class="btn btn-primary">Cancel</a>
							</div>
						</div>  
						
				</form>
					
				</div>
				
			</div>
		</div>
		  
    </div>
 
@endsection