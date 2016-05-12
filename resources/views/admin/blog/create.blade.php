@extends('admin.admin') 

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{URL::asset('/assets/bower/editor.md/css/editormd.min.css') }}" />
<link href="{{ URL::asset('/assets/bower/iCheck/skins/square/grey.css') }}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{URL::asset('/assets/css/create-edit-blade-style.css')}}">
@endsection

@section('content')
<div class="row" style="padding-top: 2em">
	<!-- 文章编辑区 -->
	<div class="edit-box">
		<!-- 隐藏字段 表示提交的内容是新的文章 -->
		<input type="hidden" name="store" value="create">
		<input type="hidden" name="id" value="0">
		<p><input type="text" name="title" value="无标题文章" class="title" placeholder="文章标题"></p>
		<!-- 标签列表 -->
		<div class="tag-edit"><i class="fa fa-tags fa-fw"></i>
			<ul class="tag-list">
				<!-- <li class="tag-item">CSS <i class="remove-tag">&times;</i></li> -->
			</ul>
			<span class="add-tag-btn">+</span>
			<input type="text" class="add-tag" placeholder="1-10个中文数字字母">
			<ul class="tag-select">
				@foreach ($tags as $tag)
				<li class="tag-select-item" data-tag-name="{{$tag->tag_name}}" data-tag-id="{{$tag->id}}">
					<i class="fa fa-tag fa-fw"></i> {{ $tag->tag_name }}
				</li>
				@endforeach
			</ul>
		</div>
		<!-- MarkDown编辑区 -->
		<div id="editormd" style="border-radius: 4px;">
			<textarea style="display:none;" name="content" required="required">{{ Request::old('content') }}</textarea>
		</div>
		<!-- 消息框 提交文章后返回提示信息-->
		<div class="alert message-box alert-success" role="alert">
			<strong style="padding-right: 1em;"><i class="fa fa-bell fa-fw"></i></strong>
			<span class="message-content"></span>
		</div>
		<button class="btn btn-primary publish-btn">发布文章</button>
		<button class="btn btn-default draft-btn">保存到草稿</button>
	</div>
	<!-- 设置对话框 设定Editor.md相关属性 -->
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

			<label style="width: 90%" for="baz[6]">Disable ToolBar Auto Fixed</label>
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
@endsection

@section('script')
<script src="{{URL::asset('/assets/bower/editor.md/editormd.min.js')}}"></script>
<script type="text/javascript" src="{{ URL::asset('/assets/bower/iCheck/icheck.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/assets/js/editormd-custom.js') }}"></script>
@endsection