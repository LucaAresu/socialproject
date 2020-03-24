<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><i class="fas fa-home"></i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            @auth
                <li class="nav-item {{Route::currentRouteName() === 'index'? 'active' : ''}}">
                    <a class="nav-link" href="{{route('index')}}">Home <span class="sr-only">(current)</span></a>
                </li>
            @endauth

            <li class="nav-item {{Route::currentRouteName() === 'post_index'? 'active' : ''}}">
                <a class="nav-link" href="{{route('post_index')}}">Discover <span class="sr-only">(current)</span></a>
            </li>

            @auth
                <li class="nav-item {{Route::currentRouteName() === 'create_post'? 'active' : ''}}">
                    <a class="nav-link" href="{{route('create_post')}}">Nuovo Post <span class="sr-only">(current)</span></a>
                </li>
            @endauth
        </ul>
        @auth
            <div class="navbar-nav mr-auto" style="min-width: 25rem;">
                <div id="divCercaUtente" class="w-100" style="position:relative;">
                    <input class="form-control" type="search" placeholder="Cerca un utente..." id="inputCercaUtente">
                </div>
            </div>
        @endauth
        <ul class="navbar-nav">
            @auth
                <li class="nav-item {{Route::currentRouteName() === 'user_notifications'? 'active' : ''}}">
                    <a class="nav-link" href="{{route('user_notifications',['user' => Auth::user()])}}">Notifiche ({{Auth::user()->unreadNotifications()->count()}})</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userInfo" role="button" data-toggle="dropdown">
                        @component('components.avatar',['user' =>Auth::user()])
                            {{Auth::user()->name}}
                        @endcomponent

                    </a>
                    <div class="dropdown-menu" >
                        @if(Auth::user()->isAdmin())
                            <a class="dropdown-item text-primary" href="{{route('admin_index')}}">Pannello Admin</a>
                            <div class="dropdown-divider"></div>
                        @endif

                            <a class="dropdown-item" href="{{route('user_post',Auth::user())}}">Profilo</a>
                        <a class="dropdown-item" href="{{route('user_settings', Auth::user())}}">Impostazioni</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('logout')}}"
                           onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                    </div>
                    <form method="post" id="logout-form" action="{{route('logout')}}" style="display: none;">
                        @csrf
                    </form>
                </li>

            @else
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrati</a> </li>
            @endauth
        </ul>
    </div>
</nav>
