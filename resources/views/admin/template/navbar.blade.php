<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <a class="navbar-brand" href="#"><i class="fas fa-home"></i></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{Route::is('index')? 'active' : ''}}">
                <a class="nav-link" href="{{route('index')}}">Sito Principale <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item {{Route::is('admin_index')? 'active' : ''}}">
                <a class="nav-link" href="{{route('admin_index')}}">Lista Utenti</a>
            </li>

        </ul>
    </div>
</nav>
