<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use function compact;
use function env;
use function json_encode;

class ajaxController extends Controller
{
    function index()
    {
        return redirect()->route('index');
    }

    public function commenti(Request $req)
    {
        $post = Post::find(request()->postId);
        $comments = $post->getCommentiInOrdineTemporale();
        return view('components.showComments', compact('comments'));
    }

    public function prossimaPagina(Request $req)
    {
        $post = Post::find($req->postId);
        if($req->userId)
            $posts = Post::where('user_id', $req->userId);
        else
            $posts = Post::where('created_at','<', $post->created_at);
        $posts = $posts->where('created_at','<', $post->created_at)->latest()->take(env('POSTS_PER_PAGE'))->get();
        return view('components.showPosts',compact('posts'));
    }
    public function prossimoCommento(Request $req)
    {
        $post = Comment::find($req->comId)->post;
        $comments = $post->comments()->where('id','<', $req->comId)->latest()->take(env('COMMENTS_PER_PAGE'))->get();
        return view('components.showComments', compact('comments'));
    }

    public function getFormCrea(){
        return view('components.createPost');
    }
}
