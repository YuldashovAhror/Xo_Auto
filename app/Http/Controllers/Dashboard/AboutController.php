<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Year;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts  = About::with('year')->orderBy('id', 'desc')->get();
        return view('dashboard.about.index',[
            'abouts'=>$abouts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years = Year::orderBy('id', 'desc')->get();
        return view('dashboard.about.create', [
            'years'=>$years
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
            'link' => 'string|max:255',
            'year_id' => 'nullable',
        ]);
        About::create($validatedData);

        return redirect()->route('dashboard.about.index')->with('success', 'Data uploaded successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $years = Year::orderBy('id', 'desc')->get();
        $about = About::find($id);
        return view('dashboard.about.edit', [
            'about'=>$about,
            'years'=>$years,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        About::find($id)->delete();
        return back()->with('success', 'deleted.')->with('success', 'Data deleted.');
    }
}
