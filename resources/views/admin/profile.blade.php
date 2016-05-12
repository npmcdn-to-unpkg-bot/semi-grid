@extends('admin.admin') 

@section('head')
<link rel="stylesheet" href="{{URL::asset('/assets/css/profile-blade-style.css')}}">
@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-pencil-square-o" style="padding: 0 0.5em"></i>Edit Your Profile</h3>
	</div>
</div>
@if(session('status'))
<div class="row">
	<div class="alert alert-{{ session('class') }} alert-dismissible col-sm-offset-2 col-sm-8" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong style="padding-right: 1em;"><i class="fa fa-bell fa-fw"></i></strong>{{session('status')}}
	</div>
</div>
@endif
<div class="row">
	<div class="col-sm-8 col-sm-offset-2 user-profile">
		<form action="{{URL::asset('/admin/update')}}" method="POST" class="form">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="input-group-admin">
				<label for="name"><i class="fa fa-user fa-fw"></i></label>
				<input type="text" class="input-profile" id="name" name="name" value="{{$user->name}}">
				<i class="addon fa fa-pencil"></i>
			</div>
			<div class="input-group-admin">
				<label for="email"><i class="fa fa-envelope fa-fw"></i></label>
				<input type="text" class="input-profile" id="email" name="email" value="{{$user->email}}" disabled>
			</div>
			<div class="input-group-admin">
				<label for="time"><i class="fa fa-clock-o"></i></label>
				<input type="text" class="input-profile" id="time" name="last_login_time" value="{{$user->last_login_time}}" disabled>
			</div>
			<div class="input-group-admin">
				<label for="submit"><i class="fa fa-floppy-o"></i></label>
				<input type="submit" class="btn btn-default" id="submit" value="SAVE">
			</div>
		</form>
	</div>
</div>
@endsection
