<div id="com-{{$comment->id}}" class="containerCommenti mt-2" >
    <span class="bg-white border rounded p-2 pr-2">
            <a href="{{route('user_post',['user' => $comment->user])}}">
                @component('components.avatar',['user' =>$comment->user])
                    {{$comment->user->name}}
                @endcomponent
            </a>:
            {{$comment->contenuto}}
    </span>
    <small class="d-block p-2">{{$comment->quantoTempoFa()}}</small>
</div>
