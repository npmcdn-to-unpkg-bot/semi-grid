@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading text-uppercase" style="color:#888"><i class="fa fa-paper-plane" style="padding-right: 0.6em"></i>Login</div>
				<div class="panel-body">
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

					<form class="form-horizontal" role="form" method="POST" action="{{URL::asset('/admin/login')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="sr-only control-label">E-Mail Address</label>
							<div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</div>
								<input type="email" class="form-control" name="email" value="{{ $_COOKIE['email'] or '' }}" placeholder="Email...">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label sr-only">Password</label>
							<div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 input-group">
								<div class="input-group-addon">
									<i class="fa fa-key" aria-hidden="true"></i>
								</div>
								@if(isset($_COOKIE['email']))
								<input type="password" class="form-control" name="password" placeholder="Password..." autofocus="autofocus">
								@else
								<input type="password" class="form-control" name="password" placeholder="Password...">
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary text-uppercase" style="margin-right: 15px;">
									sigin<i class="fa fa-sign-in" style="margin-left: 0.6em"></i>
								</button>
								<a href="{{URL::asset('/admin/reset')}}">Forgot Your Password?</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
