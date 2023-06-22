<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    public function index(Request $request)
    {

        if(!$request->perPage){
            $perPage = 12;
        }else{
            $perPage = $request->perPage;
        }
        
        $sliders = Blog::orderBy('id', 'desc')->paginate($perPage);
        return BlogResource::collection($sliders);

        // return $this->successResponse('success', BlogResource::collection(Blog::orderBy('id', 'desc')->get()));
    }

    public function show($id)
    {
        return $this->successResponse('success', BlogResource::make(Blog::find($id)));
    }
}
