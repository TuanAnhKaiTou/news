<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Source;
use App\Http\Requests\Source\StoreRequest;
use App\Http\Requests\Source\UpdateRequest;

class SourceController extends Controller
{
    public function index() {
        $sources = Source::orderBy('name')
                         ->paginate($this->limit);
        return view('source.list', compact('sources'));
    }

    public function create() {
        return view('source.create-edit');
    }

    public function store(StoreRequest $req) {
        $status = 'error';
        $msg = $this->msgStore['err'];
        $valid = $req->validated();
        $source = Source::create($valid);
        if (!empty($source)) {
            $status = 'success';
            $msg = $this->msgStore['suc'];
        }
        return redirect()->route('source.list')->with('status', $status)->with('msg', $msg);
    }

    public function edit($id) {
        $source = Source::find($id);
        if (!empty($source)) {
            return view('source.create-edit', compact('source'));
        }
        return redirect()->route('source.list')->with('status', 'error')->with('msg', 'Source is not found');
    }

    public function update(Request $req, $id) {
        $status = 'error';
        $msg = $this->msgUpdate['err'];
        $source = Source::find($id);
        if (!empty($source)) {
            $valid = $this->validate($req, (new UpdateRequest)->rules($source->id), (new UpdateRequest)->messages());
            $source->update($valid);
            $status = 'success';
            $msg = $this->msgUpdate['suc'];
        }
        return redirect()->route('source.list')->with('status', $status)->with('msg', $msg);
    }

    public function destroy(Request $req) {
        $id = $req->id;
        $source = Source::find($id);
        if (!empty($source)) {
            $news = \App\News::where('source_id', $source->id)
                             ->get()
                             ->toArray();
            if (empty($news)) {
                $source->delete();
                return response()->json([
                    'title'     => 'DELETE SOURCE',
                    'status'    => 'success',
                    'msg'       => 'Success'
                ]);
            }
            return response()->json([
                'title'     => 'DELETE SOURCE',
                'status'    => 'error',
                'msg'       => "Can't delete source"
            ]);
        }
        return response()->json([
            'title'     => 'DELETE SOURCE',
            'status'    => 'error',
            'msg'       => 'Fail'
        ]);
    }
}
