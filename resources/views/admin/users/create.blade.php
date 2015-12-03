@extends('layouts/admin')
@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
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
						<label class="col-md-4 control-label">Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="{{ old('name') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">E-Mail Address</label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Password</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Confirm Password</label>
						<div class="col-md-6">
							<input type="password" class="form-control" name="password_confirmation">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Type</label>
						<div class="col-md-6">
							<select class="form-control" name="type">
							<option>--Select type--</option>
							<option value="client manager">Client manager</option>
							<option value="field technician">Technician</option>
							<option value="operation_manager">Operation manager</option>
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
							<a href="{{URL::to('admin/users')}}" class="btn btn-primary">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
 
@endsection
