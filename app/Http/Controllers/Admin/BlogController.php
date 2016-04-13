<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Article;
use App\Tag;
use App\Http\Requests;
use Validator;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
     //constructor
    public function __construct()
    {
        $this->middleware('auth');
    }
    //articles
    public function getArticles(Request $request) {
            //$articles = Article::all();
    	return view('admin.blog.articles', [
                'user' => $request->user(),
                'articles' => Article::all()
            ]);
    }
    //tags
    public function getTags(Request $request) {

    	return view('admin.blog.tags', [
                'user' => $request->user(),
                'tags' => Tag::all()
            ]);
    }
    public function getCreatetag(Request $request) {
        $tag = new Tag;
        $tag->tag_name = $request->input('tag_name');
        $tag->save();
        return view('admin.blog.tags', ['user' => $request->user()]);
    }
    //Trash
    public function getTrash(Request $request) {
    	return view('admin.blog.trash', ['user' => $request->user()]);
    }
    //add new blog
    public function getCreate(Request $request) {
    	return view('admin.blog.create', ['user' => $request->user()]);
    }
    //update database
    public function postCreate(Request $request) {
        //@todo...
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:255',
            'content' =>'required',
            'intro' => 'required',
            'tag' => 'required'
        ]);
        if($validator->fails()) {
            return redirect()->back()->with([
                'status' => 'There are some errors on your input.',
                'errors' => $validator->messages(),
                'class' => 'danger'
         ])->withInput();
        }
        $article = new Article;
        $article->title = $request->input('title');
        $article->intro = $request->input('intro');
        $article->tag = $request->input('tag');
        $article->content = $request->input('content');
        $article->update_at = \Carbon\Carbon::now('PRC');
        $article->save();
        return redirect()->back()->with([
            'status' => 'You have create a new blog!',
            'class' => 'success'
         ]);
    }
    //Draft
    public function getDraft(Request $request) {
        return view('admin.blog.draft', ['user' => $request->user()]);
    }
}
