<div class="border rounded p-2 mt-2 bg-white container-fluid containerPost" id="containerPost-{{$post->id}}">
    <h1>
            <a class="text-secondary" href="{{route('single_post',compact('post'))}}">
                {{$post->titolo}}
            </a>
            @canany(['delete','update'],$post)
                <div class="ml-1 float-right dropdown">
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
    </h1>
    <h6>By
        <a href="{{route('user_post',['user' => $post->user])}}">
            @component('components.avatar',['user' => $post->user])
                {{$post->user->name}}
            @endcomponent
        </a>
        <span class="float-right"> alle {{\Carbon\Carbon::parse($post->created_at)->format('H:i d/m/Y ')}}</span>
    </h6>
    @if($post->hasImage())

        <img class="img-fluid" src="{{asset($post->image)}}">
    @endif
    <hr>

    <p>{{$post->contenuto}}</p>
    <p class="font-weight-light text-monospace font-italic"> {{$post->comments->count()}} commenti <span class="float-right">{{$post->quantoTempoFa()}}</span></p>
    {{$slot}}
</div>

