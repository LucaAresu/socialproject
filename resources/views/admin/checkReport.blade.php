@extends('admin.template.template')

@section('content')
    <div class="container justify-content-center flex-column">
    @component('components.single'.$tipo,[strtolower($tipo) => $report])
    @endcomponent
        <form method="post">
            @csrf
            <button class="btn btn-success">Cancella Reports</button>
        </form>
    </div>
    <script>
        if( link = document.querySelector('.linkCommenti'))
            link.disabled= true;
    </script>
@endsection
