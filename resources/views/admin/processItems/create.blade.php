@extends('layouts/admin')
@section('content')
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="panel panel-default">
			<div class="panel-heading">
			 <strong> Create Process Item </strong>
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
				
			<form class="form-horizontal" role="form" method="POST" action="{{URL::to('admin/process-items')}}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group">
						<label class="col-md-4 control-label">Item name</label>
						<div class="col-md-6">
							<input type="text" name="name">
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								Add
							</button>
							<a href="{{URL::to('admin/process-items')}}" class="btn btn-primary">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
 
@endsection
