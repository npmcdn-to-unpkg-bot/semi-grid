@extends('admin.admin') 

@section('head')
<link rel="stylesheet" href="{{URL::asset('/assets/bower/editor.md/css/editormd.min.css') }}" />
<link href="{{ URL::asset('/assets/bower/iCheck/skins/square/grey.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row" style="padding-top: 3em;">
	@if(session('status'))
	<div class="row">
		<div class="alert alert-{{ session('class') }} alert-dismissible col-sm-offset-2 col-sm-8" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong style="padding-right: 1em;"><i class="fa fa-bell fa-fw"></i></strong>{{session('status')}}
			@if(count($errors)>0)
			<br><br>
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
			@endif
		</div>
	</div>
	@endif
	<div class="panel panel-default">
		<div class="panel-heading"><i class="fa fa-edit" style="padding: 0 0.5em"></i>Create</div>
		<div class="panel-body">
			<form action="{{ URL::asset('/admin/blog/storearticle') }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="store" value="create">
				<input type="text" name="title" class="form-control" required="required" placeholder="Title..." value="{{ Request::old('title') }}">
				<br>
				<input type="text" name="tag" class="form-control" placeholder="Tag..." value="{{ Request::old('tag') }}">
				<br>
				<input type="text" name="intro" class="form-control" placeholder="Introduce..." value="{{ Request::old('intro') }}">
				<br>
				<div id="editormd" style="z-index: 800; border-radius: 4px;">
					<textarea style="display:none;" name="content" required="required">{{ Request::old('content') }}</textarea>
				</div>
				<br>
				<button class="btn btn-default btn-info">Add</button>
			</form>
			<div class="editormd-dialog editormd-dialog-info setting-dialog">
				<div class="editormd-dialog-container">
					<h6 class="text-center">CODE AREA THEME</h6>
					<label style="width: 90%" for="baz[0]">Default</label>
					<input type="radio" name="code" id="baz[0]" value="default" checked><br>

					<label style="width: 90%" for="baz[1]">Monokai</label>
					<input type="radio" name="code" id="baz[1]" value="monokai"><br>

					<label style="width: 90%" for="baz[2]">Ambiance</label>
					<input type="radio" name="code" id="baz[2]" value="ambiance"><br>

					<h6 class="text-center">PREVIEW AREA THEME</h6>
					<label style="width: 90%" for="baz[3]">Default</label>
					<input type="radio" name="preview" id="baz[3]" value="default" checked><br>

					<label style="width: 90%" for="baz[4]">Dark</label>
					<input type="radio" name="preview" id="baz[4]" value="dark"><br>

					<h6 class="text-center">TOOLBAR AREA SETTING</h6>
					<label style="width: 90%" for="baz[5]">Disable Tool Bar</label>
					<input type="checkbox" name="toolbar_display" id="baz[5]"><br>

					<label style="width: 90%" for="baz[6]">Disable Tool Bar Auto Fixed</label>
					<input type="checkbox" name="toolbar_fixed" id="baz[6]"><br>

					<label style="width: 90%" for="baz[7]">Default</label>
					<input type="radio" name="toolbar_theme" id="baz[7]" value="default" checked><br>

					<label style="width: 90%" for="baz[8]">Dark</label>
					<input type="radio" name="toolbar_theme" id="baz[8]" value="dark"><br>
				</div>
				<a href="javascript:;" class="fa fa-close editormd-dialog-close"></a>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{URL::asset('/assets/bower/editor.md/editormd.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('/assets/bower/iCheck/icheck.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/assets/js/editormd-custom.js') }}"></script>
@endsection