<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;

use App\Http\Requests;
use Storage;
use App\Article;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
	/**
	 *    [show description]
	 *    @method show
	 *    @param  [type] $id [description]
	 *    @return [type]     [description]
	 */
	public function show($id) {
		return view('frontend.blog.detail',[
			'article' => Article::findorfail($id)
			]);
	}
}