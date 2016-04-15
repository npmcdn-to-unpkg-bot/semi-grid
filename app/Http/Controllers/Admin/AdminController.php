<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
	/**
	 *    构造函数，定义该控制器的中间件
	 *    @method __construct
	 */
	public function __construct() {
		$this->middleware('auth', ['except' => 'getReset']);
	}

	/**
	 *    /admin 首页
	 *    @method getIndex
	 *    @param  Request  $request 传入http请求
	 *    @return view            返回视图文件
	 */
	public function getIndex(Request $request) {
		return view('admin.dashboard', ['user' => $request->user()]);
	}

	/**
	 *    重置密码入口函数
	 *    @method getReset
	 *    @return view   返回视图文件
	 */
	public function getReset() {
		return view('auth.reset');
	}

	/**
	 *    获取用户信息
	 *    @method getProfile
	 *    @param  Request    $request Http请求
	 *    @return view              视图文件
	 */
	public function getProfile(Request $request) {
		return view('admin.profile', ['user' => $request->user()]);
	}

	/**
	 *    更新用户信息
	 *    @method postUpdate
	 *    @param  Request    $request Post Http 请求
	 *    @return   信息验证失败时返回消息，成功则返回提示
	 */
	public function postUpdate(Request $request) {
		$user = $request->user();
		$name = $request->input('name');
		$validator =Validator::make(
			['name' => $name],
			['name' => 'required|max:255']
			)->fails();
		if ($validator) {
			return redirect()->back()->with([
				'status' => 'You have input an invalid name!',
				'class' => 'danger'
				]);
		}
		$user->name = $name;
		$user->save();
		return redirect()->back()->with([
			'status' => 'Profile Updated.',
			'class' => 'success'
			]);
	}
}