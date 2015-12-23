@extends('layouts/admin')

@section('content')

<div class="row">
	<div class="row">
		<a href="<?php echo url(); ?>/admin/processes?test=<?php echo $test_id; ?>" class="btn btn-success pull-right">Add Test Process</a>
	</div>
	<div class="col-md-offset-1" style="padding-top:20px;">
	
		<div class="panel panel-default">
		 
			<div class="panel-heading">
				<h4>Test Process Items</h4>
			</div>
			<div class="panel-body">
			<form class="form-horizontal" role="form" method="post" action="{{URL::to('admin/tests')}}" id="testForm">
					<input type="hidden" name="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border"></legend>
						<div class="form-group">
							<div class="col-md-6 ">
							<ul class="list-group">
							@if($items)
								@foreach($items as $key => $value)
								<li class="list-group-item">{{$value->name}}</li>
								@endforeach
								</ul>
							@else
								<span>No Process Items Selected</span>
							@endif
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
