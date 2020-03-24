@extends('admin.template.template')

@section('content')
    <div class="container d-flex justify-content-center">
    @component('components.single'.$tipo,[strtolower($tipo) => $report])
    @endcomponent
        <form method="post">
            @csrf
            <button class="btn btn-success">Cancella Reports</button>
        </form>
    </div>
@endsection
