@foreach($posts as $post)
    @component('components.singlePost',compact('post'))
        @auth
            <div class="px-2" id="comment-{{$post->id}}">
                <div  class="row mb-2">
                    <div class="col-6">
                        <a id="btncom-{{$post->id}}" class="btn btn-secondary btn-block btn-sm" href="{{route('single_post',compact('post'))}}" onclick="caricaCommenti()">Commenta</a>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-secondary btn-block btn-sm" onclick="like(this,{{$post->id}})"><i class="
                    @if(Auth::user()->hasLikedPost($post))
                     fas
                   @else
                     far
                    @endif
                        fa-heart fa-lg"></i></button>
                    </div>
                </div>
            </div>
        @endauth
    @endcomponent
@endforeach
