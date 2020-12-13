<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login() {
        return view('login');
    }

    public function doLogin(Request $req) {
        $credentials = $req->only('username', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('news.list');
        }
        return redirect()->route('login')->with('status', 'error')->with('msg', 'Username or password is incorrect');
    }
}
