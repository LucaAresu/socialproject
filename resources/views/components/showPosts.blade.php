@foreach($posts as $post)
    @component('components.singlePost',compact('post'))
        @auth
            <div id="comment-{{$post->id}}">
                <div  class="row">
                    <div class="col-md-4">
                        <a id="comment-{{$post->id}}" class="btn btn-secondary btn-block btn-sm" href="{{route('single_post',compact('post'))}}" onclick="caricaCommenti()">Commenta</a>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-secondary btn-block btn-sm" onclick="like(this,{{$post->id}})"><i class="
                    @if(Auth::user()->hasLikedPost($post))
                     fas
                   @else
                     far
                    @endif
                        fa-heart fa-lg"></i></button>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
            </div>
        @endauth
    @endcomponent
@endforeach
