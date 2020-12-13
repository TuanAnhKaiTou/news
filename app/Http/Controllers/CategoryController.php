<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Helpers\UploadFile;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;

class CategoryController extends Controller
{
    private $folder = 'category_image';

    public function index() {
        $categories = Category::orderBy('name')
                              ->paginate($this->limit);
        return view('category.list', compact('categories'));
    }

    public function create() {
        return view('category.create-edit');
    }

    public function store(StoreRequest $req) {
        $status = 'error';
        $msg = $this->msgStore['err'];
        $valid = $req->validated();
        $category = Category::create($valid);
        if (!empty($category)) {
            if ($req->hasFile('image') && $req->file('image')->isValid()) {
                $nameImage = UploadFile::store($req->image, $this->folder);
                Category::find($category->id)->update(['image' => $nameImage]);
            }
            $status = 'success';
            $msg = $this->msgStore['suc'];
        }
        return redirect()->route('category.list')->with('status', $status)->with('msg', $msg);
    }

    public function edit($id) {
        $category = Category::find($id);
        if (!empty($category)) {
            return view('category.create-edit', compact('category'));
        }
        return redirect()->route('category.list')->with('status', 'error')->with('msg', 'Category is not found');
    }

    public function update(Request $req, $id) {
        $status = 'error';
        $msg = $this->msgUpdate['err'];
        $category = Category::find($id);
        if (!empty($category)) {
            $valid = $this->validate($req, (new UpdateRequest)->rules($category->id), (new UpdateRequest)->messages());
            $oldImage = $category->image;
            if (!isset($req->image) && $req->is_remove == 'removed') {
                UploadFile::delete($oldImage, $this->folder);
            }
            if (!isset($req->image) && empty($req->is_remove)) {
                $valid['image'] = $oldImage;
            }
            if ($req->hasFile('image') && $req->file('image')->isValid()) {
                $image = $req->image;
                UploadFile::delete($oldImage, $this->folder);
                $valid['image'] = UploadFile::store($image, $this->folder);
            }
            $category->update($valid);
            $status = 'success';
            $msg = $this->msgUpdate['suc'];
        }
        return redirect()->route('category.list')->with('status', $status)->with('msg', $msg);
    }

    public function destroy(Request $req) {
        $id = $req->id;
        $category = Category::find($id);
        if (!empty($category)) {
            $news = \App\News::where('category_id', $category->id)
                        ->get()
                        ->toArray();
            if (empty($news)) {
                $category->delete();
                return response()->json([
                    'title'     => 'DELETE CATEGORY',
                    'status'    => 'success',
                    'msg'       => 'Success'
                ]);
            }
            return response()->json([
                'title'     => 'DELETE CATEGORY',
                'status'    => 'error',
                'msg'       => "Can't delete category"
            ]);
        }
        return response()->json([
            'title'     => 'DELETE CATEGORY',
            'status'    => 'error',
            'msg'       => 'Fail'
        ]);
    }
}
