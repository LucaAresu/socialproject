@extends('layouts.template')
@section('titolo','Impostazioni')
@section('content')

    <div class="bg-white border rounded p-2 d-flex flex-column justify-content-between">
        <h1>Impostazioni di {{$user->name}}</h1>
        <div>
        @component('components.impostazioni.bio', compact('user'))
        @endcomponent
        </div>
        <hr>
        <div>
        @component('components.impostazioni.cambioavatar',compact('user'))
        @endcomponent
        </div>
    </div>
@endsection

