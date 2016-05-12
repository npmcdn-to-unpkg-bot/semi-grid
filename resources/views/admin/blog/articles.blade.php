@extends('admin.admin') 

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
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

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-code-o" style="padding: 0 0.5em"></i>Articles</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row article-list">
	@foreach ($articles as $article)
	<div class="col-md-6 col-xs-12">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title clearfix">
					<!-- 文章标题链接 -->
					<span class="pull-left">
						<i class="fa fa-link" aria-hidden="true"></i>&nbsp;
						<a href="{{URL::asset('/blog/details/'.$article->id)}}" target="_blank">
							{{$article->title}}
						</a>
					</span>
					<!-- 文章删除、编辑按钮 -->
					<div class="pull-right">
						<a class="delete" data-article="{{ $article->id }}">
							<i class="fa fa-trash-o fa-fw" aria-hidden="true" title="删除"></i>
						</a>
						<a href="{{URL::asset('/admin/blog/edit-article/'.$article->id)}}">
							<i class="fa fa-pencil-square-o fa-fw" aria-hidden="true" title="编辑"></i>
						</a>
					</div>
				</h3>
			</div>
			<!-- 文章简介 -->
			<div class="panel-body">
				{{ substr($article->content, 0, 264) }}
			</div>
			<!-- 文章相关信息 -->
			<div class="panel-footer text-muted" style="padding: 4px 10px">
				<span title="评论">
					<i class="fa fa-commenting-o" aria-hidden="true"></i> 评论
				</span>
				<span title="分享">
					<i class="fa fa-share-square-o" aria-hidden="true"></i> 分享
				</span>
				<span title="标签">
					<i class="fa fa-tags" aria-hidden="true"></i>标签
				</span>
				<span title="赞同">
					<i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 赞同
				</span>
				<span title="反对">
					<i class="fa fa-thumbs-o-down" aria-hidden="true"></i> 反对
				</span>
				<span title="最后更新时间:{{ $article->updated_at }}">
					<i class="fa fa-spinner" aria-hidden="true"></i> 
					{{ App\Http\Controllers\Admin\AdminBlogController::timeEcho($article->updated_at)}}
				</span>
			</div>
		</div>
	</div>
	@endforeach
</div>
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
		$.post("http://semi-grid.com/admin/blog/delete-article",
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