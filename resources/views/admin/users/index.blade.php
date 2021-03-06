@extends('layouts/admin')
@section('content')

<div class="row">
	<!-- <div class="col-md-10 col-md-offset-1"> -->
		 
		<p class="text-right">
			<a href="users/create" class="btn btn-success">Add New</a>
		</p>
	  
		<div class="panel panel-default">
		 
			<div class="panel-heading">
				<h4>User Listing</h4>
			</div>
		 
			 <table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Type</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php $i = 1 ; ?>
				@foreach($users as $key => $value)
					
					<tr>
						<td>{{ $i }}</td>
						<td>{{ ucwords($value->name) }}</td>
						<td>{{ $value->email }}</td>
						<td>{{ ucfirst($value->type) }}</td>
						<td>
						<form method="POST" action="{{URL::to('admin/users')}}/{{$value->id}}" id="{{ $value->id }}" accept-charset="UTF-8">
								
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="_method" value="DELETE">
							 
							<a class="btn btn-primary" href="{{URL::to('admin/users')}}/{{$value->id}}/edit" role="button"><i class="glyphicon glyphicon-edit"></i> Edit </a> 
							  
							 <a class="btn btn-danger" data-href="{{$value->id}}" data-toggle="modal" data-target="#confirm-delete" href="#"> <i class="glyphicon glyphicon-trash"></i> Delete</a> 
							 
						</form>	
						</td>
					</tr>
					<?php $i++; ?> 
				@endforeach
				</tbody>
			</table>
			 
		</div>
		
		<?php echo $users->render(); ?>
				
	<!-- </div> -->
</div>
 
 
 <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete User</h4>
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
