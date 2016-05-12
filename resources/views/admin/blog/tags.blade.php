@extends('admin.admin') 

@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style type="text/css">
	.table thead th {
		cursor: pointer;
	}
	.table thead th:hover {
		background-color: #ddd;
	}
	.add-tag {
		color: #777;
	}
	.mask {
		position: fixed;
		display: none;
		opacity: 0;
		z-index: 9999;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
		background-color: rgba(255,255,255,0.6);
	}
	.edit-panel {
		padding-top: 45px;
		padding-bottom: 20px;
		background-color: #fff;
		box-shadow: 0 0 10px rgba(0,0,0,0.3);
		position: absolute;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}
	.edit-panel .close {
		position: absolute;
		right: 10px;
		top: 4px;
	}
	.cancel-edit {
		margin-right: 10px;
	}
</style>
@endsection

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-tags" style="padding: 0 0.5em"></i>Tags</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
	<div class="col-md-10 col-md-offset-1">
		@if(! count($tags))
		<div class="alert alert-warning alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong><i class="fa fa-bell fa-fw" aria-hidden="true"></i></strong> 没有任何标签，可以在下面新建标签哦～
		</div>
		@else
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>TAG-NAME</th>
					<th>UPDATE-TIME</th>
					<th>CREATE-TIME</th>
					<th>UPDATE</th>
					<th>DELETE</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tags as $tag)
				<tr>
					<td>
						<i class="fa fa-tag fa-fw" aria-hidden="true"></i>
						<span>{{ $tag->tag_name }}</span>
					</td>
					<td>
						{{ $tag->updated_at}}
					</td>
					<td>
						{{ $tag->created_at}}
					</td>
					<td>
						<button class="btn btn-success edit-tag" title="编辑标签" data-tag-id="{{ $tag->id }}" data-tag-name="{{$tag->tag_name}}">
							<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						</button>
					</td>
					<td>
						<button class="btn btn-danger del-tag" data-tagid="{{ $tag->id }}" title="删除标签">
							<i class="fa fa-trash-o" aria-hidden="true"></i>
						</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		@endif
		<!-- 新建标签 -->
		<div class="input-group tag-name col-xs-6 col-sm-4">
			<input type="text" class="form-control" placeholder="Tag Name...">
			<span class="input-group-btn">
				<button class="btn btn-default add-tag" type="button"><i class="fa fa-plus" aria-hidden="true"></i></button>
			</span>
		</div>
		<!-- 编辑标签 -->
		<div class="mask">
			<div class="edit-panel col-sm-6 col-xs-12 col-md-4">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Tag Name...">
				</div>
				<br>
				<button class="btn btn-primary pull-right submit-edit">确认</button>
				<button class="btn btn-default pull-right cancel-edit">取消</button>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="{{ URL::asset('/assets/bower/tablesorter/jquery.tablesorter.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/assets/js/tag-blade-common.js')}}"></script>
@endsection