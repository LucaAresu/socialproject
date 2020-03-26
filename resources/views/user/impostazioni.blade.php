@extends('layouts.template')
@section('titolo','Impostazioni')
@section('content')
    @php
    $user = Auth::user();
    @endphp
    <div class="bg-white border rounded p-2 d-flex flex-column justify-content-between">
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

