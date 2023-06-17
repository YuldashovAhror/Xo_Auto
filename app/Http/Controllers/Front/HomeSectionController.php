<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeSectionResource;
use App\Models\HomeSection;
use Illuminate\Http\Request;

class HomeSectionController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', HomeSectionResource::collection(HomeSection::orderBy('id', 'desc')->get()));
    }
}
