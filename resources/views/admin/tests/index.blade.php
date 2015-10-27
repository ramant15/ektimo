@extends('layouts/admin')
@section('content')
	<div class="row">
		<a href="<?php echo url(); ?>/admin/tests/create" class="btn btn-primary pull-right">Add Test</a>
	</div>
	<div class="row" style="padding-top:20px;">
		<div class="">		
			<div class="panel panel-default">
				<div class="panel-heading">Tests</div>
				<div class="panel-body">
				<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>S.NO</th>
						<th>Parameter</th>
						<th>State</th>
						<th>Method</th>
						<th>Test Method</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php $i = 1 ; ?>
					@foreach($tests as $key => $value)
					<tr> 
						<td>{{ $i }}</td>
						<td>{{ $value->parameter }}</td>
						<td>{{ $value->state }}</td>
						<td>{{ $value->method }}</td>
						<td>{{ $value->test_method }}</td>
						<td>
						<a class="btn btn-primary" href="{{URL::to('admin/tests/process_items')}}/{{$value->id}}" role="button"><i class="glyphicon glyphicon-edit"></i> View Items </a> 
						&nbsp;
						<form method="POST" action="{{URL::to('admin/tests')}}/{{$value->id}}" id="{{ $value->id }}" accept-charset="UTF-8">
								
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="_method" value="DELETE">
							 
							 <!--<a class="btn btn-danger" data-href="{{$value->id}}" data-toggle="modal" data-target="#confirm-delete" href="#"> <i class="glyphicon glyphicon-trash"></i> Delete</a>-->
						</form>	
						</td>
			
					</tr>
					<?php $i++; ?>
				@endforeach
				</tbody>
				</table> 
				</div>
			</div>
		</div>
	</div>

 <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Test</h4>
                </div>
            
                  <div class="modal-body">
					Are you sure want to delete?
				  </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-danger" id="danger">Delete</a>
                </div>
            </div>
        </div>
</div>
@endsection