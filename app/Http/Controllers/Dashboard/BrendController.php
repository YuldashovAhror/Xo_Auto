<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brend;
use Illuminate\Http\Request;

class BrendController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brends = Brend::orderBy('id', 'desc')->get();
        return view('dashboard.brend.crud', [
            'brends'=>$brends
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
            $request['photo'] = $this->photoSave($request['photo'], 'image/brend');
        }
        Brend::create($request);

        return redirect()->route('dashboard.brend.index')->with('success', 'Rasm muvaffaqiyatli yuklandi.');
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
            $this->fileDelete('\Brend', $id, 'photo');
            $request['photo'] = $this->photoSave($request['photo'], 'image/brend');
        }
        Brend::find($id)->update($request);

        return redirect()->route('dashboard.brend.index')->with('success', 'Rasm muvaffaqiyatli yuklandi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->fileDelete('\Brend', $id, 'photo');
        Brend::find($id)->delete();
        return back();
    }
}
