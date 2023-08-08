<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutDiscriptionResource;
use App\Models\AboutDiscription;
use Illuminate\Http\Request;

class AboutDiscriptionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse('success', AboutDiscriptionResource::make(AboutDiscription::find(1)));
    }

}
