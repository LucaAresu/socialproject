<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use DB;
use File;
use Gate;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use function env;
use function redirect;
use function view;

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
    public function follow(User $user)
    {
        return view('user.follow',['fols' => $user->follows]);
    }
    public function followers(User $user)
    {
        return view('user.follow',['fols' => $user->followers]);
    }

    public function impostazioni(User $user)
    {
        if(Gate::denies('changeSettings',$user))
            return redirect()->route('index');
        return view('user.impostazioni', compact('user'));
    }

    public function impostazioniHandler(Request $req, User $user)
    {
        $this->authorize('changeSettings',$user);
        switch($req->modo){
            case 'avatar';
                $this->cambioAvatar($req, $user);
                break;
            case 'bio':
                $this->cambioBio($req, $user);
                break;
            case 'avatarDestroy':
                $this->avatarDestroy($user);
        }
        return redirect()->route('user_post',compact('user'));

    }

    public function cambioBio(Request $req, User $user)
    {
        $this->authorize('changeSettings', $user);

        $user->bio = $req->bio;
        $user->update();

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
            if($user->avatar_path) {
                File::delete('storage/' . $user->avatar_path);
                File::delete('storage/' .$user->profilepic_path);
            }
            $user->profilepic_path = $file->store(env('PROFILEPIC_DIR'));
            $user->avatar_path = $file->store(env('AVATAR_DIR'));

            $user->save();
            Image::make('storage/'.$user->avatar_path)->fit(env('AVATAR_WIDTH'), env('AVATAR_HEIGHT'))->encode()->save();
            Image::make('storage/'.$user->profilepic_path)->fit(env('PROFILEPIC_WIDTH'), env('PROFILEPIC_HEIGHT'))->encode()->save();
        }
    }
    public function avatarDestroy(User $user)
    {
        $user->avatar_path = null;
        $user->profilepic_path = null;
        $user->save();
    }

    public function notifications(User $user)
    {
        $this->authorize('seeNotifications', $user);

        $unread = $user->unreadNotifications;
        $read = $user->readNotifications()->take(env('NUMBER_OF_OLD_NOTIFICATIONS'))->get();
        $unread->markAsRead();
        return view('user.notifiche', compact(['read', 'unread']));
    }

    public function reportsReceived(User $user)
    {
        $reports = $user->reportsReceived()
            ->select(DB::raw('reportable_type as tipo, reportable_id as id, count(reporter) as count'))
            ->groupBy(['reportable_type','reportable_id'])
            ->orderBy('count','desc')->get();
        return view('admin.reportsReceived',compact(['reports','user']));
    }

    public function reportsDone(User $user)
    {
        $reports = $user->reportsDone()
            ->select(DB::raw('users.name as name, users.id as id, count(users.name) as totali'))
            ->join('users', 'reports.reported','=','users.id')
            ->groupBy('reported')
            ->orderBy('totali','desc')->get();

        return view('admin.reportsDone', compact(['reports','user']));
    }
}
