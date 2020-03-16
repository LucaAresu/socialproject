@extends('layouts.template')
@section('titolo','Impostazioni')
@section('content')
    <h1>Cambio avatar</h1>
    @error('avatar')
        <p class="text-danger">{{$message}}</p>
    @enderror
    <form method="POST" onchange="previewFile()" id="avatar" enctype="multipart/form-data" action="{{route('change_avatar',$user)}}">
        @csrf
        <div class="form-group">
            <input type="file" name="avatar" accept="image/x-png,image/jpeg" >
        </div>
        <div class="form-group">
            <img src="{{asset($user->avatar)}}" height="50" width="50" alt="Image preview...">
        </div>
        <div class="form-group">
        <button type="submit" class="btn btn-primary">Invia</button>
        </div>
    </form>
@endsection
<script>
    function previewFile() {
        const preview = document.querySelector('#avatar');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            // convert image file to base64 string
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }</script>
