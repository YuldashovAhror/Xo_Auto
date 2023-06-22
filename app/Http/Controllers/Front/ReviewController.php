<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', ReviewResource::collection(Review::orderBy('id', 'desc')->get()));

    
    }
}
