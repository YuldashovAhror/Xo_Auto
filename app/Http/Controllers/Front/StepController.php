<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\StepResource;
use App\Models\Step;
use Illuminate\Http\Request;

class StepController extends BaseController
{
    public function index(){

        return $this->successResponse('success', StepResource::collection(Step::orderBy('id', 'desc')->get()));

    }
}
