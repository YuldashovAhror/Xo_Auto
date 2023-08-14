<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Year;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $abouts  = About::with('year')->orderBy('id', 'desc')->get();
        return view('dashboard.about.index',[
            'abouts'=>$abouts
        ]);
    }

    public function create()
    {
        $years = Year::orderBy('id', 'desc')->get();
        return view('dashboard.about.create', [
            'years'=>$years
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
            'link' => 'string|max:255',
            'year_id' => 'nullable',
        ]);
        About::create($validatedData);

        return redirect()->route('dashboard.about.index')->with('success', 'Data uploaded successfully.');
    }

    public function edit($id)
    {
        $years = Year::orderBy('id', 'desc')->get();
        $about = About::find($id);
        return view('dashboard.about.edit', [
            'about'=>$about,
            'years'=>$years,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
            'link' => 'string|max:255',
            'year_id' => 'nullable',
        ]);
        About::find($id)->update($validatedData);

        return redirect()->route('dashboard.about.index')->with('success', 'Data update successfully.');
    }

    public function destroy($id)
    {
        About::find($id)->delete();
        return back()->with('success', 'deleted.')->with('success', 'Data deleted.');
    }
}
