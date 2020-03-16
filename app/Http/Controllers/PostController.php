<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Auth;
use File;
use Gate;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use function compact;
use function dd;
use function env;
use function redirect;
use function request;
use function view;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(env('POSTS_PER_PAGE'));
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        return view('post.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validatePost();

        $post = Post::create([
            'titolo' => $request->titolo,
            'contenuto' => $request->contenuto,
            'user_id'=> Auth::user()->id,

            ]);
        if($request->hasFile('postimg'))
            $this->salvaImmagine($post);
        return redirect()->route('index');
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.post',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(Gate::denies('update', $post))
            return redirect()->route('index');

        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $this->validatePost();
        if($request->hasFile('postimg'))
            $this->salvaImmagine($post);
        $post->update([
            'titolo' => $request->titolo,
            'contenuto' => $request->contenuto,
        ]);
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('update', $post);
        $post->delete();
        return redirect()->route('index');

    }

    public function userPost(User $user) {
        $posts = $user->posts()->latest()->paginate(env('POSTS_PER_PAGE'));
        return view('post.index', compact('posts'));
    }

    protected function validatePost() {
        return request()->validate([
            'titolo' => 'required',
            'contenuto' => 'required',
        ]);
    }

    protected function salvaImmagine(Post $post)
    {

        request()->validate([
            'postimg' => 'image',
            ]
        );
        $file = request()->file('postimg');
        if($post->image_path)
            File::delete('storage/'.$post->image_path);
        $post->image_path = $file->store(env('POSTPIC_DIR'));
        $post->save();
        $img = Image::make('storage/'.$post->image_path)->fit(env('POSTPIC_WIDTH'), env('POSTPIC_HEIGHT'))->encode()->save();

    }

}
