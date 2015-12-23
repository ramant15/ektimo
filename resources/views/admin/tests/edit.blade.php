@extends('layouts/admin')

@section('content')

<div class="row">
	<div class="col-md-10 col-md-offset-1">
	
		<div class="panel panel-default">
		 
			<div class="panel-heading">
				<h4>Add Test</h4>
			</div>
			<div class="panel-body">
			<form class="form-horizontal" role="form" method="post" action="{{URL::to('admin/test/update')}}/{{$test->id}}" enctype="multipart/form-data" id="testForm">
					<input type="hidden" name="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Test Details</legend>
					<div class="form-group required">
						<label class="col-md-4 control-label">Parameter</label>
						<div class="col-md-6">
							<input type="text" id="parameter" class="form-control" name="parameter" value="{{$test->param_name}}">
						</div>
					</div>
					<div class="form-group required">
						<label class="col-md-4 control-label">State</label>
						<div class="col-md-6">
							<input type="text" id="state" class="form-control" name="state" value="{{$test->state_name}}">
						</div>
					</div>
					<div class="form-group required">
						<label class="col-md-4 control-label">Method</label>
						<div class="col-md-6">
							<input type="text" id="method" class="form-control" name="method" value="{{$test->method_name}}">
						</div>
					</div>
					<div class="form-group required">
						<label class="col-md-4 control-label">Test Method</label>
						<div class="col-md-6">
							<input type="text" id="test_method" class="form-control" name="test_method" value="{{$test->test_method_name}}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-4 control-label">Choose items</label>
						<div class="col-md-8">
							<div class="col-md-4">
								<input type="checkbox" id="checkAll"/><span><strong>Select All Items</strong></span>
							</div>
						</div>
						<div class="col-md-8">
						<table class="table table-bordered">
							<tr>
								<th></th>
								<th>Name</th>
								<th>Image</th>
							</tr>
							@foreach($items as $key => $value)
							<tr>
							<?php 
						
							if(!empty($selected_ids) && in_array( $value['id'],$selected_ids)){
								$checked = "checked";
							}else{
								$checked = "";
							}
							?>
							
							
								<td><input type="checkbox" value="{{$value->id}}" name="test_item[{{$value->id}}]" <?php echo $checked; ?> /></td>
								<td>{{$value->name}}</td>
								<td>@if($value->image)
										<img style="height:135px;width:150px;"src="{{ URL::to('/') }}/public/ItemImages/{{$value->image}}">
									@endif
								</td>
							</tr>			
							@endforeach
						</table>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-4 control-label">Price</label>
						<div class="col-md-6">
							<input type="text" id="testPrice" class="form-control" name="price" value="{{$test->price}}">
						</div>
					</div>
					<div class="form-group">
					<label class="col-md-4 control-label">Upload Document</label>
						
						<div class="col-md-6">
						<input type="file" id="testFile" name="test_files[]" value="" multiple>
						<br>
						@if(!empty($documents))
							@foreach($documents as $file)
							{{$file['name']}}
							<a href="{{URL::to('admin/test/delete_file')}}?path={{$file['path']}}&name={{$file['name']}}">Delete</a>
							<br>
							@endforeach
							
						@else
							No documents.
						@endif
						
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
		$("#checkAll").change(function () {
		    $("input:checkbox").prop('checked', $(this).prop("checked"));
		});
	});
  </script>
@endsection
