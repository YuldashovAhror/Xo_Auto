<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->get();
        return view('dashboard.blog.index', [
            'blogs'=>$blogs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.blog.create');
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
            'second_photo' => '|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!empty($validatedData['photo'])) {
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/blog');
        }
        if (!empty($validatedData['second_photo'])) {
            $validatedData['second_photo'] = $this->photoSave($validatedData['second_photo'], 'image/blog/second_photo');
        }
        Blog::create($validatedData);

        return redirect()->route('dashboard.blog.index')->with('success', 'Rasm muvaffaqiyatli yuklandi.');
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
        $blog  = Blog::find($id);
        return view('dashboard.blog.edit', [
            'blog'=>$blog
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
            'photo' => '|image|mimes:jpeg,png,jpg,gif|max:2048',
            'second_photo' => '|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if (!empty($validatedData['photo'])) {
            $this->fileDelete('\Blog', $id, 'photo');
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/blog');
        }
        if (!empty($validatedData['second_photo'])) {
            $this->fileDelete('\Blog', $id, 'second_photo');
            $validatedData['second_photo'] = $this->photoSave($validatedData['second_photo'], 'image/blog/second_photo');
        }
        Blog::find($id)->update($validatedData);

        return redirect()->route('dashboard.blog.index')->with('success', 'Rasm muvaffaqiyatli yuklandi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->fileDelete('\Blog', $id, 'photo');
        $this->fileDelete('\Blog', $id, 'second_photo');
        Blog::find($id)->delete();
        return back()->with('success', 'Data deleted.');
    }
}
