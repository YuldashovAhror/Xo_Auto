<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\HelpCenter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HelpCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $help = HelpCenter::find(1);
        return view('dashboard.helpcenter.crud', [
            'help'=>$help,
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
        // dd($request->all());
        $validatedData = $request->validate([
            'video' => 'mimes:mp4,avi,mov,wmv',
            'second_video' => 'mimes:mp4,avi,mov,wmv',
            'atribute' => 'nullable',
        ]);

        $video = HelpCenter::find($id);
        if (!empty($validatedData['video'])) {
            $video->video_name = $validatedData['video']->getClientOriginalName();
            if (is_file(public_path($video->video))) {
                unlink(public_path($video->video));
            }
            $img_name = Str::random(10) . '.' . $validatedData['video']->getClientOriginalExtension();
            $validatedData['video']->move(public_path('/image/helpcenter'), $img_name);
            $video->video = '/image/helpcenter/' . $img_name;
        }
        if (!empty($validatedData['second_video'])) {
            if (is_file(public_path($video->second_video))) {
                unlink(public_path($video->second_video));
            }
            $img_name = Str::random(10) . '.' . $validatedData['second_video']->getClientOriginalExtension();
            $validatedData['second_video']->move(public_path('/image/helpcenter/second_video'), $img_name);
            $video->second_video = '/image/helpcenter/second_video/' . $img_name;
        }
        $video->atribute = $request->atribute;
        $video->save();
        return redirect()->route('dashboard.helpcenter.index')->with('success', 'Data updated successfully.');
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
