<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Auth;
use Illuminate\Http\Request;
use function compact;
use function env;
use function json_encode;
use function view;

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

    public function prossimaPaginaHandler(Request $req)
    {
        $lastPost = Post::find($req->postId);
        switch($req->modo) {
            case 'index':
                $posts = $this->prossimaPaginaIndex();
                break;
            case 'user_post':
                $posts = $this->prossimaPaginaUserPost();
                break;
            case 'post_index':
                $posts = $this->prossimaPaginaPostIndex($lastPost);
                break;
        }
        $posts = $posts->where('created_at','<', $lastPost->created_at)
            ->whereNotIn('user_id',User::onlyTrashed()->pluck('id'))
            ->latest()->take(env('POSTS_PER_PAGE'))->get();
        return view('components.showPosts',compact('posts'));
    }

    public function prossimaPaginaIndex()
    {
        return Post::whereIn('user_id', Auth::user()->getFollowIds());
    }

    public function prossimaPaginaUserPost()
    {
        return Post::where('user_id', request()->userId);
    }

    public function prossimaPaginaPostIndex($post)
    {
        return Post::where('created_at','<', $post->created_at);

    }

    public function prossimoCommento(Request $req)
    {
        $currentCom = Comment::find($req->comId);
        $post = $currentCom->post;
        $comments = $post->comments()
            ->where('created_at','<', $currentCom->created_at)
            ->whereNotIn('user_id',User::onlyTrashed()->pluck('id'))
            ->latest()
            ->take(env('COMMENTS_PER_PAGE'))->get();
        return view('components.showComments', compact('comments'));
    }

    public function getFormCrea(){
        $post = new Post();
        return view('components.createPost',compact('post'));
    }

    public function cercaUtente(Request $req)
    {
        $users = User::where('name','like', '%'.$req->utente.'%')->take(env('RESULTS_PER_SEARCH'))->get();
        if($users->count() === 0)
            $users = [];
        return view('components.search.search', compact('users'));
    }

    public function deleteComment(Request $req)
    {
        $com = Comment::find($req->commentId);
        $com->reports()->delete();
        $com->delete();
            return 1;
    }

    public function reports(Request $req) {
        $req->reportable = 'App\\'.$req->reportable;
        $reportable = $req->reportable::find($req->reportableId);
        $reportable->reports()->firstOrCreate([
            'reporter' => Auth::id(),
            'reported' => $reportable->user->id,
        ]);
        return 1;
    }
}
