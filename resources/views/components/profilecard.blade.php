
<div class="card">
    <div class="card-header text-center">
        <h3>
            @if(!Route::is('user_post',$user))
                <a href="{{route('user_post',$user)}}">{{$user->name}}</a>
            @else
            {{$user->name}}
            @endif
        </h3>
    </div>
        <img src="{{asset($user->profilepic)}}" class="card-img-top">

    <div class="card-body">
        <p class="card-text">
            @if($user->bio)
                {{$user->bio}}
            @else
                Questo utente non ha scritto nessuna Bio.
            @endif
        </p>
        @component('components.mini.followButton', compact('user'))
        @endcomponent
        <hr>
        <p>
            @if($user->followers()->count())
                <a href="{{route('user_followers',compact('user'))}}">
            @endif
            Follower: {{$user->followers()->count()}}
            @if($user->followers()->count())
                </a>
            @endif
        </p>
        <p>
            @if($user->follows()->count())
                <a href="{{route('user_follow',compact('user'))}}">
            @endif
            Segue: {{$user->follows()->count()}}
            @if($user->follows()->count())
                </a>
            @endif</p>
    </div>
</div>

