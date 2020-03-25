@extends('layouts.template')
@section('titolo', $post->titolo)

@section('content')
        @component('components.singlePost',compact('post'))
            @auth
                <div class="mb-2">
                    <button class="btn btn-secondary btn-block btn-sm" onclick="like(this,{{$post->id}})"><i class="
                    @if(Auth::user()->hasLikedPost($post))
                            fas
                    @else
                            far
                    @endif
                            fa-heart fa-lg"></i></button>
                </div>
                <form method="POST">
                    @csrf
                    @error('contenuto')
                    <p class="text-danger"><small>{{$message}}</small></p>
                    @enderror
                    <textarea name="contenuto" class="form-control @error('contenuto')is-invalid @enderror">{{old('contenuto')}}</textarea>
                    <button type="submit" class="btn btn-primary mt-3">Invia</button>
                </form>
            @endauth

            @if($post->comments()->withTrashed()->count() > 0)
                <div class="mt-3 ">
                    @component('components.showComments',['comments' => $post->getCommentiInOrdineTemporale()])
                    @endcomponent
                </div>
                <script>
                    if( link = document.querySelector('.linkCommenti'))
                        link.disabled= true;
                </script>
            @endif
        @endcomponent

@endsection
@section('scripts')
    <script src="{{asset('js/infiniteScrollingComment.js')}}"></script>
@endsection
