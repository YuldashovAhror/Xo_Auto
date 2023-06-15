<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\HowWork;
use Illuminate\Http\Request;

class HowWorkController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = HowWork::orderBy('id', 'desc')->get();
        return view('dashboard.howwork.crud', [
            'works'=>$works
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
        // dd($request->all());
        $validatedData = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ok' => 'nullable',
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
        ]);

        if (!empty($validatedData['photo'])) {
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/howwork');
        }
        if (!empty($validatedData['ok'])){
            $validatedData['ok'] = 1;
        }
        HowWork::create($validatedData);

        return redirect()->route('dashboard.howwork.index')->with('success', 'Data uploaded successfully.');
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
            'ok' => 'nullable',
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
        ]);

        if (!empty($validatedData['photo'])) {
            $this->fileDelete('\HowWork', $id, 'photo');
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/howwork');
        }
        if (!empty($validatedData['ok'])){
            $validatedData['ok'] = 1;
        }
        if (empty($validatedData['ok'])){
            $validatedData['ok'] = 0;
        }
        HowWork::find($id)->update($validatedData);

        return redirect()->route('dashboard.howwork.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->fileDelete('\HowWork', $id, 'photo');
        HowWork::find($id)->delete();
        return back()->with('success', 'Data deleted.');
    }
}
