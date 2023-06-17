<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', BlogResource::collection(Blog::orderBy('id', 'desc')->get()));
    }
}
