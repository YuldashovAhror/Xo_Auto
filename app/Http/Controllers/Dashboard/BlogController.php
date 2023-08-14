<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'second_photo' => '|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
            'date' => 'nullable',
            'second_discription' => 'nullable',
        ]);

        if (!empty($validatedData['photo'])) {
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/blog');
        }
        if (!empty($validatedData['second_photo'])) {
            $validatedData['second_photo'] = $this->photoSave($validatedData['second_photo'], 'image/blog/second_photo');
        }
        if (!empty($validatedData['name'])){
                
            $validatedData['slug'] = str_replace(' ', '_', strtolower($validatedData['name'])) . '-' . Str::random(5);
        }
        Blog::create($validatedData);

        return redirect()->route('dashboard.blog.index')->with('success', 'Data uploaded successfully.');
    }

    public function edit($id)
    {
        $blog  = Blog::find($id);
        return view('dashboard.blog.edit', [
            'blog'=>$blog
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'photo' => '|image|mimes:jpeg,png,jpg,gif|max:2048',
            'second_photo' => '|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
            'date' => 'nullable',
            'second_discription' => 'nullable',
        ]);

        if (!empty($validatedData['photo'])) {
            $this->fileDelete('\Blog', $id, 'photo');
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/blog');
        }
        if (!empty($validatedData['second_photo'])) {
            $this->fileDelete('\Blog', $id, 'second_photo');
            $validatedData['second_photo'] = $this->photoSave($validatedData['second_photo'], 'image/blog/second_photo');
        }
        if (!empty($validatedData['name'])){
                
            $validatedData['slug'] = str_replace(' ', '_', strtolower($validatedData['name'])) . '-' . Str::random(5);
        }
        Blog::find($id)->update($validatedData);

        return redirect()->route('dashboard.blog.index')->with('success', 'Data updated successfully.');
    }

    public function destroy($id)
    {
        $this->fileDelete('\Blog', $id, 'photo');
        $this->fileDelete('\Blog', $id, 'second_photo');
        Blog::find($id)->delete();
        return back()->with('success', 'Data deleted.');
    }
}
