@php
    $user = \App\User::find($notification->data['userId']);
    $post = \App\Post::withTrashed()->find($notification->data['postId']);
@endphp
<li>Nuovo commento da
    @component('components.user',compact('user'))
    @endcomponent
    nel post <a href="{{route('single_post',compact('post'))}}"> {{$post->titolo}} </a>
</li>
