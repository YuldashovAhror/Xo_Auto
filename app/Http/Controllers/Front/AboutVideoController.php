<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutVideoResource;
use App\Models\AboutVideo;
use Illuminate\Http\Request;

class AboutVideoController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', AboutVideoResource::collection(AboutVideo::orderBy('id', 'desc')->get()));
    }
}
