@extends('admin.admin') 

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-code-o" style="padding: 0 0.5em"></i>Trash</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row article-list">
	@foreach ($articles as $article)
	<div class="col-md-6 col-xs-12">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title clearfix">
					<span class="pull-left">
						<i class="fa fa-link" aria-hidden="true"></i>&nbsp;
						{{$article->title}}
					</span>
					<div class="pull-right">
						<a class="delete" data-article="{{ $article->id }}"><i class="fa fa-trash-o fa-fw" aria-hidden="true" title="彻底删除"></i></a>
						<a class="restore" data-article="{{ $article->id }}"><i class="fa fa-reply fa-fw" aria-hidden="true" title="恢复"></i></a>
					</div>
				</h3>
			</div>
			<div class="panel-body">
				{{ $article->intro }}
			</div>
			<div class="panel-footer text-muted" style="padding: 4px 10px">
				<span title="评论"><i class="fa fa-commenting-o" aria-hidden="true"></i> 评论</span>
				<span title="分享"><i class="fa fa-share-square-o" aria-hidden="true"></i> 分享</span>
				<span title="标签"><i class="fa fa-tags" aria-hidden="true"></i>标签</span>
				<span title="赞同"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 赞同</span>
				<span title="反对"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 反对</span>
				<span title="最后更新时间:{{ $article->update_at }}"><i class="fa fa-spinner" aria-hidden="true"></i> {{ App\Http\Controllers\Admin\AdminBlogController::timeEcho($article->deleted_at)}}</span>
			</div>
		</div>
	</div>
	@endforeach
</div>
<style type="text/css">
	.article-list {
		position: relative;
	}
	.panel-title span.pull-left{
		overflow: auto;
		display: flex;
	}
	.panel-title a {
		color: inherit;
	}
	a {
		cursor: pointer;
	}
	.panel-footer span {
		font-size: 10px;
		padding-left: 1em;
		cursor: pointer;
	}
	.panel-footer span:hover {
		color: #534D4D;
	}
</style>
@endsection

@section('script')
<script src="{{URL::asset('/assets/bower/masonry/dist/masonry.pkgd.min.js')}}"></script>
<script type="text/javascript">
	$('.article-list').masonry();
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$('.delete').click(function() {
		if(!confirm("彻底删除此文章?"))
			return;
		$.post("http://semi-grid.com/admin/blog/absdel-article",
			{
				id: $(this).attr('data-article')
			}, function(data) {
				if(data == 1) {
					window.location.reload();
				}
		});
	});
	$('.restore').click(function() {
		if(!confirm("恢复此文章?"))
			return;
		$.post("http://semi-grid.com/admin/blog/restore-article",
			{
				id: $(this).attr('data-article')
			}, function(data) {
				if(data == 1) {
					window.location.reload();
				}
		});
	});
</script>
@endsection