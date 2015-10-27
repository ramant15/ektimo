@extends('app')
@section('content')
<style>
	.icon { font-size:80px; }
	.dashboard-icon li { margin:50px }
	fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
	
</style>
 
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
				 <H4>EDIT CUSTOMER</H4>
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
				<form class="form-horizontal" method="POST"
				action="{{URL::to('customers')}}/{{ $customer->id }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">  
					<input type="hidden" name="_method" value="PUT">
					
					<fieldset class="scheduler-border">
					<legend class="scheduler-border">Customer Details</legend>
					
					<div class="form-group required">
						<label class="col-md-4 control-label" for="contact_name">Contact Name</label>
						<div class="col-md-5">
							<input type="text" id="contact_name" class="form-control" name="contact_name" value="{{$customer->contact_name}}">
						</div>
					</div>
					
					<div class="form-group required">
						<label class="col-md-4 control-label" for="company_name">Company Name</label>
						<div class="col-md-5">
							<input type="text" id="company_name" class="form-control" name="company_name" value="{{$customer->company_name}}">
						</div>
					</div>
					 
						<div class="form-group required">
							<label class="col-md-4 control-label" for="address">Address</label>
							<div class="col-md-5">
								<textarea id="address" class="form-control" name="address" rows="2">{{$customer->address}}</textarea>
							</div>
						</div>
						
						<div class="form-group required">
							<label class="col-md-4 control-label" for="telephone_number">Telephone Number</label>
							<div class="col-md-5">
								<input type="text" id="telephone_number" class="form-control" name="telephone_number" value="{{ $customer->telephone_number }}">
							</div>
						</div>
						<div class="form-group required">
							<label class="col-md-4 control-label" for="mobile_number">Mobile Number</label>
							<div class="col-md-5">
								<input type="text" id="mobile_number" class="form-control" name="mobile_number" value="{{ $customer->mobile_number }}">
							</div>
						</div>
						<div class="form-group required">
							<label class="col-md-4 control-label" for="email_address">Email Address</label>
							<div class="col-md-5">
								<input type="text" id="email_address" class="form-control" name="email_address" value="{{ $customer->email_address }}">
							</div>
						</div>
					</fieldset>  
					<div class="pull-right">
							 
						<div class="col-md-12">
							<input type="submit" class="btn btn-primary" name="Update" value="Update">
							&nbsp;
							<a href="{{URL::to('order')}}?c={{$customer->id}}" class="btn btn-primary">Cancel</a>
						</div>
					</div>  
						
					</form>
					
				</div>
				
				</div>
			</div>
		</div>
	</div>
@endsection
