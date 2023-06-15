<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::orderBy('id', 'desc')->get();
        return view('dashboard.review.crud', [
            'reviews'=>$reviews
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
            'video' => 'mimes:mp4,avi,mov,wmv',
        ]);

        $video = new Review();
        if (!empty($validatedData['video'])) {
            $img_name = Str::random(10) . '.' . $validatedData['video']->getClientOriginalExtension();
            $validatedData['video']->move(public_path('/image/review'), $img_name);
            $video->video = '/image/review/' . $img_name;
        }
        $video->save();
        return redirect()->route('dashboard.review.index')->with('success', 'Data uploaded successfully.');
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
        ]);

        $video = Review::find($id);
        if (!empty($validatedData['video'])) {
            if (is_file(public_path($video->video))) {
                unlink(public_path($video->video));
            }
            $img_name = Str::random(10) . '.' . $validatedData['video']->getClientOriginalExtension();
            $validatedData['video']->move(public_path('/image/review'), $img_name);
            $video->video = '/image/review/' . $img_name;
        }
        $video->save();
        return redirect()->route('dashboard.review.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Review::find($id);
        if (is_file(public_path($video->video))) {
            unlink(public_path($video->video));
        }

        $video->delete();
        return back()->with('success', 'Data deleted.');
    }
}
