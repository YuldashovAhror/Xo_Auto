<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $policy = Policy::find(1);
        return view('dashboard.policy.index', [
            'policy'=>$policy
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'description' => 'required',
        ]);
        Policy::find($id)->update($validatedData);
        return back()->with('success', 'Data updated successfully.');
    }
}
