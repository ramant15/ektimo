<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ektimo</title>

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


	
	<div class="container" ng-app="" ng-controller="User">
	<div class="logo"> <a href="{{ url("/") }}"><img src="{{asset('images/logo.png')}}"></a>  <a class="btn btn-success pull-right login-btn" href="{{URL::to('auth/logout')}}">Logout</a></div>
		@yield('content')
	</div> 
   
</body>
</html>

<style>
.login-btn {
    margin-top: 20px;
}

</style>
