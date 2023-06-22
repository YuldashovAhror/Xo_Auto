<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Http\Resources\YearResource;
use App\Models\About;
use App\Models\Year;
use Illuminate\Http\Request;

class AboutController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', Year::with('abouts')->orderBy('id', 'desc')->get());
    }

    
}
