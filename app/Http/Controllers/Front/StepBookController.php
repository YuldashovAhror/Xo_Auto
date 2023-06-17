<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\StepBookResource;
use App\Models\StepBook;
use Illuminate\Http\Request;

class StepBookController extends BaseController
{
    public function index(){

        return $this->successResponse('success', StepBookResource::collection(StepBook::orderBy('id', 'desc')->get()));
        
    }
}
