<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Works;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = Works::find(1);
        return view('dashboard.works.crud', [
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
        //
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
            'video' => 'mimes:mp4,avi,mov,wmv',
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
        ]);

        $video = Works::find($id);
        if (!empty($validatedData['video'])) {
            if (is_file(public_path($video->video))) {
                unlink(public_path($video->video));
            }
            $img_name = Str::random(10) . '.' . $validatedData['video']->getClientOriginalExtension();
            $validatedData['video']->move(public_path('/image/workvideo'), $img_name);
            $video->video = '/image/workvideo/' . $img_name;
        }
        $video->name = $validatedData['name'];
        $video->discription = $validatedData['discription'];
        $video->save();
        return redirect()->route('dashboard.work.index')->with('success', 'Rasm muvaffaqiyatli almashtirildi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
