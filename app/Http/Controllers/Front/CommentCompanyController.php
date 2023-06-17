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
}
