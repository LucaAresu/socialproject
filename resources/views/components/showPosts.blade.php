@foreach($posts as $post)
    @component('components.singlePost',compact('post'))
        @auth
            <div id="comment-{{$post->id}}">
                <a id="comment-{{$post->id}}" href="{{route('single_post',compact('post'))}}" onclick="caricaCommenti()">Commenta</a>
            </div>
        @endauth
    @endcomponent
@endforeach
