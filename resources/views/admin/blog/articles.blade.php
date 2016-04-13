@extends('admin.admin') 

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header"><i class="fa fa-file-code-o" style="padding: 0 0.5em"></i>Articles</h3>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
    @foreach ($articles as $article)
    <div>
        <h4>{{ $article->title }}</h4>
        <div>
            <p>
                {{ $article->body }}
            </p>
            <small style="color: #888">
            	    {{ $article->intro}}
            </small>
        </div>
    </div>
    <hr>
    @endforeach
</div>

@endsection