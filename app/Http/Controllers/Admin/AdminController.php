<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //constructor
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'getReset']);
    }
    //index
    public function getIndex(Request $request) {
    	return view('admin.dashboard', ['user' => $request->user()]);
    }

    //reset password.
    public function getReset() {
    	return view('auth.reset');
    }
    //view user profile
    public function getProfile(Request $request) {
        return view('admin.profile', ['user' => $request->user()]);
    }
    //update user profile
    public function postUpdate(Request $request) {
        $user = $request->user();
        $name = $request->input('name');
        if (Validator::make(
            ['name' => $name],
            ['name' => 'required|max:255']
        )->fails()) {
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