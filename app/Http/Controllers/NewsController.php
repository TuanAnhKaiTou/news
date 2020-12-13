<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Source;
use App\Category;
use App\Helpers\UploadFile;
use App\Http\Requests\News\StoreRequest;
use App\Http\Requests\News\UpdateRequest;

class NewsController extends Controller
{
    private $folder = 'news_image';

    public function index(Request $req) {
        $inputSearch = [
            'author'    => $req->author,
            'src_id'    => $req->src_id,
            'cate_id'   => $req->cate_id
        ];
        $isSearch = false;
        foreach($inputSearch as $key => $value) {
            if (!empty($value)) {
                $isSearch = true;
                break;
            }
        }
        $sources = Source::all();
        $categories = Category::all();
        $news = News::select('id', 'title', 'sub_title', 'author', 'category_id', 'source_id');
        if (!empty($req->author)) {
            $news->where('author', 'like', "%{$req->author}%");
        }
        if (!empty($req->cate_id)) {
            $news->where('category_id', $req->cate_id);
        }
        if (!empty($req->src_id)) {
            $news->where('source_id', $req->src_id);
        }
        $news = $news->with([
                         'source' => function($query) {
                             $query->select('id', 'name');
                         },
                         'category' => function($query) {
                             $query->select('id', 'name');
                         }
                     ])
                     ->latest()
                     ->orderByRaw('title asc, author asc')
                     ->paginate($this->limit);
        return view('news.list', compact('news', 'inputSearch', 'sources', 'categories', 'isSearch'));
    }

    public function show($id) {
        $news = News::with(['source', 'category'])
                    ->find($id);
        if (empty($news)) {
            return response()->json([
                'msg'   => 'Error',
                'code'  => 400
            ], 400);
        }
        return response()->json([
            'msg'   => 'Success',
            'code'  => 200,
            'data'  => $news
        ], 200);
    }

    public function create() {
        $sources = Source::all();
        $categories = Category::all();
        return view('news.create-edit', compact('sources', 'categories'));
    }

    public function store(StoreRequest $req) {
        $status = 'error';
        $msg = $this->msgStore['err'];
        $valid = $req->validated();
        $check = $this->checkExists($valid);
        if (is_array($check)) {
            return redirect()->route('news.list')->with('status', $check['status'])->with('msg', $check['msg']);
        }
        $news = News::create($valid);
        if (!empty($news)) {
            if ($req->hasFile('image') && $req->file('image')->isValid()) {
                $nameImage = UploadFile::store($req->image, $this->folder);
                News::find($news->id)->update(['image' => $nameImage]);
            }
            $status = 'success';
            $msg = $this->msgStore['suc'];
        }
        return redirect()->route('news.list')->with('status', $status)->with('msg', $msg);
    }

    public function edit($id) {
        $sources = Source::all();
        $categories = Category::all();
        $news = News::find($id);
        if (!empty($news)) {
            return view('news.create-edit', compact('news', 'sources', 'categories'));
        }
        return redirect()->route('news.list')->with('status', 'error')->with('msg', 'News is not found');
    }

    public function update(UpdateRequest $req, $id) {
        $status = 'error';
        $msg = $this->msgUpdate['err'];
        $news = News::find($id);
        $valid = $req->validated();
        $check = $this->checkExists($valid, $news->id);
        if (is_array($check)) {
            return redirect()->route('news.list')->with('status', $check['status'])->with('msg', $check['msg']);
        }
        if (!empty($news)) {
            $oldImage = $news->image;
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
            $news->update($valid);
            $status = 'success';
            $msg = $this->msgUpdate['suc'];
        }
        return redirect()->route('news.list')->with('status', $status)->with('msg', $msg);
    }

    public function destroy(Request $req) {
        $id = $req->id;
        $news = News::find($id);
        if (!empty($news)) {
            $news->delete();
            return response()->json([
                'title'     => 'DELETE NEWS',
                'status'    => 'success',
                'msg'       => 'Success'
            ]);
        }
        return response()->json([
            'title'     => 'DELETE NEWS',
            'status'    => 'error',
            'msg'       => 'Fail'
        ]);
    }

    public function checkExists($obj, $id = null) {
        $news = News::where('title', $obj['title'])
                    ->where('sub_title', $obj['sub_title']);
        if (!empty($id)) {
            $news->where('id', '<>', $id);
        }
        $result = $news->get()->toArray();
        if (!empty($result)) {
            return [
                'status'    => 'error',
                'msg'       => 'The news has already exist'
            ];
        }
    }
}
