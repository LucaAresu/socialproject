<?php

namespace App\Http\Controllers;

use App\User;
use File;
use Gate;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class UserController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function impostazioni(User $user)
    {
        if(Gate::denies('changeSettings',$user))
            return redirect()->route('index');
        return view('user.impostazioni', compact('user'));
    }


    public function cambioAvatar(Request $req, User $user)
    {
        $this->authorize('changeSettings',$user);
        $req->validate([
            'avatar' => 'image',
            ]
        );
        if($req->hasFile('avatar')){
            $file = $req->file('avatar');
            if($user->avatar)
                File::delete('storage/'.$user->avatar);
            $user->avatar_path = $file->store(env('AVATAR_DIR'));
            $user->save();
            $img = Image::make('storage/'.$user->avatar)->fit(env('AVATAR_WIDTH'), env('AVATAR_HEIGHT'))->encode()->save();
        }
        return redirect()->route('index');
    }
}
