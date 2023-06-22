<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', TypeResource::collection(Type::orderBy('id', 'desc')->get()));
    }

    public function store(Request $request)
    {
    
        
    }
}
