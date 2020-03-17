<?php

namespace App\Http\Controllers;

use App\VoteComment;
use Auth;
use Illuminate\Http\Request;

class VoteCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return boolean
     */
    public function handle(Request $req)
    {
        $res = VoteComment::where('comment_id', $req->commentId)->where('user_id', Auth::user()->id)->get();
        if(!$res->count())
            $return = $this->create();
        else {
            $res = $res[0];
            if ($res->voto != $req->modo)
                $return = $this->update($res);
            else
                $return = $this->destroy($res);
        }
        return $return;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  boolean
     */
    public function create()
    {
        $vc = new VoteComment();
        $vc->user_id = Auth::user()->id;
        $vc->voto = request()->modo;
        $vc->comment_id = request()->commentId;
        $vc->save();
        return true;
    }

    public function update(VoteComment $vc)
    {
        $vc->voto = request()->modo;
        $vc->update();
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return boolean
     */
    public function destroy(VoteComment $vc)
    {
        $vc->delete();
        return true;
    }
}
