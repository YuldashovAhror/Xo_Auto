<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrendResource;
use App\Models\Brend;
use Illuminate\Http\Request;

class BrendController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', BrendResource::collection(Brend::orderBy('id', 'desc')->get()));
    }
}
