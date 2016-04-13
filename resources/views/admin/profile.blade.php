@extends('admin.admin') 

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
<style type="text/css">
.user-profile {
	border-left: #D9D9D9 solid 1px;
	margin-top: 40px;
	padding-bottom: 40px;
	padding-left: 0;
}

@media screen and (max-width: 768px) {
	.user-profile {
		border: none;
	}
	.form {
		margin: auto;
	}
	.input-profile {
		width: auto;
		margin-left: 20px;
	}
}

.form {
	position: relative;
	width: 285px;
	left: -15px;
}

.input-group-admin {
	position: relative;
	margin-top: 40px;
	margin-bottom: 50px;
}

.input-group-admin .addon {
	position: absolute;
	line-height: 30px;
	right: 0;
	top: 0;
}

.input-group-admin label {
	border: solid 1px #D9D9D9;
	line-height: 30px;
	text-align: center;
	width: 30px;
	border-radius: 100px;
	background-color: #fff;
	outline: solid 5px #fff;
	position: relative;
	cursor: pointer;
}

@media screen and (min-width: 768px) {
	.input-group-admin label:before {
		content: "User Name";
		position: absolute;
		top: 5px;
		width: 80px;
		left: -88px;
		padding: 0 0.5em;
		line-height: 25px;
		font-size: 10px;
		font-weight: lighter;
		background-color: #555;
		color: #fff;
		border-radius: 4px;
		visibility: hidden;
		opacity: 0;
		transition: opacity 0.3s;
	}
	.input-group-admin label[for="email"]:before {
		content: "Login Email";
	}
	.input-group-admin label[for="time"]:before {
		content: "Last Login Time";
		width: 100px;
		left: -108px;
	}
	.input-group-admin label[for="submit"]:before {
		content: "Save Change";
		width: 90px;
		left: -98px;
	}
	.input-group-admin label:after {
		content: "";
		position: absolute;
		visibility: hidden;
		top: 13px;
		left: -10px;
		width: 0;
		height: 0;
		border-top: 5px solid transparent;
		border-left: 10px solid #555;
		border-bottom: 5px solid transparent;
		opacity: 0;
		transition: opacity 0.5s;
	}
	.input-group-admin label:hover:before,
	.input-group-admin label:hover:after {
		visibility: visible;
		opacity: 1;
	}
}

.input-profile {
	border: none;
	outline: none;
	border-bottom: solid 1px #888;
	text-align: center;
	font-family: "Roboto", Helvetica, Arial, sans-serif !important;
	font-weight: lighter;
	width: 210px;
	background-color: #fff !important;
	margin-left: 40px;
}

input:-webkit-autofill,
textarea:-webkit-autofill,
select:-webkit-autofill {
	background-color: #fff;
	background-image: none;
}

.form input:disabled {
	font-style: italic;
	cursor: not-allowed;
	color: #888;
	background-color: #fff;
}

.input-group-admin input#submit {
	width: 210px;
	border-radius: 0;
	border-color: #888;
	margin-left: 40px;
	transition: background-color 0.3s;
}
</style>
@endsection
