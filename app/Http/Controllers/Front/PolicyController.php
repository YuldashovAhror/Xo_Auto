<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\PolicyResource;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', PolicyResource::make(Policy::find(1)));
    }
}
