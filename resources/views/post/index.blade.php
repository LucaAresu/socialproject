@extends('layouts.template')
@section('titolo',Route::currentRouteName() === 'index' ? 'Home' : "Profilo di {$posts[0]->user->name}")

@section('content')
    @auth
        <button class="btn btn-primary btn-block" id="new-post-button">Crea Post</button>
    @endauth
    @component('components.showPosts', compact('posts'))
    @endcomponent
    <noscript>
        {{$posts->links()}}
    </noscript>
@endsection
@section('scripts')
    @if(Route::currentRouteName() === 'user_post')
        <script>
            let userId = {{$posts[0]->user->id}};
        </script>
    @endif
    <script src="{{asset('js/infiniteScrolling.js')}}"></script>
@endsection
