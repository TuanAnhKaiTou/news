<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;
use App\Category;

class NewsAPI extends Controller
{

    public function getList() {
        $news = News::latest()
                    ->paginate($this->limit);
        return response()->json([
            'status'    => 'success',
            'msg'       => 'Get list news success',
            'data'      => $news
        ], 200);
    }

    public function getListByCategory(Request $req) {
        $category = Category::find($req->category_id);
        if (empty($category)) {
            return response()->json([
                'status'    => 'error',
                'msg'       => 'Category is not found'
            ], 404);
        }

        $news = News::where('category_id', $category->id)
                    ->latest()
                    ->paginate($this->limit);
        return response()->json([
            'status'    => 'success',
            'msg'       => 'Get list news success',
            'data'      => $news
        ], 200);
    }
}
