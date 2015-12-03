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
</head>
<body>
<div class="container" ng-app="" ng-controller="User">
<div class="logo"> <img src="images/logo.png"></div>
@if ( Session::has('flash_message') )
			<div class="alert {{ Session::get('flash_type') }}">
				<div>{{ Session::get('flash_message') }}</div>
			</div>
@endif


<div class="pre-order">
<h3 class="client-pre-order"> Client request pre order </h3>
	<div class="form-group required">
		<label class="col-md-2 control-label">Request To</label>
		<div class="col-md-3">
			 
			<select id="requestTo" class="form-control" ng-model="requestTo" ng-change="getInfo()" ng-init="requestTo=0">
			<option value="0">-select-</option>
			<option ng-repeat="client in clients track by $index" value="@{{client.id}}">@{{client.role}}</option>
			 
			</select>
			 
		</div>
	</div>

  <br/>


<div class="content-ektimo">
<div class="date">May 4,2015 at 2:46 pm </div>
<strong class="colr-head">Client details:</strong>
 

<p ng-show="clientDetails">
 Name : <span>@{{name}}</span><br/>
 Email : <span>@{{email}}</span>
</p></div>

<div class="previous-section">
<strong class="colr-head">Previous client order:</strong> <span class="arrow pull-right"><img src="images/arrow.png" > </span>

<p class="previous-con-tent">Lorem lpsum is simply dummy text of the printing and  <span class="pull-right pre-vious">Jan 21,2015 at 1:18pm </span> <br>
typesetting industry.Lorem lpsum has been the <br>
industry's standard dummy text ever since the 1500s.  <span class="pull-right pre-vious"> Use again? <button type="button" class="btn btn-success yes-btn">yes</button></span> </p>

</div>
</div>
</div>



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
	
	<div class="container"> 
		@yield('content')
	</div> 
    <script>
	var users = JSON.parse('<?php echo json_encode($users); ?>');
	function User($scope,$http){
		$scope.clients  = users;
		$scope.getInfo = function(){
			$scope.clientDetails = false;
			for(i in users){
				if(users[i].id == $scope.requestTo){
					$scope.clientDetails = true;
					$scope.name = users[i].name;
					$scope.email = users[i].email;
					break;
				}
				 
			}
			
		}
	}
	</script>
</body>
</html>
