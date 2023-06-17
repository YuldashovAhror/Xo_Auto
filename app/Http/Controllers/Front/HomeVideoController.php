<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeVideoResource;
use App\Models\HomeVideo;
use Illuminate\Http\Request;

class HomeVideoController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', HomeVideoResource::collection(HomeVideo::orderBy('id', 'desc')->get()));
    }
}
