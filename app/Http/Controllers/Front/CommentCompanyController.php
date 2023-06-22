<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentCompanyResource;
use App\Models\CommentCompany;
use Illuminate\Http\Request;

class CommentCompanyController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', CommentCompanyResource::collection(CommentCompany::orderBy('id', 'desc')->get()));
    }

    public function paginate(Request $request)
    {
        if(!$request->perPage){
            $perPage = 12;
        }else{
            $perPage = $request->perPage;
        }
        
        $sliders = CommentCompany::orderBy('id', 'desc')->paginate($perPage);
        return CommentCompanyResource::collection($sliders);
    }
}
