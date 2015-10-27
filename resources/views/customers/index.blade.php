
@extends('../layouts.admin')

@section('content')
<style>
	.icon { font-size:80px; }
	 
	.dashboard-icon li { margin:50px }
</style>
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			 
			<div class="panel panel-default">
				 
				<form style="padding:10px;" name="search" action="{{URL::to('customers')}}" method="get" class="form-inline">
					<a href="{{URL::to('customers')}}/create" class="pull-right btn btn-success">Add New</a>
					<input type="text" class="form-control" name="q" placeholder="search product" value="{{ old('q') }}" style="width:200px;" required>
					<input type="submit" value="Search" class="btn btn-default">
				</form>
				
				<div class="panel-heading">
					<h4>Customers List</h4>
				</div>
				 
				 <table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Company name</th>
							<th>Customer code</th>
							<th>Salesperson</th>
							<th>Customer type</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
					 
					@if( count ($customers) ) 
						@foreach($customers as $key => $value)
							<tr>
								<td>{{ $value->company_name }}</td>
								<td>{{ $value->customer_code }}</td>
								<td>{{ $value->salesperson }}</td>
								<td>{{ $value->customer_type }}</td>
								  
								<!-- we will also add show, edit, and delete buttons -->
								<td>
					 
									<form method="POST" action="{{URL::to('customers')}}/{{$value->id}}" id="{{ $value->id }}" accept-charset="UTF-8">
									
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="_method" value="DELETE">
									 
									<a class="btn btn-primary" href="{{URL::to('customers')}}/{{$value->id}}/edit" role="button"><i class="glyphicon glyphicon-edit"></i> Edit</a> 
								  
									<a class="btn btn-danger"  data-href="{{ $value->id }}" data-toggle="modal" data-target="#confirm-delete" href="#"  data-token="{{ csrf_token() }}"> <i class="glyphicon glyphicon-trash"></i> Delete</a>  
									
									</form>
								</td>
							</tr>
						@endforeach
					@else
						<tr><td colspan="5">There are no customers</td></tr>
					@endif
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
                    <h4 class="modal-title" id="myModalLabel">Delete Customer</h4>
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
