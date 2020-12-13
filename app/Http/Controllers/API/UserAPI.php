<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\API\User\SignUpRequest;

class UserAPI extends Controller
{
    public function signUp(Request $req) {
        $signUpReq = new SignUpRequest;
        $valid = Validator::make($req->all(), $signUpReq->rules(), $signUpReq->messages());
        if ($valid->fails()) {
            return response()->json([
                'status'    => 'error',
                'msg'       => $valid->messages()->first()
            ], 400);
        }

        $result = $valid->validate();
        $result['role_id'] = 3;
        $user = User::create($result);
        return response()->json([
            'status'    => 'success',
            'msg'       => 'Create user successful'
        ], 200);
    }

    public function login(Request $req) {
        $credentials = $req->only('username', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status'    => 'error',
                'msg'       => 'Username or password is incorrect'
            ], 406);
        }

        $user = Auth::user();
        $token = $user->createToken($user->username)->accessToken;

        return response()->json([
            'token' => $token,
            'type'  => 'Bearer Token'
        ]);
    }

    public function logout(Request $req) {
        $req->user()->tokens()->delete();
        return response()->json([
            'status'    => 'success',
            'msg'       => 'Logout successful'
        ], 200);
    }

    public function show(Request $req) {
        $user = $req->user();
        return response()->json([
            'status'    => 'success',
            'msg'       => 'Get detail user success',
            'data'      => $user
        ], 200);
    }
}
