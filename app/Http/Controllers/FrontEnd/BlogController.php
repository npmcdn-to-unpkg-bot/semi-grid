<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use App\Article;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
	public function show($id) {
		//$article = DB::select('select * from articles where id=?', [$id])[0];
		return view('frontend.blog.detail',[
			//'article' => $article
			'article' => Article::findorfail($id)
			]);
	}
}
