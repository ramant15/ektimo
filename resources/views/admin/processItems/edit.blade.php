@extends('layouts/admin')
@section('content')
<div class="row">
	<!-- <div class="col-md-10 col-md-offset-1"> -->
		<div class="panel panel-default">
			<div class="panel-heading">
			 <strong> Update Process Item </strong>
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
				
			<form class="form-horizontal" role="form" method="POST" action="{{URL::to('admin/process-items')}}/{{$item->id}}" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="_method" value="PUT">
					<div class="form-group">
						<label class="col-md-4 control-label">Name</label>
						<div class="col-md-6">
							<input class="form-control" type="text" name="name" value="{{$item->name}}">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Item Image</label>
						<div class="col-md-6">
						<img style="height:200px;width:200px;"src="{{ URL::to('/') }}/public/ItemImages/{{$item->image}}">
						<br/><br/>
							<input class="form-control" type="file" id="itemImage" name="image" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Item Type</label>
						<div class="col-md-6">
							<select name="type" class="form-control" >
								<option value="">--Select Type---</option>
								<option value="equipment" {{$item->type == 'equipment'? 'selected':''}} > Equipment</option>
								<option value="consumable" {{$item->type == "consumable" ? 'selected' :''}} >Consumable</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								Update
							</button>
							<a href="{{URL::to('admin/process-items')}}" class="btn btn-danger">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	<!-- </div> -->
</div>
@endsection
