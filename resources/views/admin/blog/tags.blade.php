@extends('admin.admin') 

@section('content')
<div class="row">
	<div class="col-lg-12">
		<h3 class="page-header"><i class="fa fa-tags" style="padding: 0 0.5em"></i>Tags</h3>
	</div>
	<!-- /.col-lg-12 -->
</div>
<div class="row">
    @foreach ($tags as $tag)
    <p>
        {{ $tag->tag_name }}
    </p>
    <hr>
    @endforeach
</div>

@endsection