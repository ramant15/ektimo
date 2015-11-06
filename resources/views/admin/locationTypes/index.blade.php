@extends('layouts/admin')
@section('content')
<div class="row">
		<a href="<?php echo url(); ?>/admin/location-types/create" class="btn btn-primary pull-right">Add Location Type</a>
	</div>
<div class="row" style="padding-top:20px;">	  
		<div class="panel panel-default">
		 
			<div class="panel-heading">
				<h4>Location Typs</h4>
			</div>
		 
			 <table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>Location Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php $i = 1 ; ?>
				@foreach($items as $key => $value)
				<tr>
				<td><?php  echo $i; ?></td>
				<td>{{ $value->name }}</td>
				<td>
					<form method="POST" action="{{URL::to('admin/location-types')}}/{{$value->id}}" id="{{ $value->id }}" accept-charset="UTF-8">
								
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="_method" value="DELETE">
							 
					<a class="btn btn-primary" href="{{URL::to('admin/location-types')}}/{{$value->id}}/edit" role="button"><i class="glyphicon glyphicon-edit"></i> Edit </a> 
							  
				    <a class="btn btn-danger" data-href="{{$value->id}}" data-toggle="modal" data-target="#confirm-delete" href="#"> <i class="glyphicon glyphicon-trash"></i> Delete</a> 
							 
					</form>	
				</td>
				</tr>
				<?php $i++;  ?>
				@endforeach
				</tbody>
			</table>
			 
		</div>
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
  

<script>
	$('#confirm-delete').on('show.bs.modal', function(e) { 
		var form = $(e.relatedTarget).data('href');
		$('#danger').click(function(){
			$('#'+form).submit();
		});
	})
</script>   
    
@endsection