<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkResource;
use App\Models\Works;
use Illuminate\Http\Request;

class WorkController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', WorkResource::collection(Works::orderBy('id', 'desc')->get()));
    }
}
