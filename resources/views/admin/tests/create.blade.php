@extends('layouts/admin')

@section('content')

<div class="row">
	<div class="col-md-10 col-md-offset-1">
	
		<div class="panel panel-default">
		 
			<div class="panel-heading">
				<h4>Add Test</h4>
			</div>
			<div class="panel-body">
			<form class="form-horizontal" role="form" method="post" action="{{URL::to('admin/tests')}}" enctype="multipart/form-data" id="testForm">
					<input type="hidden" name="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Test Details</legend>
					<div class="form-group required">
						<label class="col-md-4 control-label">Parameter</label>
						<div class="col-md-6">
							<input type="text" id="parameter" class="form-control" name="parameter" value="">
						</div>
					</div>
					<div class="form-group required">
						<label class="col-md-4 control-label">State</label>
						<div class="col-md-6">
							<input type="text" id="state" class="form-control" name="state" value="">
						</div>
					</div>
					<div class="form-group required">
						<label class="col-md-4 control-label">Method</label>
						<div class="col-md-6">
							<input type="text" id="method" class="form-control" name="method" value="">
						</div>
					</div>
					<div class="form-group required">
						<label class="col-md-4 control-label">Test Method</label>
						<div class="col-md-6">
							<input type="text" id="test_method" class="form-control" name="test_method" value="">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Choose item</label>
						<div class="col-md-8">
							@foreach($items as $key => $value)
							<div class="col-md-4">							
							<input type="checkbox" value="{{$value->id}}" name="test_item[{{$value->id}}]" />
							{{$value->name}}
							</div>
							@endforeach
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Price</label>
						<div class="col-md-6">
							<input type="text" id="testPrice" class="form-control" name="price" value="">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Upload Document</label>
						<div class="col-md-6">
							<input type="file" id="testFile" class="form-control" name="test_files[]" value="" multiple>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								Save
							</button>
							
						</div>
					</div>
					</fieldset>
				</form>
				</div>
		</div>
	</div>
</div>
   <script>
	$(document).ready(function(){
		$('#test').change(function(){
		    var url = 'processes?test='+$(this).val();
			window.location = url;
		});
		var selected_test = '<?php echo Request::input('test'); ?>';
		if(selected_test){
			$('#test').val(selected_test).attr('selected','selected');
		}
	});
  </script>
@endsection
