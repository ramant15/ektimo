@extends('layouts/admin')
@section('content')

<div class="row">
	<!-- <div class="col-md-10 col-md-offset-1"> -->
	
		<div class="panel panel-default">
		 
			<div class="panel-heading">
				<h4>Add Test Processes</h4>
			</div>
			<div class="panel-body">
			<form class="form-horizontal" role="form" method="post" action="{{URL::to('admin/processes')}}" id="processForm">
					<input type="hidden" name="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label class="col-md-4 control-label">Select process</label>
						<div class="col-md-6">
							<select class="form-control" id="test" name="test">
							<option>--- Select test ---</option>
							@foreach($tests as $key => $value)
						<option value="{{$value->id}}">{{ str_limit($value->parameter.', '.$value->state.', '.$value->method.', '.$value->test_method, $limit = 50, $end = '...') }}</option>
							@endforeach
							</select>
						</div>
					</div>
  					
					<div class="form-group">
						<label class="col-md-4 control-label">Choose item</label>
					
						<div class="col-md-8">
							@foreach($items as $key => $value)
							<div class="col-md-4">
							<input type="checkbox" value="{{$value->id}}" name="test_item[{{$value->id}}]" @if(!empty($processes) && in_array($value->id, $processes)) checked @endif >
							{{$value->name}}
							</div>
							@endforeach
						</div>
					</div>
				
					<div class="form-group">
						<label class="col-md-4 control-label">Check all</label>
						<div class="col-md-8">
						<div class="col-md-4">
							<input type="checkbox" id="checkAll"/>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">
								Save
							</button>
							
						</div>
					</div>
				</form>
			</div> 
		</div>
	<!-- </div> -->
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
