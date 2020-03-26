<h1>Cambio avatar</h1>
@error('avatar')
<p class="text-danger">{{$message}}</p>
@enderror
<form method="POST" onchange="previewFile()"  enctype="multipart/form-data">
    <input type="hidden" name="modo" value="avatar">
    @csrf
    <div class="form-group">
        <input type="file"  class="form-control-file" name="avatar" accept="image/x-png,image/jpeg" >
    </div>
    <div class="form-group">
        <img src="{{asset($user->profilepic)}}"  id="avatar" height="300" width="300" alt="Image preview...">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Invia</button>
    </div>
</form>
<form method="POST">
@csrf
    <input type="hidden" name="modo" value="avatarDestroy">
    <button type="submit" class="btn btn-danger">Elimina foto</button>
</form>
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
