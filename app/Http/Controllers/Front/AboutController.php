<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', AboutResource::collection(About::orderBy('id', 'desc')->get()));
    }
}
