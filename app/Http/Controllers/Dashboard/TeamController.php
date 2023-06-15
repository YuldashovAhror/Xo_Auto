<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::orderBy('id', 'desc')->get();
        return view('dashboard.team.crud', [
            'teams'=>$teams
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'nullable',
            'phone' => 'required|string|max:255',
        ]);

        if (!empty($validatedData['photo'])) {
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/team');
        }
        Team::create($validatedData);

        return redirect()->route('dashboard.team.index')->with('success', 'Data uploaded successfully.');
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
        //
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
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'email' => 'nullable',
            'phone' => 'required|string|max:255',
        ]);

        if (!empty($validatedData['photo'])) {
            $this->fileDelete('\Team', $id, 'photo');
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/team');
        }
        Team::find($id)->update($validatedData);

        return redirect()->route('dashboard.team.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->fileDelete('\Team', $id, 'photo');
        Team::find($id)->delete();
        return back();
    }
}
