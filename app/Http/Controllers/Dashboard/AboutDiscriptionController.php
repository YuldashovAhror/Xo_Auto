<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AboutDiscription as ModelsAboutDiscription;
use Illuminate\Http\Request;

class AboutDiscription extends Controller
{
    public function index()
    {
        $aboutdiscriptions = ModelsAboutDiscription::find(1);
        return view('dashboard.aboutdisctiption.crud', [
            'aboutdiscriptions'=>$aboutdiscriptions
        ]);
    }

    public function update(Request $request, $id)
    {

        ModelsAboutDiscription::find($id)->update($request->all());
        return back();
    }

}
