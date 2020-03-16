<form method="post" action="{{route('create_post')}}" enctype="multipart/form-data" >
    @csrf
    <div class="form-group">
<!-- TODO: renderlo usabile pure per editare i post -->

        <label for="titolo">Titolo</label>
        @error('titolo')
        <p class="text-danger">{{$message}}</p>
        @enderror
        <input type="text" class="form-control @error('titolo') is-invalid @enderror" id="titolo" name="titolo" value="@if($errors->all()) {{old('titolo')}}@else{{$post->titolo}}@endif" required>
    </div>
    <div class="form-group">
        <label for="contenuto">Contenuto</label>
        @error('contenuto')
        <p class="text-danger"><small>{{$message}}</small></p>
        @enderror
        <textarea type="contenuto" class="form-control @error('contenuto') is-invalid @enderror" id="contenuto" name="contenuto" required>@if($errors->all()){{old('contenuto')}}@else{{$post->contenuto}}@endif</textarea>

        <div class="form-group">
            <input type="file" name="postimg" accept="image/x-png,image/jpeg" >
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Invia</button>
</form>

