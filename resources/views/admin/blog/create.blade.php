@extends('admin.admin') 

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-edit" style="padding: 0 0.5em"></i>Create</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
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
            <div class="panel-heading">Add</div>
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
                    <textarea name="content" rows="10" class="form-control" required="required" placeholder="Content..." value="{{ Request::old('content') }}">{{ Request::old('content') }}</textarea>
                    <br>
                    <button class="btn btn-default btn-info">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection