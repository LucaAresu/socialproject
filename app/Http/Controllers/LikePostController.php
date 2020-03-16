<?php

namespace App\Http\Controllers;

use App\LikePost;
use Auth;
use Illuminate\Http\Request;

class LikePostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $like = new LikePost();
        $like->user_id = Auth::user()->id;
        $like->post_id = $request->postid;
        $like->save();
        return true;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LikePost  $likeComment
     * @return \Illuminate\Http\Response
     */
    public function show(LikePost $likeComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LikePost  $likeComment
     * @return \Illuminate\Http\Response
     */
    public function edit(LikePost $likeComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LikePost  $likeComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LikePost $likeComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LikePost  $likeComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $like = LikePost::where('post_id', $request->postid)->where('user_id', Auth::user()->id)->delete();
        return 1;
    }
}
