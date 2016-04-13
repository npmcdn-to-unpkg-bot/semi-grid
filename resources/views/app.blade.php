<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{$action or ''}}Laravel</title>
	<link href="{{URL::asset('/assets/css/app.css')}}" rel="stylesheet">
	<!-- Fonts -->
	<link href='http://fonts.useso.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link href="{{URL::asset('/assets/bower/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<i class="fa fa-navicon"></i>
					<!-- <span class="glyphicon glyphicon-menu-hamburger"></span> -->
				</button>
				<a class="navbar-brand" href="{{URL::asset('/')}}">SEMI-GRID</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{URL::asset('/admin/login')}}">Login</a></li>
						<li><a href="{{URL::asset('/admin/register')}}">Register</a></li>
					@else
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{URL::asset('/auth/logout')}}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	@yield('content')
	<div class="text-center footer" style="color: #888; font-size: 0.8em">SEMI-GRID&copy;by <i>Monster</i> <small>base on Laravel 5</small></div>
	<!-- Scripts -->
	<!-- jQuery -->
	<script src="{{URL::asset('/assets/bower/jquery/dist/jquery.min.js')}}"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="{{URL::asset('/assets/bower/bootstrap/dist/js/bootstrap.min.js')}}"></script>
</body>
</html>
