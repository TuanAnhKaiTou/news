<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;

class AdminController extends Controller
{
    public function index(Request $req) {
        $inputSearch = [
            'username'  => $req->username,
            'full_name' => $req->full_name
        ];
        $isSearch = false;
        foreach($inputSearch as $key => $value) {
            if (!empty($value)) {
                $isSearch = true;
                break;
            }
        }
        $admins = Admin::where('id', '<>', 1);
        if (!empty($req->username)) {
            $admins->where('username', 'like', "%{$req->username}%");
        }
        if (!empty($req->full_name)) {
            $admins->where('full_name', 'like', "%{$req->full_name}%");
        }
        $admins = $admins->orderBy('username')
                         ->paginate($this->limit);
        return view('admin.list', compact('admins', 'isSearch', 'inputSearch'));
    }

    public function create() {
        return view('admin.create-edit');
    }

    public function store(StoreRequest $req) {
        $status = 'error';
        $msg = $this->msgStore['err'];
        $valid = $req->validated();
        $valid['password'] = Hash::make('123456');
        $valid['role_id'] = 2;
        $admin = Admin::create($valid);
        if (!empty($admin)) {
            $status = 'success';
            $msg = $this->msgStore['suc'];
        }
        return redirect()->route('admin.list')->with('status', $status)->with('msg', $msg);
    }

    public function show($id) {
        $admin = Admin::find($id);
        return view('admin.detail', compact('admin'));
    }

    public function edit($id) {
        $admin = Admin::find($id);
        if (!empty($admin)) {
            return view('admin.create-edit', compact('admin'));
        }
        return redirect()->route('admin.list')->with('status', 'error')->with('msg', 'Admin is not found');
    }

    public function update(Request $req, $id) {
        $status = 'error';
        $msg = $this->msgUpdate['err'];
        $admin = Admin::find($id);
        if (!empty($admin)) {
            $valid = $this->validate($req, (new UpdateRequest)->rules(), (new UpdateRequest)->messages());
            $admin->update($valid);
            $status = 'success';
            $msg = $this->msgUpdate['suc'];
        }
        return redirect()->route('admin.list')->with('status', $status)->with('msg', $msg);
    }

    public function destroy(Request $req) {
        $id = $req->id;
        $admin = Admin::find($id);
        if (!empty($admin)) {
            $admin->delete();
            return response()->json([
                'title'     => 'DELETE ADMIN',
                'status'    => 'success',
                'msg'       => 'Success'
            ]);
        }
        return response()->json([
            'title'     => 'DELETE ADMIN',
            'status'    => 'error',
            'msg'       => 'Fail'
        ]);
    }

    public function changePass(Request $req, $id) {
        $admin = Admin::find($id);
        if (!empty($admin)) {
            if (Hash::check($req->old_pass, $admin->password)) {
                $admin->update([
                    'password'  => Hash::make($req->new_pass)
                ]);
                return redirect()->route('news.list')->with('status', 'success')->with('msg', 'Change password success');
            }
            return redirect()->route('news.list')->with('status', 'error')->with('msg', 'Old password is incorrect');
        }
        return redirect()->route('news.list')->with('status', 'error')->with('msg', 'Have error while changing pass');
    }
}
