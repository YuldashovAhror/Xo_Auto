<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CommentCompany;
use Illuminate\Http\Request;

class CommentCompanyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = CommentCompany::orderBy('id', 'desc')->get();
        return view('dashboard.comments.commentcompany.index', [
            'comments'=>$comments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.comments.commentcompany.create');
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
            'ok' => 'nullable',
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
            'star' => 'nullable',
        ]);

        if (!empty($validatedData['photo'])) {
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/commentcompany');
        }
        if (!empty($validatedData['ok'])){
            $validatedData['ok'] = 1;
        }
        CommentCompany::create($validatedData);

        return redirect()->route('dashboard.commentcompany.index')->with('success', 'Data uploaded successfully.');
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
        $comment = CommentCompany::find($id);
        return view('dashboard.comments.commentcompany.edit', [
            'comment'=>$comment
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
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'ok' => 'nullable',
            'name' => 'required|string|max:255',
            'discription' => 'nullable',
            'star' => 'nullable',
        ]);

        if (!empty($validatedData['photo'])) {
            $this->fileDelete('\CommentCompany', $id, 'photo');
            $validatedData['photo'] = $this->photoSave($validatedData['photo'], 'image/commentcompany');
        }
        if (!empty($validatedData['ok'])){
            $validatedData['ok'] = 1;
        }
        if (empty($validatedData['ok'])){
            $validatedData['ok'] = 0;
        }
        CommentCompany::find($id)->update($validatedData);

        return redirect()->route('dashboard.commentcompany.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->fileDelete('\CommentCompany', $id, 'photo');
        CommentCompany::find($id)->delete();
        return back()->with('success', 'Data deleted.');
    }
}
