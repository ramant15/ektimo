<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ektimo</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
	 <!-- Custom CSS -->
	<link href="{{asset('/css/sb-admin-2.css')}}" rel="stylesheet">
	<!-- Custom Fonts -->
    <link href="{{asset('/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
	<script src="{{asset('/js/2.1.3_jquery.min.js')}}"></script>
	<script src="{{asset('/js/angular.js')}}"></script>  
	<script src="{{asset('/js/bootstrap.js')}}"></script>  

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Welcome Admin!</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
               
                <!-- /.dropdown -->
              
                
					@if (Auth::check())
                    <ul>
						<li><a href="{{URL::to('admin/logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
						<!--<li><a href="{{URL::to('admin/editDetail')}}"><i class="fa fa-edit"></i>Edit Profile</a>
                        </li>-->
                    </ul>
					@endif
               </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       
                        <li>
                            <a href="<?php echo url(); ?>/admin/home"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                       <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i>Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">   
								<li>
                                    <a href="<?php echo url(); ?>/admin/users">Add User</a>
                                </li>							
								<li>
                                    <a href="<?php echo url(); ?>/admin/processes">Test Processes</a>
                                </li>
								<li>
                                    <a href="<?php echo url(); ?>/admin/tests">Tests Listing</a>
                                </li>
								<li>
                                    <a href="<?php echo url(); ?>/admin/tests/create">Add Test</a>
                                </li>
								<li>
                                    <a href="<?php echo url(); ?>/admin/process-items">Add Process Items</a>
                                </li>
								<li>
                                    <a href="<?php echo url(); ?>/admin/location-types">Add Location Types</a>
                                </li>
                            </ul>
                        </li>
                            <!-- /.nav-second-level -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
		<br>
           @if ( Session::has('flash_message') )
		  <div class="alert {{ Session::get('flash_type') }}">
			 {{ Session::get('flash_message') }}
		  </div>
		@endif
		@yield('content')
         
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<style>
.dataTable_wrapper table {
    font-size: 14px;
}
</style>
</body>
</html>
