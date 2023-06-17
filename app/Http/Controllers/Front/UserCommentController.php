<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCommentResource;
use App\Models\UserComment;
use Illuminate\Http\Request;

class UserCommentController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', UserCommentResource::collection(UserComment::orderBy('id', 'desc')->get()));
    }
}
