<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Machinetype;
use Illuminate\Http\Request;

class MachinetypeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Machinetype::orderBy('id', 'desc')->get();
        return view('dashboard.machinetype.crud', [
            'types' => $types
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
        ]);

        $request = $request->toArray();

        if (!empty($request['photo'])) {
            $request['photo'] = $this->photoSave($request['photo'], 'image/machinetype');
        }
        Machinetype::create($request);

        return redirect()->route('dashboard.machinetype.index')->with('success', 'Rasm muvaffaqiyatli yuklandi.');
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
        ]);

        $request = $request->toArray();

        if (!empty($request['photo'])) {
            $this->fileDelete('\Machinetype', $id, 'photo');
            $request['photo'] = $this->photoSave($request['photo'], 'image/machinetype');
        }

        Machinetype::find($id)->update($request);

        return redirect()->route('dashboard.machinetype.index')->with('success', 'Rasm muvaffaqiyatli almashtirildi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->fileDelete('\Machinetype', $id, 'photo');
        Machinetype::find($id)->delete();
        return back();
    }
}
