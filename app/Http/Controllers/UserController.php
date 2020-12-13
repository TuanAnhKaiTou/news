<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $req) {
        $inputSearch = [
            'username'  => $req->username,
            'full_name' => $req->full_name,
            'email'     => $req->email,
            'phone'     => $req->phone
        ];
        $isSearch = false;
        foreach($inputSearch as $key => $value) {
            if (!empty($value)) {
                $isSearch = true;
                break;
            }
        }
        $users = User::select('username', 'full_name', 'email', 'phone');
        if (!empty($req->username)) {
            $users->where('username', 'like', "%{$req->username}%");
        }
        if (!empty($req->full_name)) {
            $users->where('full_name', 'like', "%{$req->full_name}%");
        }
        if (!empty($req->email)) {
            $users->where('email', 'like', "%{$req->email}%");
        }
        if (!empty($req->phone)) {
            $users->where('phone', 'like', "%{$req->phone}%");
        }
        $users = $users->orderBy('username')
                       ->paginate($this->limit);
        return view('user.list', compact('users', 'isSearch', 'inputSearch'));
    }

    public function destroy(Request $req) {
        $id = $req->id;
        $user = User::find($id);
        if (!empty($user)) {
            $user->delete();
            return response()->json([
                'title'     => 'DELETE USER',
                'status'    => 'success',
                'msg'       => 'Success'
            ]);
        }
        return response()->json([
            'title'     => 'DELETE USER',
            'status'    => 'error',
            'msg'       => 'Fail'
        ]);
    }
}
