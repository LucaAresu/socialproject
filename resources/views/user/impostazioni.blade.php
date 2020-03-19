@extends('layouts.template')
@section('titolo','Impostazioni')
@section('content')
    @php
    $user = Auth::user();
    @endphp
    @component('components.impostazioni.bio', compact('user'))
    @endcomponent
    @component('components.impostazioni.cambioavatar',compact('user'))
    @endcomponent
@endsection

