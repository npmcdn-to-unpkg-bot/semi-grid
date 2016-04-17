@extends('admin.admin') 

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-file-code-o" style="padding: 0 0.5em"></i>Articles</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row article-list">
	@foreach ($articles as $article)
	<div class="col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title clearfix">
					<span class="pull-left">
						<i class="fa fa-link" aria-hidden="true"></i>&nbsp;
						<a href="{{URL::asset('/blog/details/'.$article->id)}}" target="_blank">{{$article->title}}</a>
					</span>
					<div class="pull-right">
						<a href=""><i class="fa fa-trash-o fa-fw" aria-hidden="true" title="删除"></i></a>
						<a href="{{URL::asset('/admin/blog/edit/'.$article->id)}}"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true" title="编辑"></i></a>
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
				<span title="最后更新时间:{{ $article->update_at }}"><i class="fa fa-spinner" aria-hidden="true"></i> {{ App\Http\Controllers\Admin\AdminBlogController::timeEcho($article->update_at)}}</span>
			</div>
		</div>
	</div>
	@endforeach
</div>
<style type="text/css">
	.panel-title span.pull-left{
		overflow: auto;
		display: flex;
	}
	.panel-title a {
		color: inherit;
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
</script>
@endsection