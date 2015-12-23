@extends('layouts/admin')
@section('content')
<div class="row">
	<!-- <div class="col-md-10 col-md-offset-1"> -->
		<div class="panel panel-default">
			<div class="panel-heading">
			 <strong> Create user </strong>
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
				
			<form class="form-horizontal" role="form" method="POST" action="{{URL::to('admin/users')}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label class="col-md-4 control-label" for="name">Name <span style="color:red;">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label" for="username">Username <span style="color:red;">*</span></label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="username" value="{{ old('username') }}" id="username">
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-md-4 control-label" for="email">E-Mail Address <span style="color:red;">*</span></label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label" for="password">Password <span style="color:red;">*</span></label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password" id="password">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label" for="password_confirmation">Confirm Password <span style="color:red;">*</span></label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Type <span style="color:red;">*</span></label>
						<div class="col-md-6">
							<select class="form-control" name="type">
							<option>--Select type--</option>
							<option value="client manager">Client manager</option>
							<option value="field technician">Technician</option>
							<option value="operation_manager">Operation manager</option>
							<option value="laboratory">Laboratory manager</option>
							</select>
						</div>
					</div>
					<div class="form-group">
					<label class="col-md-4 control-label">Status</label>
						<div class="col-md-6">
							<select class="form-control" name="status">
							<option value="1">Active</option>
							<option value="0">Inactive</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								Add
							</button>
							<a href="{{URL::to('admin/users')}}" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	<!-- </div> -->
</div>
 
@endsection
