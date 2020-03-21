<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

    <title>Jonnykorner - @yield('titolo')</title>

    <script>window.laravel = {!!
json_encode(['csrf' => csrf_token(),
'basePath' => route('index'),
]) !!};</script>
    <script src="{{asset('js/js.js')}}"></script>

    <script src="https://kit.fontawesome.com/78c802cb57.js" crossorigin="anonymous"></script>
</head>
<body>
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
                            {{Auth::getUser()->name}}
                        @endcomponent

                    </a>
                    <div class="dropdown-menu" >
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
<div class="container mt-2">
    <div class="row justify-content-center">

        @yield('sideContent')

        <div class="col-md-8">
            @yield('content')
        </div>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

@yield('scripts')
</body>
</html>
