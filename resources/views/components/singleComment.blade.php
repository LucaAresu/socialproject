<div id="com-{{$comment->id}}" class="containerCommenti mt-2" >
    <div class=" d-flex flex-row">
        @component('components.vote',compact('comment'))
        @endcomponent
        <div class="bg-white border rounded p-2 pr-2">
                <a href="{{route('user_post',['user' => $comment->user])}}">
                    @component('components.avatar',['user' =>$comment->user])
                        {{$comment->user->name}}
                    @endcomponent
                </a>:
                {{$comment->contenuto}}
        </div>
    </div>
    <small class="d-block p-2 d-flex justify-content-between">
        <div id="punti-{{$comment->id}}" class="ml-4">{{$comment->punti}} punti </div>

        <div>{{$comment->quantoTempoFa()}}</div>
    </small>
</div>
