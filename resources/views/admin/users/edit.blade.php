@extends('layouts/admin')
@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">
			 <strong> Update user </strong>
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
				
			<form class="form-horizontal" role="form" method="POST" action="{{URL::to('admin/users')}}/{{$user->id}}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="_method" value="PUT">
					<div class="form-group">
						<label class="col-md-4 control-label">Name</label>
						<div class="col-md-6">
							<input type="text" class="form-control" name="name" value="{{ $user->name }}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">E-Mail Address</label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email" value="{{ $user->email }}">
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
							<option value="client manager" {{$user->type == 'client manager'?'selected':''}} > Client manager</option>
							<option value="field technician" {{$user->type == 'field technician'?'selected':''}} >Technician</option>
							<option value="operation_manager" {{$user->type == 'operation_manager'?'selected':''}} >Operation manager</option>
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
								Update
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
