<div class="containerPost border rounded bg-white mb-3 mt-2" id="containerPost-{{$post->id}}">
    <div class="row p-2 titolo">
        <div class="col-11">
            <h1>
                <a class="text-secondary" href="{{route('single_post',compact('post'))}}">
                    {{$post->titolo}}
                </a>
            </h1>
        </div>
            @canany(['delete','update'],$post)
                <div class="col-1 dropdown">
                    <span class="btn" id="dropdownMenuButton" data-toggle="dropdown" >
                        <i class="fas fa-ellipsis-h"></i>
                    </span>
                    <div class="dropdown-menu">
                        @can('update', $post)
                        <a class="dropdown-item" href="{{route('edit_post',compact('post'))}}">Modifica</a>
                        @endcan
                        <div class="dropdown-divider"></div>
                    @can('delete',$post)
                        <form style="display: none;" action="{{route('destroy_post',compact('post'))}}" method="POST" id="form-{{$post->id}}">
                            @method('DELETE')
                            @csrf
                        </form>
                        <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="cancellaPost({{$post->id}})">Elimina</a>
                    @endcan
                    </div>
                </div>
            @endcanany

    </div>
    <div class="informazioni row p-2">
        <div class="col-4">
            By
            <a href="{{route('user_post',['user' => $post->user])}}">
                @component('components.avatar',['user' => $post->user])
                    {{$post->user->name}}
                @endcomponent
            </a>
        </div>
        <div class="col-4 text-center ">
        @auth
            @if(Auth::user() != $post->user)
                @if(Auth::user()->isFollowing($post->user))
                    <button onclick="follow({{$post->user->id}})" class="user-{{$post->user->id}} btn btn-success btn-block btn-sm">Seguito</button>
                    @else
                    <button onclick="follow({{$post->user->id}})" class="user-{{$post->user->id}} btn btn-outline-success btn-block btn-sm">Segui</button>
                @endif
            @endif
        @endauth
        </div>

        <div class="col-4 text-right">
            alle {{\Carbon\Carbon::parse($post->created_at)->format('H:i d/m/Y ')}}
        </div>
    </div>
    @if($post->hasImage())
        <hr class="m-0">
        <div class="container-fluid px-0">
        <img class="img-fluid w-100" src="{{asset($post->image)}}">
        </div>

    @endif
    <hr class="m-0">
    <div class="contenuto bg-light pt-3 pb-2 pl-2">
        <p>{!!  nl2br( e ($post->contenuto)) !!}</p>
    </div>
    <div class="row p-2 ">
        <div class="col-4">
            <p class="font-weight-light text-monospace font-italic">
                @auth <button class="btn btn-link" onclick="document.querySelector('#btncom-{{$post->id}}').click();"> @endauth{{$post->comments()->withTrashed()->count()}} commenti @auth </button> @endauth</p>
        </div>
        <div class="col-4">
            <p class="text-center numlikes">{{$post->likesCount()}} likes</p>
        </div>
        <div class="col-4">
            <p class="text-right">{{$post->quantoTempoFa()}}</p>
        </div>
    </div>

    {{$slot}}
</div>

