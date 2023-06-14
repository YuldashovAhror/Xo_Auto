<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ServiceSection;
use Illuminate\Http\Request;

class ServiceSectionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // dd($id);
        $sections = ServiceSection::where('service_id', $id)->orderBy('id', 'desc')->get();
        return view('dashboard.servicesection.index', [
            'sections'=>$sections,
            'service'=>$id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('dashboard.servicesection.create', [
            'service_id'=>$id,
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
        $validatedData = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
            'atribute' => 'array',
        ]);
        if (!empty($validatedData['photo'])) {
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/servicesection');
        }
        if(!isset($validatedData['atribute'])){
            $validatedData['atribute'] = [];
        }

        ServiceSection::create($validatedData);

        return redirect()->route('dashboard.servicesections.index', $validatedData['service_id'])->with('success', 'Successfully uploaded.');
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
        $section = ServiceSection::find($id);
        return view('dashboard.servicesection.edit', [
            'section'=>$section
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
            'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
            'atribute' => 'array',
        ]);
        if (!empty($validatedData['photo'])) {
            $this->fileDelete('\ServiceSection', $id, 'photo');
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/servicesection');
        }
        if(!isset($validatedData['atribute'])){
            $validatedData['atribute'] = [];
        }

        ServiceSection::find($id)->update($validatedData);

        return redirect()->route('dashboard.servicesections.index', $validatedData['service_id'])->with('success', 'Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->fileDelete('\ServiceSection', $id, 'photo');
        ServiceSection::find($id)->delete();
        return back();
    }
}
