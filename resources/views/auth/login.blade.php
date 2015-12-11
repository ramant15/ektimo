@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="login col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong>Invalid login credentials,please check you username or password.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label" for="name">Username<span style="color:red;">*</span></label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Username">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" for="password">Password<span style="color:red;">*</span></label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password" id="password" placeholder="Password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>
 
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
