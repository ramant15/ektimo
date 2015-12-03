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
				 <H4>{{$user->contact_name}}'s SITE DETAIL</H4>
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
				<form class="form-horizontal" method="POST" action="{{URL::to('customer/addSiteDetail')}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">  
					<input type="hidden" name="_method" value="POST">
					<input type="hidden"  name="customer_id" value="<?php echo Request::input('c'); ?>">
					<div class="scheduler-border">
						<div class="scheduler-border text-center"><!--Site Details--></div>
						<div class="form-group required">
							<label class="col-md-4 control-label" for="company_name">Company Name</label>
							<div class="col-md-5">
								<input type="text" id="company_name" class="form-control" name="company_name" value="{{$user->company_name}}">
							</div>
						</div>
						 <div class="form-group required">
							<label class="col-md-4 control-label" for="company_name">Site Name</label>
							<div class="col-md-5">
								<input type="text" id="company_name" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>
							<div class="form-group required">
								<label class="col-md-4 control-label" for="address">Site Address</label>
								<div class="col-md-5">
									<textarea id="address" class="form-control" name="address" rows="2">{{old('address')}}</textarea>
								</div>
							</div>
							<div class="form-group required">
							<label class="col-md-4 control-label">Select State</label>
							<div class="col-md-5">
								<select class="form-control" id="test" name="state_id">
									<option value="">--- Select State ---</option>
									@foreach($states as $key => $value)
									<option value="{{$value->id}}">{{ $value->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
							<div class="form-group required">
								<label class="col-md-4 control-label" for="telephone_number">Site Telephone Number</label>
								<div class="col-md-5">
									<input type="text" id="telephone_number" class="form-control" name="phone" value="{{ old('phone') }}">
								</div>
							</div>
							<div class="form-group required">
								<label class="col-md-4 control-label" for="email_address">Site Email </label>
								<div class="col-md-5">
									<input type="email" id="email_address" class="form-control" name="email" value="{{ old('email') }}">
								</div>
							</div>
							<div class="form-group required">
								<label class="col-md-4 control-label" for="email_address">Site Contact </label>
								<div class="col-md-5">
									<input type="text" id="contact" class="form-control" name="contact" value="{{ old('contact') }}">
								</div>
							</div>
							<div class="form-group required">
								<label class="col-md-4 control-label" for="email_address">Description </label>
								<div class="col-md-5">
									<textarea id="address" class="form-control" name="description" rows="2">{{old('description')}}</textarea>
								</div>
							</div>
						</div> 
						 
						<div class="pull-right">
								<div class="col-md-12">
									<input type="submit" class="btn btn-primary" name="add" value="Add">
									&nbsp;
									<a href="{{URL::to('order')}}?c=<?php echo Request::input('c'); ?>" class="btn btn-primary">Cancel</a>
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
