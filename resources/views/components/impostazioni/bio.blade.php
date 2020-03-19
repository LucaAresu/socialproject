<h1>Scrivi la tua Bio</h1>
<form method="POST">
    @csrf
    <input type="hidden" name="modo" value="bio">
    <div class="form-group">
        <textarea class="form-control" name="bio">{{$user->bio}}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
