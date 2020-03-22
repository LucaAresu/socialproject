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
            @if($comment->deleted_at)
                [COMMENTO CANCELLATO]
            @else
                <p class="com-contenuto d-inline">{{$comment->contenuto}}</p>
            @endif
        </div>

        <div class="dropdown">
            <span class="btn" id="dropdownMenuButton" data-toggle="dropdown" >
                <i class="fas fa-ellipsis-h"></i>
            </span>
            <div class="dropdown-menu">
                @can('delete',$comment)
                <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="eliminaCommento({{$comment->id}})">Elimina</a>
                @else
                <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="reportComment({{$comment->id}})">Segnala</a>
                @endcan
            </div>
        </div>

    </div>
    <small class="d-block p-2 d-flex justify-content-between">
        <div id="punti-{{$comment->id}}" class="ml-4">{{$comment->punti}} punti </div>

        <div>{{$comment->quantoTempoFa()}}</div>
    </small>
</div>
