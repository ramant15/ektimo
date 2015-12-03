@extends('../layouts.admin')

@section('content')
<style>
	.icon { font-size:80px; }
	.dashboard-icon li { margin:50px }
	fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
	
</style>
<script src="{{asset('/js/bootstrap-typeahead.js')}}"></script>
 
<div class="container" ng-app="">
	<div class="row" ng-controller="Product">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
				 <H4>IMPORT PRODUCTS</H4>
				</div>
				<div class="panel-body">
				
				<form class="form-horizontal" method="POST" action="{{URL::to('products')}}/get_import"  enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">  
					<input type="hidden" name="_method" value="POST">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Upload CSV file</legend>
						<div class="form-group">

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
						
						<div class="form-group">
							<label class="col-md-3 control-label" for="file">Choose file to upload</label>
							<div class="col-md-4">
								<input type="file" id="file" class="form-control" name="file"/>
							</div>
						</div>
						
						</fieldset> 
						  
						<div class="pull-right">
							<div class="col-md-12">
								<input type="submit" class="btn btn-primary" name="Save File" value="Save File">
								&nbsp;
								<a href="{{URL::to('products')}}" class="btn btn-primary">Cancel</a>
							</div>
						</div>  
						
					</form>
					
				</div>
				
				</div>
			</div>
		   
    </div>
</div>
  
@endsection
