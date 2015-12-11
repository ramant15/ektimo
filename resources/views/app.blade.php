<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ektimo</title>
	<link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	<script src="{{asset('/js/2.1.3_jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('/js/bootstrap.js')}}" type="text/javascript"></script>
	<script src="{{asset('/js/angular.js') }}" type="text/javascript"></script> 
	<script> var siteUrl = '{{ url("/") }}'; </script>
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
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
		
	.pageHead{
		margin-top:50px;
	}

.login{
	margin-top:20px;
}
 .navbar-header {
    float: left;
    margin-top: -28px;
}
.navbar-brand {
    float: left;
    font-size: 18px;
    height: 93px;
    line-height: 20px;
    padding: 15px;
}
</style>
</head>
<body>
	<div class="container pageHead"> 
	<!-- navigation bar code starts here -->
	
	<div class="container-fluid">
    <div class="navbar-header">
    <a href="{{ url("/") }}" class="navbar-brand"><img src="{{asset('images/logo.png')}}" alt="logo"></a>
    </div>
    <div>
      
      <ul class="nav navbar-nav navbar-right">
      @if (Auth::check())
        <li><a href="#">Welcome <b>{{ucfirst(Auth::user()->name)}}</b></a></li>
        <li><a href="{{URL::to('change-password')}}"><span class="glyphicon glyphicon-user"></span> Edit My Profile</a></li>
        <li><a href="{{URL::to('auth/logout')}}"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        @endif
      </ul>
    </div>
  </div>
	<!-- navigation bar code ends here -->
		
		
		@if ( Session::has('flash_message') )
			<div class="alert {{ Session::get('flash_type') }}">
				<div>{{ Session::get('flash_message') }}</div>
			</div>
			@endif
		@yield('content')
	</div> 
<script>
	$('#confirm-delete').on('show.bs.modal', function(e) {
		var form = $(e.relatedTarget).data('href');
		$('#danger').click(function(){
			$('#'+form).submit();
		});
	})
    </script>
</body>
</html>
