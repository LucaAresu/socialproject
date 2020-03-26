@auth
    @if(Auth::user() != $user)
        @if(Auth::user()->isFollowing($user))
            <button onclick="follow({{$user->id}})" class="user-{{$user->id}} btn btn-success btn-block btn-sm">Seguito</button>
        @else
            <button onclick="follow({{$user->id}})" class="user-{{$user->id}} btn btn-outline-success btn-block btn-sm">Segui</button>
        @endif
    @endif
@endauth
