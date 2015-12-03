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
				 <H4>EDIT TEST LOCATION</H4>
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
				<form class="form-horizontal" method="POST" action="{{URL::to('customers/locationUpdate')}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">  
					<input type="hidden" name="_method" value="POST">
					<input type="hidden" name="site_id" value="{{$location->site_id}}">
					<input type="hidden"  name="id" value="{{$location->id}}">
					<input type="hidden"  name="c_id" value="<?php echo Request::input('c'); ?>">
					<div class="scheduler-border">
						<div class="scheduler-border"><!--Test Location--></div>
						
						 <div class="form-group required">
							<label class="col-md-4 control-label" for="company_name">Name</label>
							<div class="col-md-5">
								<input type="text" id="company_name" class="form-control" name="name" value="{{$location->name}}">
							</div>
						</div>
						<div class="form-group required">
								<label class="col-md-4 control-label" for="email_address">Description </label>
								<div class="col-md-5">
									<textarea id="address" class="form-control" name="description" rows="2">{{$location->description}}</textarea>
								</div>
						</div>
						<div class="form-group required">
							<label class="col-md-4 control-label" for="email_address">Location ID </label>
							<div class="col-md-5">
								<input type="text" id="location_id" class="form-control" name="location_id" value="{{$location->location_id}}">
							</div>
						</div>
						<div class="form-group required">
							<label class="col-md-4 control-label">Location Type</label>
							<div class="col-md-5">
								<select class="form-control" id="test" name="type">
                                    <option value="">--- Select type ---</option>
                                    @foreach($locations_type as $val)
                                        <option value="{{$val['id']}}" {{$location->type == $val['id'] ? 'selected':''}}>{{$val['name']}}</option>
                                    @endforeach
                                    
                                </select> 
							</div>
						</div>
						<div class="form-group required">
							<label class="col-md-4 control-label">Select Test</label>
							<div class="col-md-5">
								<select class="form-control" id="test" name="test_id">
								@foreach($tests as $key => $value)
								<option value="{{$value->id}}" @if($location->test_id == $value->id) selected @endif}} >{{ $value->parameter.', '.$value->state.', '.$value->method.', '.$value->test_method }}</option>
									@endforeach
								</select>
							</div>
						</div>
						</div> 
						 
						<div class="text-center">
								<div class="col-md-12">
									<input type="submit" class="btn btn-primary" name="add" value="Update">
									&nbsp;
									<a href="{{URL::to('order')}}?c=<?php echo Request::input('c'); ?>&st={{$location->site_id}}&lc={{$location->id}}" class="btn btn-primary">Cancel</a>
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
	
	.create-cus{
	margin-left:10PX;
	margin-top:5px;
}
 </style>
@endsection
