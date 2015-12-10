<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ektimo</title>
	<link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}" type="image/x-icon">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/style.css') }}" rel="stylesheet">
	<script src="{{asset('/js/angular.js') }}" type="text/javascript"></script> 
	<script src="{{asset('/js/2.1.3_jquery.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('/js/bootstrap.js')}}" type="text/javascript"></script>
	<script src="{{asset('/js/jquery.fastLiveFilter.js')}}" type="text/javascript"></script>
	<script> var siteUrl = '{{ url("/") }}'; </script>
	<style>
	.previous-con-tent {
		margin-top: 20px;
	}
	</style>
</head>
<body>


	<!--<nav class="navbar navbar-default">
			<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/order/') }}">Home</a></li>
				</ul>
				
			<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
				
				
			</div>
		</div>
		 
	</nav>-->
	
	<div class="container" ng-app="" ng-controller="User">
	<div class="logo"> <a href="{{ url("/") }}"><img src="{{asset('images/logo.png')}}"></a>  <a class="btn btn-success pull-right login-btn" href="{{url('/auth/login')}}">Login</a></div>
		@yield('content')
	</div> 
   
</body>
</html>

<style>
.login-btn {
    margin-top: 20px;
}

</style>
