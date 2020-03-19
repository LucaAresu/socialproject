<?php

namespace App\Http\Controllers;

use App\Post;
use Auth;
use Illuminate\Http\Request;
use function array_shift;
use function compact;
use function redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(!Auth::check())
            return redirect()->route('post_index');
        $posts = Post::whereIn('user_id', Auth::user()->getFollowIds())->latest()->paginate(env('POSTS_PER_PAGE'));
        return view('post.index', compact('posts'));
    }


}
