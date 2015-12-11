@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Reset Password</div>
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
					
					<div class="flash-message">
					    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
					      @if(Session::has('alert-' . $msg))
					
					      <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
					      @endif
					    @endforeach
					  </div> <!-- end .flash-message -->

					<form class="form-horizontal" role="form" method="POST" action="{{ url('change_password') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						  <div class="form-group">
							<label for="current_password" class="col-md-4 control-label">Current Password</label>
							<div class="col-sm-6">
							  <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password">
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="new_password" class="col-sm-4 control-label">New Password</label>
							<div class="col-sm-6">
							  <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password">
							</div>
						  </div>
						  
						  <div class="form-group">
							<label for="confirm_password" class="col-sm-4 control-label">Confirm Password</label>
							<div class="col-sm-6">
							  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
							</div>
						  </div>
						  <div class="form-group">
							<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-success">Update</button>
							<button type="button" class="btn btn-danger">Cancel</button>
							</div>
						  </div>
						</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
