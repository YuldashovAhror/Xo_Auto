<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConditionResource;
use App\Models\Condition;
use Illuminate\Http\Request;

class ConditionController extends BaseController
{
    public function index()
    {
        return $this->successResponse('success', ConditionResource::make(Condition::find(1)));
    }
}
