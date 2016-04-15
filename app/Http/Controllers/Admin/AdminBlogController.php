<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Article;
use App\Tag;
use App\Http\Requests;
use Validator;
use App\Http\Controllers\Controller;

class AdminBlogController extends Controller
{
	/**
	 *    定义中间件
	 *    @method __construct
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 *    获取文章列表
	 *    @method getArticles
	 *    @param  Request     $request get请求
	 *    @return view               视图文件
	 */
	public function getArticles(Request $request) {
		return view('admin.blog.articles', [
			'user' => $request->user(),
			'articles' => Article::all()
			]);
	}

	/**
	 *    标签列表
	 *    @method getTags
	 *    @param  Request $request
	 *    @return view           视图文件
	 */
	public function getTags(Request $request) {

		return view('admin.blog.tags', [
			'user' => $request->user(),
			'tags' => Tag::all()
			]);
	}

	/**
	 *    新建标签
	 *    @method getCreatetag
	 *    @param  Request      $request 
	 *    @return vew
	 */
	public function getCreatetag(Request $request) {
		$tag = new Tag;
		$tag->tag_name = $request->input('tag_name');
		$tag->save();
		return view('admin.blog.tags', ['user' => $request->user()]);
	}

	/**
	 *    文章回收站
	 *    @method getTrash
	 *    @param  Request  $request
	 *    @return  view
	 */
	public function getTrash(Request $request) {
		return view('admin.blog.trash', ['user' => $request->user()]);
	}

	/**
	 *    新建文章
	 *    @method getCreatearticle
	 *    @param  Request          $request
	 *    @return  view
	 */
	public function getCreatearticle(Request $request) {
		return view('admin.blog.create', ['user' => $request->user()]);
	}

	/**
	 *    保存文章
	 *    @method postCreate
	 *    @param  Request    $request post 请求
	 *    @return   view
	 */
	public function postStorearticle(Request $request) {
		$validator = Validator::make($request->all(),[
			'title' => 'required|max:255',
			'content' =>'required',
			'intro' => 'required',
			'tag' => 'required'
			]);
		if( $validator->fails() ) {
			return redirect()->back()
				->with([
					'status' => 'There are some errors on your input.',
					'errors' => $validator->messages(),
					'class' => 'danger'
					])->withInput();
		}
		if($request->input('store') == 'create')
			$article = new Article;
		else $article = Article::findorfail($request->input('id'));
		$article->title = $request->input('title');
		$article->intro = $request->input('intro');
		$article->tag = $request->input('tag');
		$article->content = $request->input('content');
		$article->update_at = \Carbon\Carbon::now('PRC');
		$article->save();
		return redirect()->back()->with([
			'status' => 'Blog Stored!',
			'class' => 'success'
			]);
	}

	/**
	 *    获取草稿
	 *    @method getDraft
	 *    @param  Request  $request get请求
	 *    @return  view
	 */
	public function getDraft(Request $request) {
		return view('admin.blog.draft', ['user' => $request->user()]);
	}

	/**
	 *    文章列表的编辑入口
	 *    @method getEdit
	 *    @param  Request $request get请求
	 *    @param  int  $id      请求编辑的文章id
	 *    @return   view          视图文件
	 */
	public function getEdit(Request $request, $id) {
		return view('admin.blog.edit', [
			'user' => $request->user(),
			'article' => Article::findorfail($id)
			]);
	}

	/**
	 *    辅助函数:输入一个从数据库提取的时间字符串，输出形象时间概念，如：
	 *    	发表时间于当前时间间隔小于60s：刚刚，
	 *    	发表时间于当前时间间隔<=30min：[0,1,2,...,30]min前，
	 *    	发表时间于当前时间间隔小于1h大于30min：半小时前，
	 *    	发表时间于当前时间间隔>=1h<1d：[1,2,3,...,23]h前，
	 *    	发表时间于当前时间间隔>=1d：[1,2,3,...,n]d前，
	 *    	发表时间于当前时间间隔>3d：直接输出日期，
	 *    @method timeEcho
	 *    @param  [type]   $time [description]
	 *    @return [type]         [description]
	 */
	static function timeEcho($time) {
		$now = strtotime(\Carbon\Carbon::now('PRC'));
		$time = strtotime($time);
		/** @var int 时间差，单位为秒 */
		$disSec = $now - $time;

		if(ceil($disSec) < 60)					//小于1分钟
			return "刚刚";
		elseif(ceil($disSec) < 60*30)				//小于30分钟
			return ceil($disSec/60)."分钟前";
		elseif(ceil($disSec) < 60*60*24)				//小于1天
			return '约'.ceil($disSec/(60*60))."小时前";
		elseif(ceil($disSec) < 60*60*24*3)			//小于3天前
			return ceil($disSec/(60*60*24))."天前";
		else return ($now - $time)/60;				//大于3天，返回年月日
	}
}