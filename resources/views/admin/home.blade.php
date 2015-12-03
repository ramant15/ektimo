@extends('layouts/admin')

@section('content')
 <div class="row">
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
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
 </div>
<!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                   <div class="row">
                        <div class="col-xs-3">
                           <i class="fa fa-user fa-5x"></i>
                        </div>
						<div class="col-xs-9 text-right">
							<div class="huge"></div>
							<div>Test Processes</div>
						 </div>
                    </div>
                </div>
                <a href="<?php echo url(); ?>/admin/processes">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		<!--
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
						<div class="col-xs-9 text-right">
							<div class="huge"></div>
							<div>Campaign Management</div>
						 </div>
                    </div>
                </div>
                <a href="admin/campaign">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					<div class="clearfix"></div>
                </div>
                </a>
             </div>
        </div>
        <div class="col-lg-3 col-md-6">
           <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                       <div class="col-xs-3">
                             <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
						<div class="col-xs-9 text-right">
                            <div class="huge"></div>
                            <div>Payment</div>
                        </div>
                    </div>
               </div>
                <a href="admin/paymentDetails">
                    <div class="panel-footer">
                       <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>-->
                
@endsection