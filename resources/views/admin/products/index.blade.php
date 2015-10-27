@extends('app')

@section('content')
 
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			
			<form style="padding:10px;" name="search" action="{{URL::to('admin/products')}}" method="get" class="form-inline">
					<a href="{{URL::to('admin/products')}}/create" class="pull-right btn btn-success">Add New</a>
					<input type="text" class="form-control" name="q" placeholder="search product" value="{{ old('q') }}" style="width:200px;" required>
					<input type="submit" value="Search" class="btn btn-default">
			</form>
			 
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Products</h4>
				</div>
				 <table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Sku</th>
							<th>Price</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php $i = 1 ; ?>
					 
					@foreach($products as $value)
						
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $value->name  }}</td>
							<td>{{ $value->sku }}</td>
							<td>{{ $value->price }}</td>
							<td>
							<form method="POST" action="{{URL::to('admin/products')}}/{{$value->id}}" id="{{ $value->id }}" accept-charset="UTF-8">
									
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="_method" value="DELETE">
								 
								<a class="btn btn-primary" href="{{URL::to('admin/products')}}/{{$value->id}}/edit" role="button"><i class="glyphicon glyphicon-edit"></i> Edit </a> 
								  
								 <a class="btn btn-danger" data-href="{{$value->id}}" data-toggle="modal" data-target="#confirm-delete" href="#"> <i class="glyphicon glyphicon-trash"></i> Delete</a> 
								 
							</form>	
							</td>
						</tr>
						<?php $i++; ?> 
					@endforeach
					 
					</tbody>
				</table> 
				
			</div>
			<?php echo $products->render(); ?>
		</div>
		
		
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Marketplace</h4>
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
	
</div>
 
@endsection
