<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceSingleResource;
use App\Models\Service;
use App\Models\ServiceSingle;
use Illuminate\Http\Request;

class SericeSingleController extends BaseController
{
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->first();
        return $this->successResponse('success', ServiceSingleResource::collection(ServiceSingle::where('service_id', $service->id)->get()));
    }
}
