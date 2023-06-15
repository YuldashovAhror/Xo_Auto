<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\ServiceSingle;
use Illuminate\Http\Request;

class ServiceSingleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $singles = ServiceSingle::where('service_id', $id)->get();
        return view('dashboard.servicesingle.crud', [
            'singles'=>$singles,
            'service_id'=>$id

        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.servicesingle.create');
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
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
        ]);
        if (!empty($validatedData['photo'])) {
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/servicesingle');
        }
        if (!empty($validatedData['icon'])) {
            $validatedData['icon'] = $this->photoSave($validatedData['icon'], 'image/servicesingle/icon');
        }
        ServiceSingle::create($validatedData);

        return redirect()->back()->with('success', 'Data uploaded successfully.');
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
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
        ]);
        if (!empty($validatedData['photo'])) {
            $this->fileDelete('\ServiceSingle', $id, 'photo');
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/servicesingle');
        }
        if (!empty($validatedData['icon'])) {
            $this->fileDelete('\ServiceSingle', $id, 'icon');
            $validatedData['icon'] = $this->photoSave($validatedData['icon'], 'image/servicesingle/icon');
        }
        ServiceSingle::find($id)->update($validatedData);

        return redirect()->back()->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->fileDelete('\ServiceSingle', $id, 'photo');
        $this->fileDelete('\ServiceSingle', $id, 'icon');
        ServiceSingle::find($id)->delete();
        return back()->with('success', 'Data deleted.');
    }
}
