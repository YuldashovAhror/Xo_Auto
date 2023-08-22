<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Condition;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    public function index()
    {
        $condition = Condition::find(1);
        return view('dashboard.condition.index', [
            'condition'=>$condition
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'description' => 'required',
        ]);
        Condition::find($id)->update($validatedData);
        return back()->with('success', 'Data updated successfully.');
    }
}
