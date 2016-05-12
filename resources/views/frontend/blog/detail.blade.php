<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{$article->title}}</title>
	<link rel="stylesheet" href="{{URL::asset('/assets/bower/editor.md/css/editormd.min.css') }}">
	<!-- Bootstrap Core CSS -->
	<link href="{{URL::asset('/assets/bower/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">
							{{$article->title}}
						</h3>
					</div>
					<div class="panel-body" id="content"></div>
					<div id="temp_file" style="display: none;">{{ $article->content }}</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{URL::asset('/assets/bower/jquery/dist/jquery.min.js')}}"></script>
<script src="{{URL::asset('/assets/bower/editor.md/editormd.min.js')}}"></script>
<script src="{{ URL::asset('/assets/bower/editor.md/lib/flowchart.min.js') }}"></script>
<script src="{{ URL::asset('/assets/bower/editor.md/lib/jquery.flowchart.min.js') }}"></script>
<script src="{{ URL::asset('/assets/bower/editor.md/lib/marked.min.js') }}"></script>
<script src="{{ URL::asset('/assets/bower/editor.md/lib/prettify.min.js') }}"></script>
<script src="{{ URL::asset('/assets/bower/editor.md/lib/raphael.min.js') }}"></script>
<script src="{{ URL::asset('/assets/bower/editor.md/lib/underscore.min.js') }}"></script>
<script src="{{ URL::asset('/assets/bower/editor.md/lib/sequence-diagram.min.js') }}"></script>
<script type="text/javascript">
$(function(){
	var markdown = $('#temp_file').text();
	$('#temp_file').remove();
	console.log(markdown)
	editormd.markdownToHTML("content", {
		markdown: markdown,
		htmlDecode: "style,script,iframe",
		tocm: true,
		emoji: true,
		taskList: true,
		tex: true,
		flowChart: true,
		sequenceDiagram: true
	});
});
</script>
</body>
</html>