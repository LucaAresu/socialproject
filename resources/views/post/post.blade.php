@extends('layouts.template')
@section('titolo', $post->titolo)

@section('content')
        @component('components.singlePost',compact('post'))
            @auth
                <form method="POST">
                    @csrf
                    @error('contenuto')
                    <p class="text-danger"><small>{{$message}}</small></p>
                    @enderror
                    <textarea name="contenuto" class="form-control @error('contenuto')is-invalid @enderror">{{old('contenuto')}}</textarea>
                    <button type="submit" class="btn btn-primary mt-3">Invia</button>
                </form>
            @endauth

            @if($post->comments->count() > 0)
                <div class="mt-3 ">
                    @component('components.showComments',['comments' => $post->getCommentiInOrdineTemporale()])
                    @endcomponent
                </div>
            @endif
        @endcomponent

@endsection
@section('scripts')
    <script src="{{asset('js/infiniteScrollingComment.js')}}"></script>
@endsection
