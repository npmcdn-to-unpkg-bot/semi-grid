<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Article;
use App\Tag;
use App\Http\Requests;
use Validator;
use App\Http\Controllers\Controller;
use DB;

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
	 *    @method postAddTag
	 *    @param  Request    $request [description]
	 *    @return [type]              [description]
	 */
	public function postAddTag(Request $request) {
		$result = array();
		//如果标签存在，返回字符串消息
		//不存在则新建
		if(Tag::where('tag_name', $request->input('tag_name'))->first()) {
			$result['status'] = 0;
			$result['content'] = 'This tag already exists';
		} else {
			$tag = new Tag;
			$tag->tag_name = $request->input('tag_name');
			$tag->save();
			$result['status'] = 1;
			$result['content'] = $tag;
		}
		return json_encode($result);
	}

	/**
	 *    删除标签
	 *    @method postDelTag
	 *    @param  Request    $request [description]
	 *    @return [type]              [description]
	 */
	public function postDelTag(Request $request) {
		Tag::findorfail($request->input('id'))->delete();
		return 1;
	}

	public function postUpdateTag(Request $request) {
		if(Tag::where('tag_name', $request->input('tag_name'))->first())
			return "This tag already exists";
		$tag = Tag::findorfail($request->input('id'));
		$tag->tag_name = $request->input('tag_name');
		$tag->save();
		return 1;
	}
	/**
	 *    文章回收站
	 *    @method getTrash
	 *    @param  Request  $request
	 *    @return  view
	 */
	public function getTrash(Request $request) {
		$articles = Article::onlyTrashed()->get();
		return view('admin.blog.trash', [
			'user' => $request->user(),
			'articles' => $articles
			]);
	}

	/**
	 *    新建文章
	 *    @method getCreatearticle
	 *    @param  Request          $request
	 *    @return  view
	 */
	public function getCreateArticle(Request $request) {
		return view('admin.blog.create', [
			'user' => $request->user(),
			'tags' => Tag::all()
			]);
	}

	/**
	 *    保存文章
	 *    @method postCreate
	 *    @param  Request    $request post 请求
	 *    @return   view
	 */
	public function postStoreArticle(Request $request) {
		$result = array();
		$validator = Validator::make($request->all(),[
			'title' => 'required|max:255',
			'content' =>'required'
			]);
		if( $validator->fails() ) {
			$result['status'] = 0;
			$result['content'] = $validator->messages();
		} else {
			/**
			 *    store字段表示此请求的是新建一篇文章或者修改已有文章
		 	*/
			if($request->input('store') == 'create')
				$article = new Article;
			else $article = Article::findorfail($request->input('id'));
			$article->title = $request->input('title');
			$article->content = $request->input('content');
			$article->save();
			/**
			 *    插入之前将所有该文章的标签删除
			 */
			DB::table('relationships')->where('article_id',$article->id)->delete();
			if(!empty($request->input('tags'))) {
				/**
				 *    插入标签列表数据
				 *    @var array
				 */
				$tagArray = array();
				foreach (array_unique($request->input('tags')) as $value)
					array_push($tagArray, [
						'article_id' => $article->id,
						'tag_id' => $value
					]);
				DB::table('relationships')->insert($tagArray);
			}
			$result['status'] = 1;
			$result['content'] = $article;
		}
		return json_encode($result);
	}

	/**
	 *    将文章放入回收站
	 *    @method postDeleteArticle
	 *    @param  Request           $request  Ajax
	 *    @return [type]                     status
	 */
	public function postDeleteArticle(Request $request) {
		Article::findorfail($request->input('id'))->delete();
		return 1;
	}

	/**
	 *    彻底删除一篇文章
	 *    @method postAbsdelArticle
	 *    @param  Request           $request [description]
	 *    @return [type]                     [description]
	 */
	public function postAbsdelArticle(Request $request) {
		Article::withTrashed()
		->where('id', $request->input('id'))
		->forceDelete();
		return 1;
	}

	/**
	 *    从回收站恢复一篇文章
	 *    @method postRestoreArticle
	 *    @param  Request            $request [description]
	 *    @return [type]                      [description]
	 */
	public function postRestoreArticle(Request $request) {
		Article::withTrashed()
		->where('id', $request->input('id'))
		->restore();
		return 1;
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
	public function getEditArticle(Request $request, $id) {
		return view('admin.blog.edit', [
			'user' => $request->user(),
			'article' => Article::findorfail($id),
			'allTags' => Tag::all(),
			'tags' => DB::table('articles')
				->select('tags.id', 'tags.tag_name')
				->leftjoin('relationships', 'articles.id', '=', 'relationships.article_id')
				->leftjoin('tags', 'tags.id', '=', 'relationships.tag_id')
				->where('articles.id',$id)
				->get()
			]);
	}

	/**
	 *    辅助函数:输入一个从数据库提取的时间字符串，输出形象时间概念，如：
	 *    	发表时间于当前时间间隔小于60s：刚刚，
	 *    	发表时间于当前时间间隔<=60min：[0,1,2,...,60]min前，
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
		/** @var int 时间差，单位为秒 */
		$disSec = $now - strtotime($time);

		if(ceil($disSec) < 60)					//小于1分钟
		return "刚刚";
		elseif(ceil($disSec) < 60*60)				//小于60分钟
		return ceil($disSec/60)."分钟前";
		elseif(ceil($disSec) < 60*60*24)				//小于1天
		return '约'.ceil($disSec/(60*60))."小时前";
		elseif(ceil($disSec) < 60*60*24*3)			//小于3天前
		return ceil($disSec/(60*60*24))."天前";
		else return $time;				//大于3天，返回年月日
	}

	/**
	 *    图片上传
	 *    @method postUpload
	 *    @param  Request    $request [description]
	 *    @return [type]              [description]
	 */
	public function postUploadImage(Request $request) {
		$status = 0;
		$message = "Image upload faild. Please try again.";
		$url = '';
		if($request->hasFile('editormd-image-file')) {
			$image = $request->file('editormd-image-file');
			if($image->isValid()) {
				$timestamp = time()+8*3600;
				$fname = $timestamp.'.'.$image->getClientOriginalExtension();
				$fpath = 'assets/images/'.md5(date('Y', $timestamp)).'/'.md5(date('m', $timestamp)).'/'.md5(date('d', $timestamp));
				$image->move($fpath, $fname);
				$url = asset($fpath.'/'.$fname);
				$status = 1;
				$message = "Image upload success.";
			}
		}
		return json_encode(array(
			'success' => $status,
			'message' => $message,
			'url' => $url
			));
	}
}