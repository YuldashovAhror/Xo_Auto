<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AboutDiscription;
use Illuminate\Http\Request;

class AboutDiscriptionController extends Controller
{
    public function index()
    {
        $aboutdiscriptions = AboutDiscription::find(1);
        return view('dashboard.aboutdisctiption.crud', [
            'aboutdiscriptions'=>$aboutdiscriptions
        ]);
    }

    public function update(Request $request, $id)
    {

        AboutDiscription::find($id)->update($request->all());
        return back();
    }
}
