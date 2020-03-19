@extends('layouts.template')
@section('titolo',Route::currentRouteName() === 'index' ? 'Home' : "Discover")

@section('content')

    @auth
        <button class="btn btn-primary btn-block" id="new-post-button">Crea Post</button>

        @if(Auth::user()->follows()->count() === 0 && Route::is('index'))
            <h1>Esplora la sezione discover e inizia a seguire qualcuno, i loro contenuti saranno pubblicati qui!</h1>
        @endif
    @endauth
    @component('components.showPosts', compact('posts'))
    @endcomponent
    <noscript>
        {{$posts->links()}}
    </noscript>
@endsection
@section('scripts')
    <script>
    @switch(Route::currentRouteName())
        @case('user_post')
            let modo = 'user_post';
            let userId = {{$posts[0]->user->id}};
            @break
        @case('index')
            let modo = 'index';
            let userId = {{Auth::user()->id}}
            @break
        @case('post_index')
            let modo = 'post_index';
    @endswitch
    </script>
    <script src="{{asset('js/infiniteScrolling.js')}}"></script>
@endsection
