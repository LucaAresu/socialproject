@extends('layouts.template')
@section('titolo', "Profilo di {$posts[0]->user->name}")


@section('sideContent')
    <div class="col-md-4">
    @component('components.profilecard',['user' => $posts[0]->user])
    @endcomponent
    </div>
@endsection
@section('content')
    @auth
        @if(Auth::user()->is($posts[0]->user))
        <button class="btn btn-primary btn-block" id="new-post-button">Crea Post</button>
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
        let modo = 'user_post';
        let userId = {{$posts[0]->user->id}};
    </script>
    <script src="{{asset('js/infiniteScrolling.js')}}"></script>
@endsection
