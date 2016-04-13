@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading text-uppercase" style="color:#888"><i class="fa fa-pencil" style="padding-right: 0.6em"></i>Register</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{URL::asset('/admin/register')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="control-label sr-only">Name</label>
							<div class="input-group col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1">
								<div class="input-group-addon">
									<i class="fa fa-user" aria-hidden="true"></i>
								</div>
								<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="User Name..." autofocus="autofocus">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label sr-only">E-Mail Address</label>
							<div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 input-group">
								<div class="input-group-addon">
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</div>
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email...">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label sr-only">Password</label>
							<div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 input-group">
								<div class="input-group-addon">
									<i class="fa fa-key" aria-hidden="true"></i>
								</div>
								<input type="password" class="form-control" name="password" placeholder="Password...">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label sr-only">Confirm Password</label>
							<div class="col-md-8 col-md-offset-2 col-xs-10 col-xs-offset-1 input-group">
								<div class="input-group-addon">
									<i class="fa fa-lock" aria-hidden="true"></i>
								</div>
								<input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password...">
							</div>
						</div>
						<button type="submit" class="btn btn-primary center-block text-uppercase">
							Register<i class="fa fa-plus" style="padding-left: 0.6em"></i>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
