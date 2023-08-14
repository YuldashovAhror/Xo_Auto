<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AboutVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AboutVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = AboutVideo::find(1);
        return view('dashboard.aboutvideo.crud', ['video'=>$video]);
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
            'name' => 'nullable',
        ]);

        $video = AboutVideo::find($id);
        if (!empty($validatedData['video'])) {
            $video->video_name = $validatedData['video']->getClientOriginalName();
            if (is_file(public_path($video->video))) {
                unlink(public_path($video->video));
            }
            $img_name = Str::random(10) . '.' . $validatedData['video']->getClientOriginalExtension();
            $validatedData['video']->move(public_path('/image/aboutvideo'), $img_name);
            $video->video = '/image/aboutvideo/' . $img_name;
        }
        $video->save();
        return redirect()->route('dashboard.aboutvideo.index')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        //
    }
}
