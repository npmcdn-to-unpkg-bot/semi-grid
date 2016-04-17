@extends('admin.admin') 

@section('head')
<link rel="stylesheet" href="{{URL::asset('/assets/bower/editor.md/css/editormd.min.css') }}" />
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
		<div class="panel-heading"><i class="fa fa-edit" style="padding: 0 0.5em"></i>Edit</div>
		<div class="panel-body">
			<form action="{{ URL::asset('/admin/blog/storearticle') }}" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="id" value="{{ $article->id }}">
				<input type="hidden" name="store" value="edit">
				<input type="text" name="title" class="form-control" required="required" placeholder="Title..." value="{{ $article->title }}">
				<br>
				<input type="text" name="tag" class="form-control" placeholder="Tag..." value="{{ $article->tag }}">
				<br>
				<input type="text" name="intro" class="form-control" placeholder="Introduce..." value="{{ $article->intro }}">
				<br>
				<div id="editormd" style="z-index: 800; border-radius: 4px;">
					<textarea style="display:none;" name="content" required="required">{{ $article->content }}</textarea>
				</div>
				<button class="btn btn-default btn-info">Update</button>
			</form>
		</div>
	</div>
</div>
@endsection

@section('script')
<script src="{{URL::asset('/assets/bower/editor.md/editormd.js')}}"></script>
<script type="text/javascript">
	//$(function() {
		var config = {
			height: 640,
			path : "/assets/bower/editor.md/lib/",
			syncScrolling : "single",
			emoji:true,
			tex  : true,
			flowChart : true,
			saveHTMLToTextarea: true,
			toolbarIcons : function() {
				return ["undo", "redo", "|", "preview", "watch", "fullscreen", "goto-line", "search", "|", "code","code-block", "preformatted-text", "|", "datetime", "table", "image", "reference-link", "link", "emoji", "html-entities", "pagebreak", "|", "help", "||", "theme"];
			},
			toolbarIconsClass: {
				theme: "fa-gears"
			},
			onload : function() {
				this.addKeyMap({
					"Ctrl-S": function() {
						return false;
					},
				});
			},
			imageUpload    : true,
			imageFormats   : ["jpg", "jpeg", "gif", "png", "bmp", "webp"],
			imageUploadURL : "http://semi-grid.com/admin/blog/uploadimage"
		}
		var editor = editormd("editormd", config);
	//});
</script>
@endsection