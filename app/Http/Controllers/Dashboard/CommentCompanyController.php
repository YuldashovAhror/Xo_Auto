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
        ]);

        $request = $request->toArray();

        if (!empty($request['photo'])) {
            $request['photo'] = $this->photoSave($request['photo'], 'image/commentcompany');
        }
        if (!empty($request['ok'])){
            $request['ok'] = 1;
        }
        CommentCompany::create($request);

        return redirect()->route('dashboard.commentcompany.index')->with('success', 'Rasm muvaffaqiyatli yuklandi.');
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
        ]);

        $request = $request->toArray();

        if (!empty($request['photo'])) {
            $this->fileDelete('\CommentCompany', $id, 'photo');
            $request['photo'] = $this->photoSave($request['photo'], 'image/commentcompany');
        }
        if (!empty($request['ok'])){
            $request['ok'] = 1;
        }
        if (empty($request['ok'])){
            $request['ok'] = 0;
        }
        CommentCompany::find($id)->update($request);

        return redirect()->route('dashboard.commentcompany.index')->with('success', 'Rasm muvaffaqiyatli yuklandi.');
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
        return back();
    }
}
