<?php

namespace App\Http\Controllers;

use App\Notifications\NewFollowNotification;
use App\User;
use Auth;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function handle(Request $req)
    {
        $user = User::find($req->user);
        if(Auth::user()->isFollowing($user))
            $this->destroy();
        else
            $this->create();
        return 1;
    }

    public function create()
    {
        Auth::user()->follows()->attach(request()->user);
        User::find(request()->user)->notify(new NewFollowNotification(Auth::user()));
    }

    public function destroy()
    {
        Auth::user()->follows()->detach(request()->user);
    }
}
