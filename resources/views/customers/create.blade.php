@extends('layouts.default')

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
				<div class="create-cus">
				 <H4>CREATE CUSTOMER</H4>
				</div>
                <hr >
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
				<form class="form-horizontal" method="POST" action="{{URL::to('customers')}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">  
					<input type="hidden" name="_method" value="POST">
					
					<div class="scheduler-border">
						<div class="scheduler-border text-center"><!--Customer Details--></div>
						
						<div class="form-group required">
							<label class="col-md-4 control-label" for="contact_name">Contact Name</label>
							<div class="col-md-5">
								<input type="text" id="contact_name" class="form-control" name="contact_name" value="{{ old('contact_name') }}">
							</div>
						</div>
						
						<div class="form-group required">
							<label class="col-md-4 control-label" for="company_name">Company Name</label>
							<div class="col-md-5">
								<input type="text" id="company_name" class="form-control" name="company_name" value="{{ old('company_name') }}">
							</div>
						</div>
						 
							<div class="form-group required">
								<label class="col-md-4 control-label" for="address">Address</label>
								<div class="col-md-5">
									<textarea id="address" class="form-control" name="address" rows="2">{{old('address')}}</textarea>
								</div>
							</div>
							
							<div class="form-group required">
								<label class="col-md-4 control-label" for="telephone_number">Telephone Number</label>
								<div class="col-md-5">
									<input type="text" id="telephone_number" class="form-control" name="telephone_number" value="{{ old('telephone_number') }}">
								</div>
							</div>
							<div class="form-group required">
								<label class="col-md-4 control-label" for="mobile_number">Mobile Number</label>
								<div class="col-md-5">
									<input type="text" id="mobile_number" class="form-control" name="mobile_number" value="{{ old('mobile_number') }}">
								</div>
							</div>
							<div class="form-group required">
								<label class="col-md-4 control-label" for="email_address">Email Address</label>
								<div class="col-md-5">
									<input type="text" id="email_address" class="form-control" name="email_address" value="{{ old('email_address') }}">
								</div>
							</div>
						</div> 
						 
						<div class="text-center">
								<div class="col-md-12">
									<input type="submit" class="btn btn-primary" name="add" value="Add">
									&nbsp;
									<a href="{{URL::to('order')}}" class="btn btn-primary">Cancel</a>
								</div>
						</div>  
						
					</form>
					
				</div>
				
				</div>
			</div>
		</div>
	</div>
 <style>
 .required .control-label:after {
		content: "*";
		color: red;
		font-size: inherit;
		font-weight: 800;
	}
	
	.scheduler-border {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 10px;
}

.create-cus{
	margin-left:10PX;
	margin-top:5px;
}
 </style>
@endsection
