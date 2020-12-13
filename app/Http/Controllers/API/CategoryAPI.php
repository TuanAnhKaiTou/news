<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryAPI extends Controller
{
    public function getList() {
        $categories = Category::paginate($this->limit);
        return response()->json([
            'status'    => 'success',
            'msg'       => 'Get list category success',
            'data'      => $categories
        ], 200);
    }
}
